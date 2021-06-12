import requests
import sys
import cv2

# camera = cv2.VideoCapture(1, cv2.CAP_DSHOW)
# camera = cv2.VideoCapture('http://10.20.228.225:4747/video')

INTERVAL = 5000


def returnCameraIndexes():
    # checks the first 10 indexes.
    index = 0
    arr = []
    i = 10
    while i > 0:
        cap = cv2.VideoCapture(index)
        if cap.read()[0]:
            arr.append(index)
            cap.release()
        index += 1
        i -= 1
    return arr


def send_file(file, webcamName):
    url = 'http://localhost:8000/api/webcam/oneshot/' + webcamName
    files = {'file': open(file, 'rb')}
    r = requests.post(url, files=files)
    print(r.status_code)


def handleCamera(camera, tempFileName, webcamName):
    ret, image = camera.read()
    print("Resultado da Camera=" + str(ret))
    if ret:
        cv2.imwrite(tempFileName + '.jpg', image)
        cv2.imshow(tempFileName + '.jpg', image)
        camera.release()
        send_file(tempFileName + '.jpg', webcamName)


try:
    arr = returnCameraIndexes()
    print(arr)
    while True:
        camera1 = cv2.VideoCapture(0)
        camera2 = cv2.VideoCapture(1)
        handleCamera(camera1, 'porta', 'porta')
        handleCamera(camera2, 'garagem', 'garagem')
        cv2.waitKey(INTERVAL)

except KeyboardInterrupt:  # caso haja interrupção de teclado CTRL+C
    print("Programa terminado pelo utilizador")

except:  # caso haja um erro qualquer
    print("Ocorreu um erro:", sys.exc_info())

finally:  # executa sempre, independentemente se ocorreu exception
    print("Fim do programa")
    camera1.release()
    camera2.release()
    cv2.destroyAllWindows()
