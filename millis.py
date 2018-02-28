import threading
import time

class Timer(threading.Thread):
	def __init__(self):
		threading.Thread.__init__(self)
		self.event = threading.Event()
	def run(self):
		while not self.event.is_set():
			print("Hello")
			self.event.wait(2)

	def stop(self):
		self.event.set()


tmr = Timer()
tmr.start()
