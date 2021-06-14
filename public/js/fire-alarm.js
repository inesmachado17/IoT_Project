/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/fire-alarm.js ***!
  \************************************/
function getAlarmElement(id, state, disabled) {
  var text = "";

  if (disabled) {
    text += "<a class=\"btn btn-outline-warning\" href=\"/actuators/fire-alarms/enabled/".concat(id, "\"\n                role=\"button\">Armar Alarme</a>");
  }

  if (!state) {
    text += "<span class=\"text-muted ml-4 mr-2 small\">Alarme de inc\xEAndio</span>\n                <i class=\"far fa-bell text-muted\"></i>";
  } else {
    text += "<a class=\"btn btn-outline-danger\" href=\"/actuators/fire-alarms/disabled/".concat(id, "\"\n                role=\"button\">Desligar Alarme</a><span class=\"text-muted ml-4 mr-2\">Alarme de inc\xEAndio</span>\n                <i class=\"far fa-bell text-danger on\"></i>");
  }

  return text;
}

var elementAlarm = document.getElementById("fire-alarm-icon");
elementAlarm.innerHTML = getAlarmElement(fireAlarm.id, !!fireAlarm.state, !!fireAlarm.disabled);
setInterval(function () {
  fetch("/api/actuators/fire-alarms").then(function (res) {
    return res.json();
  }).then(function (data) {
    elementAlarm.innerHTML = getAlarmElement(data.id, data.state, data.disabled);
  })["catch"](console.error);
}, 5000);
/******/ })()
;