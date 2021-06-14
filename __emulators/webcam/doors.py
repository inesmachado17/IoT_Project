import requests
import sys
import time
import msvcrt

INTERVAL = 2000
URL = "http://localhost:8000/api/actuators/doors"


def sendToApi(id):
    r = requests.post(URL + '/toogle/' + id)
    print(r.text)
    if(r.status_code == 200):
        print("OK: " + str(r.status_code) + " POST to doors")
        return r.text
    else:
        print("ERRO: " + str(r.status_code) + " Fail to post data to doors")
        return -1


def getFromApi():
    res = requests.get(URL)
    if res.status_code == 200:
        print("OK: GET doors values")
        print(res.content)
    else:
        print("ERRO: Fail to get doors values")


try:
    while True:
        print("###############################################\n")
        print("Prima CTRL+C para terminar\n")
        print("Prima 1 para Abrir/Fechar a porta principal\n")
        print("Prima 2 para Abrir/Fechar o portão da garagem\n")
        print("###############################################\n")
        if(msvcrt.kbhit()):
            key = msvcrt.getch()
            if(key == b'1'):
                res = sendToApi('1')
                print("\nPorta principal foi ")
                if(res == '0'):
                    print("\tfechada")
                elif(res == '1'):
                    print("\taberta")
            elif(key == b'2'):
                res = sendToApi('2')
                print("\nPortão da garagem foi ")
                if(res == '0'):
                    print("\tfechada")
                elif(res == '1'):
                    print("\taberta")
            else:
                print("\nOpção inválida")
        time.sleep(INTERVAL/1000)

except KeyboardInterrupt:
    print("Programa terminado pelo utilizador")

except:
    print("Ocorreu um erro:", sys.exc_info())

finally:
    print("Fim do programa")
