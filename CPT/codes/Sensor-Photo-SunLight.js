var ENVIRONMENT_NAME = "Sunlight";
var MIN = 0;
var MAX = 100;

function setup() {
    pinMode(A0, OUTPUT);
    pinMode(0, OUTPUT);
}

function loop() {
    var value = Environment.get(ENVIRONMENT_NAME);

    if (value < MIN) value = MIN;
    else if (value > MAX) value = MAX;

    setDeviceProperty(getName(), "level", value);

    value = Math.floor(map(value, MIN, MAX, 0, 255));
    analogWrite(A0, value);

    analogWrite(A0, value);
    digitalWrite(0, value);

    Serial.println(value);

    delay(1000);
}
