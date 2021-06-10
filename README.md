# IoT_Project

# Grupo n.º 128

-   2200723 Inês Alexandra Ribeiro Machado
-   2203845 Carlos Filipe de Moura Braz

## Visualização da aplicação On-line

-   `https://iot.inesmachado.net/`

## Utilizadores pré registados

-   Ambos os utilizadores estão registados com a senha `password`

-   `admin@test.com` com os privilégios de administrador, pondendo aceder às páginas de edição
-   `user@test.com` permissão somente de leitura

## Comprovativos de verificação

-   Encontram-se na diretoria w3c-proofs

## Rotas da API do servidor PHP

-   Todas as rotas do tipo POST esperam receber os dados em formato JSON como no exemplo:

```json
{
    "value": 20,
    "date": "2021-04-22T15:00:00.000Z"
}
```

| Rota                              | Descrição                                                           |
| :-------------------------------- | :------------------------------------------------------------------ |
| POST /api/sensors/temperature     | envio das leituras do sensor de temperatura                         |
| GET /api/sensors/temperature      | recebe a última leitura registada para a temperatura                |
| POST /api/sensors/humidities      | envio das leituras do sensor de humidade                            |
| GET /api/sensors/humidities       | recebe a última leitura registada para a humidade                   |
| POST /api/sensors/lights          | envio das leituras do sensor de luminosidade                        |
| GET /api/sensors/lights           | recebe a última leitura registada para a luminosidade               |
| POST /api/sensors/smokes          | envio das leituras do sensor de fumo                                |
| GET /api/sensors/smokes           | recebe a última leitura registada para o fumo                       |
| POST /api/sensors/motions         | envio das leituras do sensor de movimento                           |
| GET /api/sensors/motions          | recebe a última leitura registada para a deteção de movimento       |
| GET /api/actuators/fire-alarms    | informa o estado do alarme de incêndio (disparo)                    |
| GET /actuators/air-conditionairs  | retorna a lista de ar condicionados e respectivos valores de estado |
| POST /actuators/air-conditionairs | atualiza o estado de funcionamento do ar condicionado               |
| GET /actuators/sprinklers         | retorna a lista de regadores e respectivos valores de estado        |
| POST /actuators/sprinklers        | atualiza o estado de funcionamento do aspersor                      |
