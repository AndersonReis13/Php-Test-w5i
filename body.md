# Documentação da API REST em php feita para gerenciar tarefas.

## Introdução ao sistema:

Para conseguir realizar qualquer requizição é necessaito fazer o cadastro e depois o login, para conseguir coletar o token e repassa-lo nos headers (Authorization -> Bearer "seutoken") quando validares as rotas, você terá que cadastrar uma categoria para que as tarefas possam ter uma categoria. E as tarefas terá metodos de criações, pausas e tempo final para fazer o calculo do tempo em que atividade ficou aberta. Vale lembrar que as entradas e saida de dados estão em formato JSON.

## Users

POST: /users/singup -- Tem que passar um email e a senha no campo para autenticar (email e password).
GET: /users/view/{email} -- Tem que passar o email no parametro para a leitura os dados.
POST: /users/singin -- Tem que passar um email e a senha no campo para cadastrar (email e password).

```json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imx1Y2FzQGUuY29tIn0.pyR7V2NyyznNFrXeg0aZGjJ_uxCnaknk3weUrtnG76U",
    "message": "Login feito com sucesso!"
}
```


## Categories

GET: /categories/view - coleta um array contendo todas as categorias salvas

GET: /categories/view/{name} - tem que passar um número no parametro para a leitura de dados

POST: /categories/create - Tem que passar um nome para cadastrar uma categoria (name).

```json
[
    {
        "id": 2,
        "name": "estetico"
    }
]
```

## Tasks



GET: /tasks/view - coleta um array contendo todas as tasks criada.

POST: /tasks/add - Tem que passar um titulo, descrição, usuario id e categoria id para realizar a criação (title, description, user_id, category_id) para cadastrar.

POST: /tasks/start - tem que passar um id para começar a tarefa(id);

POST: /tasks/start - tem que passar um id para começar a tarefa(id);

POST: /tasks/pause - tem que passar um id para pausar a tarefa(id);

POST: /tasks/retume - tem que passar um id para retomar a tarefa(id);

POST: /tasks/finish - tem que passar um id para terminar a tarefa(id);

POST: /tasks/final - tem que passar um id para calcar o tempo total da tarefa(id);

```json
[
    {
        "id": 1,
        "title": "Concertar carros",
        "description": "coletar dados da empresa de software W5I",
        "user_id": 1,
        "category_id": 3,
        "status": "finished",
        "start_time": "2024-09-23 23:52:27",
        "pause_time": "2024-09-23 23:52:42",
        "finish_time": "2024-09-23 23:52:53",
        "total_time": "00:00:26",
        "retume_time": null
    }
]
```