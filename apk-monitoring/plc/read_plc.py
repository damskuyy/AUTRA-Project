from pymodbus.client import ModbusTcpClient

PLC_IP = "192.168.1.112"
PLC_PORT = 502
UNIT_ID = 1

client = ModbusTcpClient(PLC_IP, port=PLC_PORT)

if not client.connect():
    print("❌ Gagal konek ke PLC")
    exit()

# Read 3 register mulai dari D100
result = client.read_holding_registers(
    address=0,   # D100 -> 99
    count=3,
    unit=UNIT_ID
)

if result.isError():
    print("❌ Error baca data:", result)
else:
    humidity = result.registers[0] / 10
    temperature = result.registers[1] / 10
    lux = result.registers[2]

    print("Kelembapan :", humidity)
    print("Suhu :", temperature)
    print("Cahaya     :", lux)

client.close()
