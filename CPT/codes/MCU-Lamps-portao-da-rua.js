var urlActuator = "http://localhost:8000/api/actuators/lamps";
var sensorValue;
var sensorPin = A0;
var ActuatorName = "Portão da rua";
var actuator;
var actuatorPin = 0;

function lerSensor() {
    var val = analogRead(sensorPin);
    val = (val * 100) / 1023;

    return Math.round(val);
}

function setPowerActuator(flag) {
    customWrite(actuatorPin, flag ? 2 : 0);
    actuator.state = flag ? 1 : 0;
}

function dataHora() {
    return new Date().toISOString();
}

function setup() {
    pinMode(sensorPin, INPUT);
    pinMode(actuatorPin, OUTPUT);
}

function loop() {
    sensorValue = lerSensor();
    Serial.println("Sensor value " + dataHora() + " : " + sensorValue);

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
        Serial.println(sensorValue + " -> " + actuator.setting);

        if (actuator.automatic) {
            if (sensorValue <= actuator.setting) {
                setPowerActuator(true);
            } else {
                setPowerActuator(false);
            }
            // update actuator state on server
            RealHTTPClient.post(
                urlActuator,
                {
                    value: sensorValue,
                    state: actuator.state ? 1 : 0,
                    id: actuator.id,
                },
                function (status, data) {
                    Serial.println(
                        "Status POST request to update actiator state: " +
                            status
                    );
                    //Serial.println(data);
                }
            );
        } else {
            setPowerActuator(!!actuator.state);
        }

        Serial.println(
            actuator.name +
                " setting: " +
                actuator.setting +
                " state: " +
                actuator.state +
                " automatic: " +
                actuator.automatic
        );
    }

    delay(2000);
}
