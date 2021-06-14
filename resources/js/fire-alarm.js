function getAlarmElement(id, state, disabled) {
    let text = ``;

    if (disabled) {
        text += `<a class="btn btn-outline-warning" href="/actuators/fire-alarms/enabled/${id}"
                role="button">Armar Alarme</a>`;
    }

    if (!state) {
        text += `<span class="text-muted ml-4 mr-2 small">Alarme de incêndio</span>
                <i class="far fa-bell text-muted"></i>`;
    } else {
        text += `<a class="btn btn-outline-danger" href="/actuators/fire-alarms/disabled/${id}"
                role="button">Desligar Alarme</a><span class="text-muted ml-4 mr-2">Alarme de incêndio</span>
                <i class="far fa-bell text-danger on"></i>`;
    }

    return text;
}

const elementAlarm = document.getElementById("fire-alarm-icon");
elementAlarm.innerHTML = getAlarmElement(
    fireAlarm.id,
    !!fireAlarm.state,
    !!fireAlarm.disabled
);

setInterval(() => {
    fetch("/api/actuators/fire-alarms")
        .then((res) => res.json())
        .then((data) => {
            elementAlarm.innerHTML = getAlarmElement(
                data.id,
                data.state,
                data.disabled
            );
        })
        .catch(console.error);
}, 5000);
