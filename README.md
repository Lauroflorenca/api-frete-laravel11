# API de Frete

## Descrição

Esta API RESTful foi desenvolvida com Laravel 11 e serve para gerenciar viagens e checkpoints de um sistema de frete. Ela inclui autenticação JWT para proteger as rotas, documentação da API gerada via Swagger e rotas para listar, criar, editar e desativar viagens e checkpoints.

## Requisitos

- PHP 8.1+
- Composer
- MySQL
- Laravel 11

## Instalação

1. Clone o repositório:

   ```bash
   git clone https://github.com/Lauroflorenca/api-frete-laravel11.git
   ```

2. Instale as dependências do projeto:

    ```bash
    composer install
    ```

3. Gere a chave da aplicação:

    ```bash
    php artisan key:generate
    ```

4. Instale o pacote JWT:

    ```bash
    php artisan jwt:secret
    ```

5. Execute as migrações e as seeders para popular o banco de dados:

    ```bash
    php artisan migrate
    ```

6. Inicie o servidor:

    ```bash
    php artisan serve
    ```

## Autenticação JWT
A autenticação JWT (JSON Web Token) é usada para proteger as rotas da API. Para acessar rotas protegidas, o usuário precisa estar autenticado e enviar o token JWT no cabeçalho Authorization com o prefixo Bearer.

## Geração do Token de Acesso
## Login
POST /api/login

Enviar e-mail e senha do usuário no corpo da requisição.

Se as credenciais estiverem corretas, será retornado um token JWT no formato:

    
    {
        "access_token": "token",
        "token_type": "Bearer",
        "expires_in": 3600
    }

## Logout
Logout
POST /api/logout

Requer o token JWT no cabeçalho Authorization. O usuário será desconectado e o token será invalidado.
Exemplo de uso do cabeçalho Authorization
Para acessar rotas que exigem autenticação, o token JWT retornado no login deve ser enviado no cabeçalho da requisição:


Authorization: Bearer token


## Rotas Principais

## Viagens

```http
GET /api/viagens
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `Nenhum`    | `-`        | Retorna todas as viagens disponíveis         |


```http
GET /api/viagens/{id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`        | `integer`  | **Obrigatório**. O ID da viagem que você deseja obter |


```http
POST /api/viagens
```

| Parâmetro    | Tipo      | Descrição                                   |
| :----------- | :-------- | :------------------------------------------ |
| `titulo`     | `string`  | **Obrigatório**. O título da viagem         |
| `descricao`  | `text`    | **Obrigatório**. A descrição da viagem      |
| `motorista`  | `string`  | **Obrigatório**. O nome do motorista        |
| `placa`      | `string`  | **Obrigatório**. A placa do veículo         |
| `dt_origem`  | `date`    | **Obrigatório**. Data e hora da origem      |
| `dt_destino` | `date`    | **Obrigatório**. Data e hora do destino     |
| `origem`     | `string`  | **Obrigatório**. O local de origem          |
| `destino`    | `string`  | **Obrigatório**. O local de destino         |
| `conteudo`   | `text`    | **Obrigatório**. O conteúdo transportado    |


```http
PUT /api/viagens/{id}
```

| Parâmetro    | Tipo      | Descrição                                   |
| :----------- | :-------- | :------------------------------------------ |
| `id`         | `integer` | **Obrigatório**. O ID da viagem a ser atualizada |
| Outros campos | Varia    | Qualquer campo da viagem que você deseja atualizar |


```http
DELETE /api/viagens/{id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`        | `integer`  | **Obrigatório**. O ID da viagem a ser desativada (não removida) |


```http
GET /api/viagens/{id}/checkpoints
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`        | `integer`  | **Obrigatório**. O ID da viagem para listar os checkpoints |


## Checkpoints

```http
POST /api/checkpoints
```

| Parâmetro      | Tipo      | Descrição                                   |
| :------------- | :-------- | :------------------------------------------ |
| `local`        | `string`  | **Obrigatório**. O local do checkpoint      |
| `ordem`        | `integer` | **Obrigatório**. A ordem do checkpoint      |
| `chegada`      | `datetime`| Data e hora de chegada (opcional)           |
| `observacao`   | `string`  | Observações (opcional)                      |
| `viagem_id`    | `integer` | **Obrigatório**. O ID da viagem relacionada |


```http
PUT /api/checkpoints/{id}
```

| Parâmetro      | Tipo      | Descrição                                   |
| :------------- | :-------- | :------------------------------------------ |
| `id`           | `integer` | **Obrigatório**. O ID do checkpoint a ser atualizado |


```http
PATCH /api/checkpoints/{id}/chegada
```

| Parâmetro      | Tipo      | Descrição                                   |
| :------------- | :-------- | :------------------------------------------ |
| `id`           | `integer` | **Obrigatório**. O ID do checkpoint a ser atualizado |
| `chegada`      | `datetime`| **Obrigatório**. Data e hora de chegada     |


```http
DELETE /api/checkpoints/{id}
```

| Parâmetro      | Tipo      | Descrição                                   |
| :------------- | :-------- | :------------------------------------------ |
| `id`           | `integer` | **Obrigatório**. O ID do checkpoint a ser desativado (não removido) |


## Utilitários

## Criação de usuário rápido
```http
GET /criaUser
```
Cria um usuário com dados aleatórios para facilitar os testes e retorna os dados do novo usuário.

## Documentação da API
A documentação completa da API pode ser acessada em:

```http
GET /api/documentation
```



## Testes
Para rodar os testes das rotas, você pode utilizar o PHPUnit, que já vem configurado no Laravel. Execute os testes com o comando:

    php artisan test


## Autor
Lauro Florença 

## Licença
[MIT](https://choosealicense.com/licenses/mit/)
