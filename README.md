# IoT_Project

# Grupo n.º 128

-   2200723 Inês Alexandra Ribeiro Machado
-   2203845 Carlos Filipe de Moura Braz

## Utilizadores pré registados

-   Ambos os utilizadores estão registados com a senha `password`

-   `admin@test.com` com os privilégios de administrador, pondendo aceder às páginas de edição
-   `user@test.com` permissão somente de leitura

## Comprovativos de verificação
- Encontram-se na diretoria w3c-proofs

## Rotas da API do servidor PHP

-   Todas as rotas do tipo POST esperam receber os dados em formato JSON como no exemplo:

```json
{
    "value": 20,
    "date": "2021-04-22T15:00:00.000Z"
}
```

| Rota                           | Descrição                                                      |
| :----------------------------- | :------------------------------------------------------------- |
| POST /api/sensors/temperature  | envio das leituras do sensor de temperatura                    |
| GET /api/sensors/temperature   | recebe a última leitura registada para a temperatura          |
| POST /api/sensors/humidities   | envio das leituras do sensor de humidade                       |
| GET /api/sensors/humidities    | recebe a última leitura registada para a humidade             |
| POST /api/sensors/lights       | envio das leituras do sensor de luminosidade                   |
| GET /api/sensors/lights        | recebe a última leitura registada para a luminosidade         |
| POST /api/sensors/smokes       | envio das leituras do sensor de fumo                          |
| GET /api/sensors/smokes        | recebe a última leitura registada para o fumo               |
| POST /api/sensors/motions      | envio das leituras do sensor de movimento                      |
| GET /api/sensors/motions       | recebe a última leitura registada para a deteção de movimento |
| GET /api/actuators/fire-alarms | informa o estado do alarme de incêndio (disparo)                        |

## Rotas para o servidor HTTP do sistema de IoT (Cisco Packet Tracer)

### a) GETS

| Rota                     | Descrição                                              |
| :----------------------- | :----------------------------------------------------- |
| /api/sensors/temperature | solicita uma leitura do sensor de temperatura          |
| /api/sensors/humidities  | solicita uma leitura do sensor de humidade             |
| /api/sensors/lights      | solicita uma leitura do sensor de luminosidade         |
| /api/sensors/smokes      | solicita uma leitura do sensor de fumo               |
| /api/sensors/motions     | solicita uma leitura do sensor de deteção de movimento |

### b) POSTS

| Rota                       | Descrição                                        |
| :------------------------- | :----------------------------------------------- |
| POST /api/actuators/blinds | envia os parâmetros para o atuador das persianas |

-   Espera receber os dados em formato JSON como no exemplo:

```json
{
"id": <identificador>,
"name": <nome atribuído>,
"state": <percentual de abertura>
}
```

| Rota                      | Descrição                                     |
| :------------------------ | :-------------------------------------------- |
| POST /api/actuators/doors | envia os parâmetros para o atuador das portas |

-   Espera receber os dados em formato JSON como no exemplo:

```json
{
"id": <identificador>,
"state": <estado de abertura da porta>,
"locked": <estado fecho eletrónico>
}
```

| Rota                           | Descrição                                             |
| :----------------------------- | :---------------------------------------------------- |
| POST /api/actuators/sprinklers | envia os parâmetros para o atuador do sistema de rega |

-   Espera receber os dados em formato JSON como no exemplo:

```json
{
"id": <identificador>,
"timer": <valor do temporizador em minutos>,
"state": <ligado ou desligado>
}
```

| Rota                      | Descrição                                       |
| :------------------------ | :---------------------------------------------- |
| POST /api/actuators/lamps | envia os parâmetros para o atuador das lâmpadas |

-   Espera receber os dados em formato JSON como no exemplo:

```json
{
"id": <identificador>,
"setting": <percentual de luminosidade>,
"state": <ligado ou desligado>
}
```

| Rota                                 | Descrição                                               |
| :----------------------------------- | :------------------------------------------------------ |
| POST /api/actuators/air-conditioners | envia os parâmetros para o atuador dos ar condicionados |

-   Espera receber os dados no formato JSON como no exemplo:

```json
{
"id": <identificador>,
"setting": <temperatura em graus>,
"state": <ligado ou desligado>
}
```

| Rota                            | Descrição                                                |
| :------------------------------ | :------------------------------------------------------- |
| POST /api/actuators/fire-alarms | envia os parâmetros para o atuador do alarme de incêndio |

-   Espera receber os dados em formato JSON como no exemplo:

```json
{
"id": <identificador>,
"state": <ligado ou desligado>
}
```
