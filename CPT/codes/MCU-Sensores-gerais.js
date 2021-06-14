var urlSensorTemp = "http://localhost:8000/api/sensors/temperatures";
var urlSensorLight = "http://localhost:8000/api/sensors/lights";
var urlSensorHum = "http://localhost:8000/api/sensors/humidities";

var sensorTempValue;
var sensorLightValue;
var sensorHumValue;

var sensorTempPin = A0;
var sensorLightPin = A1;
var sensorHumPin = A2;

function lerSensorTemp() {
    var temp = analogRead(sensorTempPin);
    temp = (temp / 1023) * 200 - 100;
    return temp.toFixed(2);
}

function lerSensorLight() {
    var val = analogRead(sensorLightPin);
    val = (val * 100) / 1023;

    return Math.round(val);
}

function lerSensorHum() {
    var hum = analogRead(sensorHumPin);
    hum = (hum / 1023) * 100;
    return Math.round(hum.toFixed(0));
}

function dataHora() {
    return new Date().toISOString();
}

function sendValues(url, value, label) {
    RealHTTPClient.post(
        url,
        {
            value: value,
            date: dataHora(),
        },
        function (status, data) {
            Serial.println(
                "Status POST request to send " + label + " values: " + status
            );
        }
    );
}

function setup() {
    pinMode(sensorTempPin, INPUT);
    pinMode(sensorLightPin, INPUT);
}

function loop() {
    sensorTempValue = lerSensorTemp();
    Serial.println("Sensor Temp value " + dataHora() + " : " + sensorTempValue);

    sensorLightValue = lerSensorLight();
    Serial.println(
        "Sensor Light value " + dataHora() + " : " + sensorLightValue
    );

    sensorHumValue = lerSensorHum();
    Serial.println("Sensor Hum value " + dataHora() + " : " + sensorHumValue);

    // send sensors Values data to server
    sendValues(urlSensorTemp, sensorTempValue, "sensorTemp");
    sendValues(urlSensorLight, sensorLightValue, "sensorLight");
    sendValues(urlSensorHum, sensorHumValue, "sensorHum");

    delay(2000);
}
