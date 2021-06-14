var fireAlarmUrl = "http://localhost:8000/api/actuators/fire-alarms";
var text = "disabled";

var level = 0;

function setup() {
    IoEClient.setup({
        type: "ApiAlarmState",
        states: [
            {
                name: "Disabled",
                type: "number",
                controllable: false,
            },
        ],
    });

    detect();

    text = level ? "disabled" : "enabled";
    setCustomText(35, 20, 200, 20, text);
}

function loop() {
    detect();
    delay(2000);
}

function detect() {
    RealHTTPClient.get(fireAlarmUrl, function (status, data) {
        Serial.println(
            "Status GET request to fire alarm values: " + status + " data:"
        );

        if (status == 200) {
            Serial.println(data);
            var temp = JSON.parse(data);
            setLevel(temp.disabled);
        }
    });
}

function setLevel(newLevel) {
    Serial.println(level + " -> " + newLevel);
    if (level == newLevel) return;

    level = newLevel;
    text = level ? "disabled" : "enabled";

    setCustomText(35, 20, 200, 20, text);
    IoEClient.reportStates(level);
    setDeviceProperty(getName(), "level", level);
}
