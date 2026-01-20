import json
import time
import sys
import paho.mqtt.client as mqtt

BROKER = "broker.hivemq.com"
PORT = 1883
TOPIC = "data/haiwell/python/+"

NO_DATA_TIMEOUT = 10  # detik

start_time = time.time()
last_msg_time = None
connected = False

# =============================
# CALLBACK CONNECT
# =============================
def on_connect(client, userdata, flags, rc):
    global connected
    if rc == 0:
        connected = True
        print("✅ Connected ke MQTT Broker")
        client.subscribe(TOPIC)
        print(f"📡 Subscribe ke topic: {TOPIC}")
        print(f"⏳ Menunggu data MQTT MQTT masuk selama ({NO_DATA_TIMEOUT} detik)...")
    else:
        print("❌ Gagal connect ke MQTT Broker (rc:", rc, ")")
        sys.exit(1)

# =============================
# CALLBACK MESSAGE
# =============================
def on_message(client, userdata, msg):
    global last_msg_time
    last_msg_time = time.time()

    print("\n📥 Data masuk")
    print("Topic:", msg.topic)

    try:
        data = json.loads(msg.payload.decode())
        print("Humidity   :", data.get("sensor1"))
        print("Temperature:", data.get("sensor2"))
        print("Lux        :", data.get("sensor3"))
    except Exception as e:
        print("❌ Error parsing payload:", e)

# =============================
# CALLBACK DISCONNECT
# =============================
def on_disconnect(client, userdata, rc):
    if connected:
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

        # BELUM ADA DATA SAMA SEKALI
        if last_msg_time is None:
            if now - start_time > NO_DATA_TIMEOUT:
                print("❌ Tidak ada data MQTT masuk. Program dihentikan.")
                break

        # DATA PERNAH MASUK TAPI TERHENTI
        else:
            if now - last_msg_time > NO_DATA_TIMEOUT:
                print("❌ Data MQTT terhenti. Program dihentikan.")
                break

        time.sleep(0.5)

except KeyboardInterrupt:
    print("\n🛑 Program dihentikan user")

finally:
    client.loop_stop()
    client.disconnect()
    print("👋 Keluar dari program, Bye!")
    sys.exit(0)
