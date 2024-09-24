# Documentação da API REST em php feita para gerenciar tarefas.

## Introdução ao sistema:

Para conseguir realizar qualquer requizição é necessaito fazer o cadastro e depois o login, para conseguir coletar o token e repassa-lo nos headers (Authorization -> Bearer "seutoken") quando validares as rotas, você terá que cadastrar uma categoria para que as tarefas possam ter uma categoria. E as tarefas terá metodos de criações, pausas e tempo final para fazer o calculo do tempo em que atividade ficou aberta.

## Users

POST: /users/singup -- Tem que passr um email e a senha no campo para autenticar.


POST: /users/singin -- Tem que passr um email e a senha no campo para cadastrar.

```json
    {
     "name": "joshua",
     "password": "positivo"
    }


    {
      "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imx1Y2FzQGUuY29tIn0.pyR7V2NyyznNFrXeg0aZGjJ_uxCnaknk3weUrtnG76U",
      "message": "Login feito com sucesso."
}
```