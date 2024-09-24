# Controle de tarefas

Esse projeto é um controle de tarefas que seguem essas regras:

    - Cadastro de categoria da tarefa 
    - Cadastro de responsável 
    - Cadastro de tarefa, vinculando categoria e responsável 

    - Iniciar tarefa (data e hora)
        - não pode iniciar uma tarefa se ela já foi finalizada 
        
    - Pausar tarefa (data e hora)
        - não pode pausar uma tarefa se ela não foi iniciada 
        - não pode pausar uma tarefa se ela já foi finalizada 

    - Finalizar tarefa (data e hora) 
        - não pode finalizar uma tarefa se ela não foi inicializada
        - não pode finalizar uma tarefa se ela já foi finalizada 

    - Demonstrar tarefas com categoria, responsável e suas movimentações de Início, Pausa e Finalização, demonstrando o tempo gasto.

    Aumento no escopo:

    - Foi adicionado um coluna na task chamado "retume" que caso a task seja pausada e depois seja retomada ela pegue o tempo no qual ficou pausada.

    - cadastro de usuario que fica como responsavel

    - apenas usuarios que tiverem seus tokens validados poderão fazer as atualizações/leituras

    - Implementado o sistema de authentificação para rotas de categorias e tarefas

## Índice

- [Tecnologias Usadas](#tecnologias-usadas)
- [Instalação](#instalação)
- [Estrutura](#estrutura)
- [Uso](#uso)
- [OBS](#obs)
- [Licença](#licença)

## Tecnologias Usadas

- PHP
- MySQL
- Composer 
- Firebase JWT

## Instalação

Para utilizar o sistema, é necessário ter um servidor web como o Apache, ele pode ser utilizado com o XAMP que inclusive foi feito para realizar essa aplicação e ter um servidor Mysql configurado.

## Estrutura

O projeto utiliza o padrão de arquitetura MVC (Model-View-Controller), que separa a lógica de negócios da interface do usuário e da manipulação de dados. Abaixo está uma descrição de cada pasta e seu papel no projeto:


## Uso

- **/index**: Arquivo principal que faz o carregamento de toda a aplicação.

- **/src**: Diretorio que é responsavel por agrupar toda a aplicação.

  - **/Config**: Pasta que contém as configuração do banco de dados e informações das rotas (*DBConfig.php* e *RoutesDefault.php* ).

  - **/Controllers**: Pasta que gerencia os dados da requisição e valida dados.

  - **/infra/security**: Pasta que está encarregada de fazer a criação e a verificação de tokens. (*TokenServices.php*)

  - **/Routes**: Pasta que define as rotas da aplicação e mapeia as urls para o controllers.

  - **/Services**: Pasta que faz o processamento de lógica de negócios e interações com o banco de dados.



1. Clone o repositorio para o diretorio do seu servidor web (se estiver utilizando o xamp, tem que ser no htdocs).

2.Configure o banco de dados (em caso de senha coloque o usuario e a senha no arquivo de configuração do banco de dados).

3. O arquivo de estruturas(body.md) terá todas as informações dos endpoints e como realizar cada procedimento com cada requisição.

4. De um composer install para baixar as dependencias do composer.json (para ter acesso ao firebase jwt e psr).

5. pegue o script que está contido no database.script.md e o utilize dentro de algum compilador mysql (pode ser o workbanch).


## OBS


Já havia tocado um pouco em PHP, mas nunca havia feito uma API REST com ele. Foi um pouco diferente do que estava habituado, então não pude adicionar algumas validações, como a verificação de e-mails e ter abordado o php de uma maneira mais "versatil", e não consegui incluir o Docker, que facilitaria no "compartilhamento", evitando ficar fazendo essas configurações extensas, e utilizaria as imagens do Docker. Mas, independente de tudo, ficou como aprendizado, e valeu a pena essa longa jornada.

## Licença

Este projeto é licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para detalhes.





