var urlSensor = "http://localhost:8000/api/sensors/motions";
var urlActuator = "http://localhost:8000/api/actuators/doors";

var sensorValue;
var ActuatorName = "Porta principal";
var doorPin = 0;
var sensorPin = 1;
var actuator;

function lerSensor() {
    return digitalRead(sensorPin) == HIGH;
}

function dataHora() {
    return new Date().toISOString();
}

function setup() {
    pinMode(sensorPin, INPUT);
    pinMode(doorPin, OUTPUT);
}

function loop() {
    sensorValue = lerSensor();
    Serial.println("Sensor value " + dataHora() + " : " + sensorValue);

    RealHTTPClient.post(
        urlSensor,
        {
            value: sensorValue ? 1 : 0,
            date: dataHora(),
        },
        function (status, data) {
            Serial.println(
                "Status POST request to send door values: " + status
            );
        }
    );

    // request state of all Actuators
    RealHTTPClient.get(urlActuator, function (status, data) {
        Serial.println("Status GET request actuator values: " + status);
        //Serial.println("Value GET request: " + data);
        if (status == 200) {
            data = JSON.parse(data);
            for (var i = 0; i < data.length; i++) {
                if (data[i].name == ActuatorName) {
                    actuator = data[i];
                    break;
                }
            }
        }
    });

    if (actuator.id) {
        if (actuator.locked === 0) {
            if (actuator.state) {
                customWrite(doorPin, "1,0");
            } else {
                customWrite(doorPin, "0,0");
            }
        } else {
            customWrite(doorPin, "0,1");
        }

        if (actuator.value != sensorValue) {
            // update actuator state on server
            RealHTTPClient.post(
                urlActuator,
                {
                    value: sensorValue ? 1 : 0,
                    state: actuator.state,
                    id: actuator.id,
                },
                function (status, data) {
                    Serial.println(
                        "Status POST request to update actuator state: " +
                            status
                    );
                    Serial.println(data);
                }
            );
        }

        Serial.println(
            actuator.name +
                " state: " +
                actuator.state +
                " locked: " +
                actuator.locked +
                " value: " +
                actuator.value
        );
    }

    delay(2000);
}
