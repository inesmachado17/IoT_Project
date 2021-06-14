var urlActuator = "http://localhost:8000/api/actuators/air-conditioners";
var sensorValue;
var sensorPin = A0;
var ActuatorName = "Central";
var actuator;
var actuatorPin = 0;

function lerSensor() {
    var temp = analogRead(sensorPin);
    temp = (temp / 1023) * 200 - 100;
    return temp.toFixed(2);
}

function setPowerActuator(flag) {
    digitalWrite(actuatorPin, flag ? HIGH : LOW);
    actuator.state = flag ? 1 : 0;
}

function setPowerFurnace(flag) {
    digitalWrite(1, flag ? HIGH : LOW);
}

function dataHora() {
    var data = new Date().toISOString();

    return data;
}

function setup() {
    pinMode(sensorPin, INPUT);
    pinMode(actuatorPin, OUTPUT);
    pinMode(1, OUTPUT);

    setPowerActuator(false);
    setPowerFurnace(false);
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
                Math.round(Number(sensorValue)) > Math.round(actuator.setting)
            ) {
                setPowerActuator(true);
                setPowerFurnace(false);
            } else {
                setPowerActuator(false);
                setPowerFurnace(true);
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
