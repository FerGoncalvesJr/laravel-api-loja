# CRUD de Produtos e Lojas

Esse repositório contém um CRUD de produtos e lojas construído em PHP com o framework Laravel. O CRUD permite a criação, leitura, atualização e exclusão de produtos e lojas, mantendo a integridade referencial entre as tabelas.

## Requisitos:
PHP >= 8.1
Composer
MySQL

## Instalação:
Faça o clone deste repositório:
git clone https://github.com/FerGoncalvesJr/laravel-api-loja.git

Entre no diretório do projeto:
```sh
cd laravel-api-loja
```
## Build + Up containers
```sh
./vendor/bin/sail up -d
```

## Instale as dependências:
```sh
composer install
```
Faça uma cópia do arquivo .env.example e renomeie-o para .env. Em seguida, edite o arquivo .env para configurar as credenciais do banco de dados.
```sh
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=fiqon
DB_USERNAME=sail
DB_PASSWORD=password
```
## Gere a chave da aplicação:
```sh
./vendor/bin/sail artisan key:generate
```

## Crie as tabelas no banco de dados:
```sh
./vendor/bin/sail artisan migrate
```

## Utilização:
Você pode utilizar o CRUD através da API RESTful disponibilizada. As rotas e parâmetros disponíveis estão descritos abaixo.

Rotas:
GET /api/produtos - Retorna a lista de produtos cadastrados.

GET /api/produtos/{id} - Retorna as informações de um produto específico.

POST /api/produtos - Cria um novo produto.

PUT /api/produtos/{id} - Atualiza as informações de um produto existente.

DELETE /api/produtos/{id} - Deleta um produto existente.

GET /api/lojas - Retorna a lista de lojas cadastradas.

GET /api/lojas/{id} - Retorna as informações de uma loja específica.

POST /api/lojas - Cria uma nova loja.

PUT /api/lojas/{id} - Atualiza as informações de uma loja existente.

DELETE /api/lojas/{id} - Deleta uma loja existente.

Produtos:
Parâmetros
nome - Nome do produto. Deve ser uma string com no mínimo 3 e no máximo 60 caracteres.
valor - Valor do produto. Deve ser um número inteiro entre 01 e 999999.
loja_id - ID da loja à qual o produto pertence. Deve ser um número inteiro correspondente ao ID de uma loja existente.
ativo - Indica se o produto está ativo ou não. Deve ser um valor booleano (true ou false).
estoque - Quantidade de unidades em estoque do produto. Deve ser um número inteiro entre 0 e 99999.

Exemplo de uso
Para criar um novo produto, envie uma requisição POST para /api/produtos com o seguinte corpo:
{
    "nome": "Produto Exemplo",
    "valor": 3500,
    "loja_id": 1,
    "ativo": true,
    "estoque": 50
}

A resposta da requisição será um objeto JSON contendo as informações do produto criado, incluindo o ID gerado automaticamente pelo banco de dadose o campo data no formato d/m/Y:
{
    "id": 1,
    "nome": "Produto Exemplo",
    "valor": 3500,
    "loja_id": 1,
    "ativo": true,
    "estoque": 50,
    "data": "22\/02\/2023"
}

Lojas:
Parâmetros
nome - Nome da loja. Deve ser uma string com no mínimo 3 e no máximo 40 caracteres.
email - Email da loja. Deve ser do tipo email e com valor unico.

Exemplo de uso
Para criar um novo produto, envie uma requisição POST para /api/lojas com o seguinte corpo:
{
    "nome": "Loja Exemplo",
    "email": "exemplo@exemplo.com"
}

A resposta da requisição será um objeto JSON contendo as informações da loja criada, incluindo o ID gerado automaticamente pelo banco de dados:
{
    "id": 1,
    "nome": "Loja Exemplo",
    "email": "exemplo@exemplo.com"
}