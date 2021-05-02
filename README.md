# IoT_Project

# Grupo nº 128

-   2200723 Inês Alexandra Ribeiro Machado
-   2203845 Carlos Filipe de Moura Braz

## Usuários pré cadastrados

-   Ambos os utilizadores estºao cadastrados com a senha `password`

-   `admin@test.com` com os previlégios de administrador, pondendo aceder às páginas de edição
-   `user@test.com` somente leitura das informações

## Rotas da API do servidor PHP

-   Todas as rotas do tipo POST esperam receber os dados no formato JSON como no exemplo:

```json
{
    "value": 20,
    "date": "2021-04-22T15:00:00.000Z"
}
```

| Rota                           | Descrição                                                      |
| :----------------------------- | :------------------------------------------------------------- |
| POST /api/sensors/temperature  | envio das leituras do sensor de temperatura                    |
| GET /api/sensors/temperature   | receber a última leitura registada para a temperatura          |
| POST /api/sensors/humidities   | envio das leituras do sensor de humidade                       |
| GET /api/sensors/humidities    | receber a última leitura registada para a humidade             |
| POST /api/sensors/lights       | envio das leituras do sensor de luminosidade                   |
| GET /api/sensors/lights        | receber a última leitura registada para a luminosidade         |
| POST /api/sensors/smokes       | envio das leituras do sensor de gases                          |
| GET /api/sensors/smokes        | receber a última leitura registada para a fumaça               |
| POST /api/sensors/motions      | envio das leituras do sensor de movimento                      |
| GET /api/sensors/motions       | receber a última leitura registada para a deteção de movimento |
| GET /api/actuators/fire-alarms | informe o estado do alarme de incêndio                         |

## Rotas para o servidor HTTP do sistema de IoT (Cisco Packet Tracer)

### a) GETS

| Rota                     | Descrição                                              |
| :----------------------- | :----------------------------------------------------- |
| /api/sensors/temperature | solicita uma leitura do sensor de temperatura          |
| /api/sensors/humidities  | solicita uma leitura do sensor de humidade             |
| /api/sensors/lights      | solicita uma leitura do sensor de luminosidade         |
| /api/sensors/smokes      | solicita uma leitura do sensor de fumaça               |
| /api/sensors/motions     | solicita uma leitura do sensor de deteção de movimento |

### b) POSTS

| Rota                       | Descrição                                        |
| :------------------------- | :----------------------------------------------- |
| POST /api/actuators/blinds | envia os parametros para o atuador das persianas |

-   Espera receber os dados no formato JSON como no exemplo:

```json
{
"id": <identificador>,
"name": <nome atribuído>,
"state": <percentual de abertura>
}
```

| Rota                      | Descrição                                     |
| :------------------------ | :-------------------------------------------- |
| POST /api/actuators/doors | envia os parametros para o atuador das portas |

-   Espera receber os dados no formato JSON como no exemplo:

```json
{
"id": <identificador>,
"state": <estado de abertura da porta>,
"locked": <estado tranca eletrónica>
}
```

| Rota                           | Descrição                                             |
| :----------------------------- | :---------------------------------------------------- |
| POST /api/actuators/sprinklers | envia os parametros para o atuador do sistema de rega |

-   Espera receber os dados no formato JSON como no exemplo:

```json
{
"id": <identificador>,
"timer": <valor do temporizador em minutos>,
"state": <ligado ou desligado>
}
```

| Rota                      | Descrição                                       |
| :------------------------ | :---------------------------------------------- |
| POST /api/actuators/lamps | envia os parametros para o atuador das lâmpadas |

-   Espera receber os dados no formato JSON como no exemplo:

```json
{
"id": <identificador>,
"setting": <percentual de luminosidade>,
"state": <ligado ou desligado>
}
```

| Rota                                 | Descrição                                               |
| :----------------------------------- | :------------------------------------------------------ |
| POST /api/actuators/air-conditioners | envia os parametros para o atuador dos ar condicionados |

-   Espera receber os dados no formato JSON como no exemplo:

```json
{
"id": <identificador>,
"setting": <temperatura em graus para o qual está configurado>,
"state": <ligado ou desligado>
}
```

| Rota                            | Descrição                                                |
| :------------------------------ | :------------------------------------------------------- |
| POST /api/actuators/fire-alarms | envia os parametros para o atuador do alarme de incêndio |

-   Espera receber os dados no formato JSON como no exemplo:

```json
{
"id": <identificador>,
"state": <ligado ou desligado>
}
```
