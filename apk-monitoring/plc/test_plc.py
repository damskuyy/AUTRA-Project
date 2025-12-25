from pymodbus.client import ModbusTcpClient

client = ModbusTcpClient('192.168.1.10', port=502)
client.connect()

result = client.read_holding_registers(0, 2)

print(result.registers)

client.close()
