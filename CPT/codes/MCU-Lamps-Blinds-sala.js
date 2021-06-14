var urlActuator = "http://localhost:8000/api/actuators/lamps";
var urlActuatorBlind = "http://localhost:8000/api/actuators/blinds";
var sensorValue;
var sensorPin = A0;

var ActuatorName = "Sala";
var actuator;
var actuatorPin = 0;

var ActuatorBlindName = "Sala";
var actuatorBlind;
var actuatorBlindPin = 1;

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
    pinMode(actuatorBlindPin, OUTPUT);
}

function loop() {
    sensorValue = lerSensor();
    Serial.println("Sensor value " + dataHora() + " : " + sensorValue);

    // request state of all Lamp Actuators
    RealHTTPClient.get(urlActuator, function (status, data) {
        Serial.println("Status GET request lamp actuator values: " + status);
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

    // request state of all Blind Actuators
    RealHTTPClient.get(urlActuatorBlind, function (status, data) {
        Serial.println("Status GET request blind actuator values: " + status);
        //Serial.println("Value GET request: " + data);
        if (status == 200) {
            data = JSON.parse(data);
            for (var i = 0; i < data.length; i++) {
                if (data[i].name == ActuatorBlindName) {
                    actuatorBlind = data[i];
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
                        "Status POST request to update actuator Lamp state: " +
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

    if (actuatorBlind.id && actuator.id) {
        if (sensorValue <= actuator.setting) {
            //fecha
            actuatorBlind.state = 0;
            customWrite(actuatorBlindPin, 1);
        } else {
            //abre até o state
            actuatorBlind.state = 1;

            var read = (actuatorBlind.setting * 160) / 100;
            customWrite(actuatorBlindPin, read);
        }
        // update actuator state on server
        RealHTTPClient.post(
            urlActuatorBlind,
            {
                value: actuatorBlind.value,
                state: actuatorBlind.state ? 1 : 0,
                id: actuatorBlind.id,
            },
            function (status, data) {
                Serial.println(
                    "Status POST request to update actuator Blind state: " +
                        status
                );
                //Serial.println(data);
            }
        );

        Serial.println(
            actuatorBlind.name +
                " setting: " +
                actuatorBlind.setting +
                " state: " +
                actuatorBlind.state
        );
    }

    delay(2000);
}
