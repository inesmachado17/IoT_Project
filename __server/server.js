const faker = require("faker");
const jsonServer = require("json-server");
const server = jsonServer.create();
const middlewares = jsonServer.defaults();

server.use(middlewares);
server.use(jsonServer.bodyParser);

const usedData = {
    temp: 20,
    hum: 50,
    smoke: 150,
    motion: 0,
};

// Pulbic routes
server.get("/api/sensors/temperatures", (req, res) => {
    const success = faker.datatype.number({ min: 0, max: 100 });
    if (success > 20) {
        usedData.temp += faker.datatype.float({ min: -2.0, max: 2.0 });
        return res.jsonp({
            value: usedData.temp.toFixed(2),
            date: new Date(),
        });
    }

    return res.sendStatus(400);
});
server.get("/api/sensors/humidities", (req, res) => {
    const success = faker.datatype.number({ min: 0, max: 100 });
    if (success > 0) {
        usedData.hum += faker.datatype.float({ min: -0.09, max: 0.09 }) * 100;
        usedData.hum = Math.abs(usedData.hum);
        usedData.hum = usedData.hum > 100 ? 100 : usedData.hum;
        return res.jsonp({
            value: usedData.hum.toFixed(0),
            date: new Date(),
        });
    }

    return res.sendStatus(400);
});
server.get("/api/sensors/lights", (req, res) => {
    const success = faker.datatype.number({ min: 0, max: 100 });
    if (success > 20) {
        return res.jsonp({
            value: faker.datatype.number({ min: 100, max: 5000 }),
            date: new Date(),
        });
    }

    return res.sendStatus(400);
});
server.get("/api/sensors/smokes", (req, res) => {
    const success = faker.datatype.number({ min: 0, max: 100 });
    if (success > 20) {
        return res.jsonp({
            value: faker.datatype.number({ min: 50, max: 500 }),
            date: new Date(),
        });
    }

    return res.sendStatus(400);
});
server.get("/api/sensors/motions", (req, res) => {
    const success = faker.datatype.number({ min: 0, max: 100 });
    if (success > 20) {
        return res.jsonp({
            value: faker.datatype.number({ min: 0, max: 100 }) > 35 ? 0 : 1,
            date: new Date(),
        });
    }

    return res.sendStatus(400);
});

server.post("/api/actuators/blinds", (req, res) => {
    const success = faker.datatype.number({ min: 0, max: 100 });
    if (success > 20) {
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

server.listen(3333, () => {
    console.log("JSON Server is running on port 3333");
});
