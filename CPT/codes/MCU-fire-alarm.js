var urlSensor = "http://localhost:8000/api/sensors/smokes";
var urlFireAlarm = "http://localhost:8000/api/actuators/fire-alarms";

function getSensorData() {
    var sensorValue = Math.floor(map(analogRead(A0), 0, 1023, 0, 100) + 0.5);

    Serial.println("Sensor value " + dataHora() + " : " + sensorValue);

    RealHTTPClient.post(
        urlSensor,
        {
            value: sensorValue,
            date: dataHora(),
        },
        function (status, data) {
            Serial.println(
                "Status POST request to send sensor values: " + status
            );
        }
    );

    return sensorValue;
}

function getSireneData() {
    var sirene = digitalRead(1);

    Serial.println("Sirene value " + dataHora() + " : " + sirene);

    return sirene;
}

function dataHora() {
    return new Date().toISOString();
}

function setup() {
    attachInterrupt(A0, function () {
        processData(getSensorData());
    });

    attachInterrupt(1, function () {
        processSireneData(getSireneData());
    });
}

function processData(data) {
    if (data > 10) {
        digitalWrite(0, HIGH);
    } else {
        digitalWrite(0, LOW);
    }
}

function processSireneData(data) {
    RealHTTPClient.post(
        urlFireAlarm,
        {
            value: data > 0 ? 1 : 0,
        },
        function (status, data) {
            Serial.println(
                "Status POST request to fire alarm values: " + status
            );
        }
    );
}
