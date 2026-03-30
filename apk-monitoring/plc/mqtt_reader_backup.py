import json
import time
import sys
import mysql.connector
import paho.mqtt.client as mqtt
from datetime import datetime

# =============================
# MQTT CONFIG
# =============================
BROKER = "broker.hivemq.com"
PORT = 1883
TOPIC = "data/haiwell/python/+"

NO_DATA_TIMEOUT = 10  # detik

# =============================
# DATABASE CONFIG
# =============================
DB_CONFIG = {
    "host": "localhost",
    "user": "root",
    "password": "",
    "database": "autra_project"
}

# =============================
# GLOBAL STATE
# =============================
start_time = time.time()
last_msg_time = None
status = "NO_DATA"

# =============================
# DATABASE CONNECT
# =============================
try:
    db = mysql.connector.connect(**DB_CONFIG)
    cursor = db.cursor()
    print("🗄️ Connected ke database")
except Exception as e:
    print("❌ Database connection failed:", e)
    sys.exit(1)

# =============================
# SAVE TO DATABASE
# =============================
def save_to_db(sensor1, sensor2, sensor3, status):
    sql = """
        INSERT INTO mon_sensor_readings
        (sensor1, sensor2, sensor3, status, received_at)
        VALUES (%s, %s, %s, %s, %s)
    """
    values = (
        sensor1,
        sensor2,
        sensor3,
        status,
        datetime.now()
    )
    cursor.execute(sql, values)
    db.commit()

# =============================
# MQTT CALLBACKS
# =============================
def on_connect(client, userdata, flags, rc):
    if rc == 0:
        print("✅ Connected ke MQTT Broker")
        client.subscribe(TOPIC)
        print(f"📡 Subscribe ke topic: {TOPIC}")
        print(f"⏳ Menunggu data MQTT ({NO_DATA_TIMEOUT} detik)...")
    else:
        print("❌ MQTT connect failed")
        sys.exit(1)

def on_message(client, userdata, msg):
    global last_msg_time, status
    last_msg_time = time.time()
    status = "ONLINE"

    data = json.loads(msg.payload.decode())

    try:
        raw_s1 = float(data.get("sensor1", 0))
    except (TypeError, ValueError):
        raw_s1 = 0.0
    try:
        raw_s2 = float(data.get("sensor2", 0))
    except (TypeError, ValueError):
        raw_s2 = 0.0
    try:
        raw_s3 = float(data.get("sensor3", 0))
    except (TypeError, ValueError):
        raw_s3 = 0.0

    # If the device reports values scaled by 10 (common on some sensors),
    # convert them back to human-readable. Heuristic: if value > 100, divide by 10.
    sensor1 = raw_s1 / 10.0 if raw_s1 > 100 else raw_s1
    sensor2 = raw_s2 / 10.0 if raw_s2 > 100 else raw_s2
    sensor3 = raw_s3

    print("\n📥 Data masuk")
    print("STATUS :", status)
    print("Humidity   :", sensor1)
    print("Temperature:", sensor2)
    print("Lux        :", sensor3)

    save_to_db(sensor1, sensor2, sensor3, status)

def on_disconnect(client, userdata, rc):
    print("🔌 MQTT disconnected")

# =============================
# MAIN
# =============================
print("⏳ Mencoba connect ke MQTT...")

client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message
client.on_disconnect = on_disconnect

client.connect(BROKER, PORT, 60)
client.loop_start()

try:
    while True:
        now = time.time()

        # TIDAK PERNAH ADA DATA
        if last_msg_time is None:
            if now - start_time > NO_DATA_TIMEOUT:
                status = "NO_DATA"
                print("❌ STATUS NO_DATA. Program dihentikan.")
                save_to_db(None, None, None, status)
                break

        # DATA TERHENTI
        else:
            if now - last_msg_time > NO_DATA_TIMEOUT:
                status = "OFFLINE"
                print("❌ STATUS OFFLINE. Program dihentikan.")
                save_to_db(None, None, None, status)
                break

        time.sleep(0.5)

except KeyboardInterrupt:
    print("\n🛑 Program dihentikan user")

finally:
    client.loop_stop()
    client.disconnect()
    cursor.close()
    db.close()
    print(f"👋 Keluar dari program, STATUS terakhir: {status}")
    sys.exit(0)
