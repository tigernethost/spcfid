import evdev, asyncio, redis, pickle, requests, time
import json
import RPi.GPIO as GPIO
from evdev import InputDevice, categorize, ecodes
from pprint import pprint


devices = [evdev.InputDevice(fn) for fn in evdev.list_devices()]

GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
GPIO.setup(20, GPIO.OUT)
GPIO.setup(21, GPIO.OUT)

GPIO.output(20,GPIO.LOW)
GPIO.output(21,GPIO.LOW)

pinEntrance = 20
pinExit = 21

serverIP = "200.10.10.254"

RFIDname = "Standard Microsystems Corp. SMSC9512/9514 Fast Ethernet Adapter"

nCntEntrance = 0
nCntExit = 0
turnstile_no = 1

r = redis.StrictRedis('200.10.10.254')

ctr =0;
dev=''

for device in devices:
        print(device.fn, device.name, device.phys)
        if ctr == 1 or ctr == 3:
                if str(device.name) == RFIDname:
                        dev = InputDevice(device.fn)
                        print("Current scanner: ",device.fn)
                        break
                else:
                        dev=''
        ctr = ctr + 1

@asyncio.coroutine
def print_events(device):


        buffer = None
        buf = ''
        is_in = 0

        while True:
                events = yield from device.async_read()
                for event in events:
                        #print(device.fn, evdev.categorize(event), sep=': ')
                        if (device.fn == '/dev/input/event0'):
                                if event.type == evdev.ecodes.EV_KEY and event.value == 1:
                                        data = evdev.categorize(event)
                                        key_lookup = scancodes.get(data.scancode) or 'UNKNOWN:{}'.format(data.scancode)
                                        if (key_lookup == 'CRLF'):

                                                read_status = r.get(buf.lstrip("0"))
                                                if read_status:
                                                        read_status = str(read_status, 'utf-8')
                                                else:
                                                        read_status = "Unregistered"

                                                if read_status == "is_in" and read_status != "":
                                                        print("You cannot double tap")


                                                elif read_status == "Unregistered":
                                                        print("Unregistered")
                                                else:
                                                        GPIO.output(pinEntrance,GPIO.HIGH)
                                                        print("You are now login")
                                                        time.sleep(.5)
                                                        #nCntEntrance = nCntEntrance + 1
                                                        #GPIO.output(pinEntrance,GPIO.HIGH)
                                                        #time.sleep(0.1)
                                                        #GPIO.output(pinEntrance,GPIO.HIGH)
                                                        #time.sleep(0.2)
                                                        #GPIO.output(pinEntrance,GPIO.HIGH)
                                                        #time.sleep(0.2)
                                                        GPIO.output(pinEntrance,GPIO.LOW)
                                                        r.set(format(int(buf)), 'is_in')

                                                        req = requests.get("http://" + serverIP + "/trigger?rfid="+format(int(buf))+"&in=1&turnstile=1")
                                                        print(req.url)
                                                        print(req.status_code)
                                                        #print(nCntEntrance)

                                                buf = ''
                                        else:
                                                buf = buf + key_lookup
                        else:
                                if event.type == evdev.ecodes.EV_KEY and event.value == 1:
                                        data = evdev.categorize(event)
                                        key_lookup = scancodes.get(data.scancode) or 'UNKNOWN:{}'.format(data.scancode)
                                        if (key_lookup == 'CRLF'):

                                                read_status_out = r.get(buf.lstrip("0"))
                                                #read_status_out = str(read_status_out, 'utf-8')

                                                if read_status_out:
                                                        read_status_out = str(read_status_out, 'utf-8')
                                                else:
                                                        read_status_out = "Unregistered"

                                                if read_status_out == "is_out" and read_status_out != "":
                                                        print("Not allowed!")
                                              elif read_status_out == "Unregistered":
                                                        print("Not allowed!")

                                                else:
                                                        GPIO.output(pinExit,GPIO.HIGH)
                                                        time.sleep(.5)
                                                        #GPIO.output(pinExit.GPIO.HIGH)
                                                        #time.sleep(0.1)
                                                        #GPIO.output(pinExit,GPIO.HIGH)
                                                        #time.sleep(0.2)
                                                        #nCntExit = nCntExit + 1
                                                        GPIO.output(pinExit,GPIO.LOW)
                                                        print("You are now logout")
                                                        #if(requests):
                                                        req = requests.get("http://" + serverIP + "/trigger?rfid="+format(int(buf))+"&in=0&turnstile=1")

                                                        print(req.url)
                                                        print(req.status_code)
                                                        #print(nCntExit)
                                                        r.set(format(int(buf)),'is_out')



                                                buf = ''
                                        else:
                                                buf = buf + key_lookup

input1 = evdev.InputDevice('/dev/input/event0')
input2 = evdev.InputDevice('/dev/input/event1')

scancodes = {
    # Scancode: ASCIICode
    0: None, 1: u'ESC', 2: u'1', 3: u'2', 4: u'3', 5: u'4', 6: u'5', 7: u'6', 8: u'7', 9: u'8',
    10: u'9', 11: u'0', 12: u'-', 13: u'=', 14: u'BKSP', 15: u'TAB', 16: u'Q', 17: u'W', 18: u'E', 19: u'R',
    20: u'T', 21: u'Y', 22: u'U', 23: u'I', 24: u'O', 25: u'P', 26: u'[', 27: u']', 28: u'CRLF', 29: u'LCTRL',
    30: u'A', 31: u'S', 32: u'D', 33: u'F', 34: u'G', 35: u'H', 36: u'J', 37: u'K', 38: u'L', 39: u';',
    40: u'"', 41: u'`', 42: u'LSHFT', 43: u'\\', 44: u'Z', 45: u'X', 46: u'C', 47: u'V', 48: u'B', 49: u'N',
    50: u'M', 51: u',', 52: u'.', 53: u'/', 54: u'RSHFT', 56: u'LALT', 100: u'RALT'
}

for device in input1, input2:
        asyncio.async(print_events(device))

loop = asyncio.get_event_loop()
loop.run_forever()

