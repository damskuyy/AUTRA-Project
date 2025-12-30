import json
import paho.mqtt.client as mqtt

# =============================
# KONFIGURASI MQTT
# =============================
BROKER = "broker.hivemq.com"   # samakan dengan HMI
PORT = 1883
TOPIC = "data/haiwell/python/+"

# =============================
# CALLBACK SAAT CONNECT
# =============================
def on_connect(client, userdata, flags, rc):
    if rc == 0:
        print("✅ Connected ke MQTT Broker")
        client.subscribe(TOPIC)
        print(f"📡 Subscribe ke topic: {TOPIC}")
    else:
        print("❌ Gagal connect, code:", rc)

# =============================
# CALLBACK SAAT TERIMA DATA
# =============================
def on_message(client, userdata, msg):
    print("\n📥 Data masuk")
    print("Topic:", msg.topic)

    try:
        payload = msg.payload.decode()
        data = json.loads(payload)

        # Ambil data sensor
        sensor1 = int(data.get("sensor1", 0))
        sensor2 = int(data.get("sensor2", 0))
        sensor3 = int(data.get("sensor3", 0))

        print("Humidity   :", sensor1)
        print("Temperature:", sensor2)
        print("Lux        :", sensor3)

    except Exception as e:
        print("❌ Error parsing data:", e)

# =============================
# MAIN PROGRAM
# =============================
client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message

client.connect(BROKER, PORT, keepalive=60)
client.loop_forever()
