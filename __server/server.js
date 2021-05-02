const faker = require("faker");
const express = require("express");
const server = express();
const port = 3333;

server.use(express.json());

const RATE_ERROR = 5;

const usedData = {
    temp: 20,
    hum: 50,
    smoke: 150,
    motion: 0,
};

// Pulbic routes
server.get("/api/sensors/temperatures", (req, res) => {
    const success = faker.datatype.number({ min: 0, max: 100 });
    if (success > RATE_ERROR) {
        usedData.temp += faker.datatype.float({ min: -2.0, max: 2.0 });
        return res.send({
            value: usedData.temp.toFixed(2),
            date: new Date(),
        });
    }

    return res.sendStatus(400);
});
server.get("/api/sensors/humidities", (req, res) => {
    const success = faker.datatype.number({ min: 0, max: 100 });
    if (success > RATE_ERROR) {
        usedData.hum += faker.datatype.float({ min: -0.09, max: 0.09 }) * 100;
        usedData.hum = Math.abs(usedData.hum);
        usedData.hum = usedData.hum > 100 ? 100 : usedData.hum;
        return res.send({
            value: usedData.hum.toFixed(0),
            date: new Date(),
        });
    }

    return res.sendStatus(400);
});
server.get("/api/sensors/lights", (req, res) => {
    const success = faker.datatype.number({ min: 0, max: 100 });
    if (success > RATE_ERROR) {
        return res.send({
            value: faker.datatype.number({ min: 100, max: 5000 }),
            date: new Date(),
        });
    }

    return res.sendStatus(400);
});
server.get("/api/sensors/smokes", (req, res) => {
    const success = faker.datatype.number({ min: 0, max: 100 });
    if (success > RATE_ERROR) {
        return res.send({
            value: faker.datatype.number({ min: 50, max: 500 }),
            date: new Date(),
        });
    }

    return res.sendStatus(400);
});
server.get("/api/sensors/motions", (req, res) => {
    const success = faker.datatype.number({ min: 0, max: 100 });
    if (success > RATE_ERROR) {
        return res.send({
            value: faker.datatype.number({ min: 0, max: 100 }) > 35 ? 0 : 1,
            date: new Date(),
        });
    }

    return res.sendStatus(400);
});

server.post("/api/actuators/blinds", (req, res) => {
    const success = faker.datatype.number({ min: 0, max: 100 });
    if (success > RATE_ERROR) {
        return res.sendStatus(204);
    }

    return res.sendStatus(500);
});
server.post("/api/actuators/air-conditioners", (req, res) => {
    const success = faker.datatype.number({ min: 0, max: 100 });
    if (success > RATE_ERROR) {
        return res.sendStatus(204);
    }

    return res.sendStatus(500);
});
server.post("/api/actuators/doors", (req, res) => {
    const success = faker.datatype.number({ min: 0, max: 100 });
    if (success > RATE_ERROR) {
        return res.sendStatus(204);
    }

    return res.sendStatus(500);
});
server.post("/api/actuators/lamps", (req, res) => {
    const success = faker.datatype.number({ min: 0, max: 100 });
    if (success > RATE_ERROR) {
        return res.sendStatus(204);
    }

    return res.sendStatus(500);
});

// Authenticated routes
server.use((req, res, next) => {
    if (req.headers.authorization === "Bearer token") {
        next();
    } else {
        res.sendStatus(401);
    }
});

server.listen(port, () => {
    console.log(`JSON Server is running on port ${port}`);
});
