var SMOKE_RATE = 0.8;

var state = 0;

function updateEnvironment() {
    if (state == 1) {
        Environment.setContribution("Smoke", SMOKE_RATE);
    } else {
        Environment.setContribution("Smoke", 0);
    }
}

function setup() {
    state = restoreProperty("state", 0);
    setState(state);
}

function restoreProperty(propertyName, defaultValue) {
    var value = getDeviceProperty(getName(), propertyName);
    if (!(value === "" || value == "undefined")) {
        if (typeof defaultValue == "number") value = Number(value);

        setDeviceProperty(getName(), propertyName, value);
        return value;
    }

    return defaultValue;
}

function mouseEvent(pressed, x, y, firstPress) {
    if (firstPress) setState(state ? 0 : 1);
}

function setState(newState) {
    if (newState === 0) digitalWrite(1, LOW);
    else {
        digitalWrite(1, HIGH);
    }
    state = newState;
    setDeviceProperty(getName(), "state", state);
    updateEnvironment();
}
