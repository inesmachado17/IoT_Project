var urlActuator = "http://localhost:8000/api/actuators/sprinklers";
var sensorValue;
var sensorPin = A0;
var ActuatorName = "Horta";
var actuator;
var actuatorPin = 0;

function lerSensor() {
    var hum = analogRead(sensorPin);
    hum = (hum / 1023) * 100;
    return Math.round(hum.toFixed(0));
}

function setPowerActuator(flag) {
    customWrite(actuatorPin, flag ? 1 : 0);
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
        Serial.println(
            Math.round(Number(sensorValue)) +
                " -> " +
                Math.round(actuator.setting)
        );

        if (actuator.automatic) {
            if (
                Math.round(Number(sensorValue)) < Math.round(actuator.setting)
            ) {
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
