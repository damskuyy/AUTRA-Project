# from pymodbus.client import ModbusTcpClient
# import requests
# import time
# from config import *

# def read_plc():
#     client = ModbusTcpClient(PLC_IP, port=PLC_PORT)
#     client.connect()

#     result = client.read_holding_registers(
#         address=0,
#         count=len(REGISTER_MAP)
#     )

#     client.close()

#     if result.isError():
#         return None

#     data = {}
#     for i, key in enumerate(REGISTER_MAP):
#         data[key] = result.registers[i]

#     return data

# while True:
#     data = read_plc()
#     if data:
#         requests.post(LARAVEL_API, json=data)
#     time.sleep(READ_INTERVAL)

from pymodbus.client import ModbusTcpClient
import requests
import time

while True:
    client = ModbusTcpClient('192.168.1.10', port=502)
    client.connect()

    result = client.read_holding_registers(0, 3)
    client.close()

    data = {
        "temperature": result.registers[0],
        "luxury": result.registers[1],
        "humidity": result.registers[2],
    }

    requests.post("http://localhost/api/plc-data", json=data)

    time.sleep(1)
