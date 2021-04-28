import axios from "axios";
import faker from "faker";
import React, { useState, useEffect, useRef } from "react";

import "./styles.css";

const api = axios.create({
    baseURL: "http://localhost:8000/api",
    headers: {
        "X-Requested-With": "XMLHttpRequest",
        "Content-Type": "application/json",
    },
});

const InputControl = ({ sensor, title, classIconSufix, apiCall }) => {
    const timer = useRef(0);
    const [inputValue, setInputValue] = useState(() => {
        const preData = localStorage.getItem(`@ProjectIoT-g128-${sensor}`);
        if (preData) {
            return preData.split("-")[0];
        }

        return 4;
    });
    const [on, setOn] = useState(() => {
        const preData = localStorage.getItem(`@ProjectIoT-g128-${sensor}`);
        return preData && preData.split("-")[1] === "true";
    });

    const handleChangeInput = (e) => {
        const newValue = e.target.value;
        setInputValue(newValue);
        localStorage.setItem(`@ProjectIoT-g128-${sensor}`, `${newValue}-${on}`);
    };

    const handleClickButton = () => {
        const newValue = !on;
        setOn(newValue);
        localStorage.setItem(
            `@ProjectIoT-g128-${sensor}`,
            `${inputValue}-${newValue}`
        );
    };

    useEffect(() => {
        if (timer.current) window.clearInterval(timer.current);

        if (on) {
            console.log(
                `Starts requests every ${inputValue} seconds for sensor ${sensor}`
            );
            timer.current = window.setInterval(() => {
                console.log(`send request for sensor ${sensor}`);
                apiCall();
            }, Number(inputValue) * 1000);
        } else {
            console.log(`Requests for sensor "${sensor}" stopped`);
        }
    }, [on, inputValue]);

    return (
        <div className="input-control">
            <i className={`bi bi-${classIconSufix}`}></i>
            <p>Atualização da {title} a cada</p>
            <div className="input-buttons">
                <input
                    type="number"
                    onChange={handleChangeInput}
                    value={inputValue}
                />
                <button type="button" onClick={handleClickButton}>
                    {on ? (
                        <i
                            className="bi bi-toggle-on text-success"
                            title="Ligado"
                        ></i>
                    ) : (
                        <i
                            className="bi bi-toggle-off text-danger"
                            title="desligado"
                        ></i>
                    )}
                </button>
            </div>
            <p>segundo(s)</p>
        </div>
    );
};

const ToolBox = () => {
    return (
        <div className="toolbox">
            <div className="sensor">
                <InputControl
                    sensor="temperature"
                    title="Temperatura"
                    classIconSufix="thermometer-half"
                    apiCall={() => {
                        api.post("/sensors/temperatures", {
                            value: faker.datatype
                                .float({ min: -20.0, max: 30.0 })
                                .toFixed(2),
                            date: new Date(),
                        });
                    }}
                />
                <InputControl
                    sensor="humidity"
                    title="Humidade"
                    classIconSufix="moisture"
                    apiCall={() => {
                        api.post("/sensors/humidities", {
                            value: faker.datatype.number({ min: 0, max: 100 }),
                            date: new Date(),
                        });
                    }}
                />
                <InputControl
                    sensor="light"
                    title="Luminosidade"
                    classIconSufix="thermometer-sun"
                    apiCall={() => {
                        api.post("/sensors/lights", {
                            value: faker.datatype.number({ min: 0, max: 5000 }),
                            date: new Date(),
                        });
                    }}
                />
                <InputControl
                    sensor="smoke"
                    title="Fumaça"
                    classIconSufix="wind"
                    apiCall={() => {
                        api.post("/sensors/smokes", {
                            value: faker.datatype.number({ min: 0, max: 500 }),
                            date: new Date(),
                        });
                    }}
                />
            </div>
        </div>
    );
};

const App = () => {
    const [showToolBox, setShowToolBox] = useState(() => {
        const preData = localStorage.getItem("@ProjectIoT-g128-toolbox");
        return preData && preData === "open";
    });

    const handleClickButton = () => {
        localStorage.setItem(
            "@ProjectIoT-g128-toolbox",
            !showToolBox ? "open" : "close"
        );
        setShowToolBox(!showToolBox);
    };

    return (
        <div className="app-demo">
            <div className="button-open-toolbox">
                <button type="button" onClick={handleClickButton}>
                    <p>
                        {showToolBox ? (
                            <i className="bi bi-chevron-right"></i>
                        ) : (
                            <i className="bi bi-chevron-left"></i>
                        )}
                    </p>
                </button>
            </div>

            {showToolBox ? <ToolBox /> : null}
        </div>
    );
};

export default App;
