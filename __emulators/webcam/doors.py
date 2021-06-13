import requests
import sys
import time

INTERVAL = 2000
URL = "http://localhost:8000/api/actuators/doors"


def getFromApi():
    res = requests.get(URL)
    if res.status_code == 200:
        print("OK: GET doors values")
        print(res.content)
    else:
        print("ERRO: Fail to get doors values")


try:
    while True:
        time.sleep(INTERVAL)

except KeyboardInterrupt:  # caso haja interrupção de teclado CTRL+C
    print("Programa terminado pelo utilizador")

except:  # caso haja um erro qualquer
    print("Ocorreu um erro:", sys.exc_info())

finally:  # executa sempre, independentemente se ocorreu exception
    print("Fim do programa")
