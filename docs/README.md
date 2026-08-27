# Sistema de supermercado

Aplicação web full stack para gerenciamento de produtos, usuários, funcionários,
vendas e avaliações.

O projeto utiliza PHP e PostgreSQL no backend, com um ambiente de
desenvolvimento configurado por Docker. O frontend será desenvolvido
posteriormente com React.

## Sobre o projeto

Este projeto começou como um exercício do curso Técnico em Desenvolvimento de
Sistemas do IFRS e, inicialmente, fazia parte do repositório
`exercicios-ifrs`.

À medida que novas funcionalidades e conceitos foram adicionados, o exercício
cresceu e passou a ter um escopo maior do que a atividade original. Por esse
motivo, ele foi movido para o repositório `sistema-supermercado` e passou a ser
desenvolvido como um projeto individual.

Além de aplicar os conteúdos estudados no curso, o projeto serve como espaço
para praticar organização de código, orientação a objetos, APIs REST,
persistência de dados, conteinerização e integração entre backend e frontend.

## Estado atual

O backend está em desenvolvimento e atualmente conta com:

- Estrutura orientada a objetos em PHP;
- Separação entre controllers, DAOs, models e classes de infraestrutura;
- Autoload PSR-4 com Composer;
- Acesso ao PostgreSQL utilizando PDO;
- Roteamento de requisições;
- Retorno de dados em JSON;
- Ambiente com PHP, Apache e PostgreSQL executado por Docker;
- Scripts para criação e preenchimento inicial do banco de dados.

O frontend em React ainda será implementado. A proposta é que ele consuma os
endpoints disponibilizados pela API PHP.

## Tecnologias

- PHP 8.3;
- Apache;
- PostgreSQL 17;
- Composer;
- PSR-4;
- PDO;
- Docker e Docker Compose;
- React e Vite (planejados para o frontend).

## Como executar

### Pré-requisitos

Para executar todo o ambiente, é necessário ter somente:

- Docker;
- Docker Compose.

Não é necessário instalar PHP, Composer ou PostgreSQL localmente.

### Configuração

Clone o repositório e entre no diretório:

```bash
git clone https://github.com/cauegz/loja-virtual.git
cd loja-virtual
```

Crie o arquivo de ambiente a partir do exemplo:

```bash
cp .env.example .env
```

Preencha o `.env`:

```dotenv
POSTGRES_DBNAME=loja (ou qualquer outro nome)
POSTGRES_USER=(seu usuário do postgres)
POSTGRES_PASS=(sua senha da conexão)
POSTGRES_HOST=db (deve ser db por conta do Docker)
POSTGRES_PORT=(porta da conexão)
```

Construa as imagens e inicie os containers:

```bash
docker compose up --build
```

A API estará disponível em:

```text
http://localhost:8080
```

Para executar em segundo plano:

```bash
docker compose up --build -d
```

Para interromper os serviços:

```bash
docker compose down
```

## Endpoints atuais

### Listar produtos

```http
GET /api/produtos
```

Resposta esperada:

```json
[
    {
        "id_produto": 1,
        "nome": "Notebook",
        "preco": "3500.00",
        "descricao": "Notebook 15 polegadas"
    }
]
```

### Listar só um produto

```http
GET /api/produto/5
```

Resposta esperada:

```json
[
    {
        "id_produto": 5,
        "nome": "Headset",
        "preco": "320.00",
        "descricao": "Headset com microfone"
    }
]
```

Novos endpoints serão adicionados durante o desenvolvimento.

## Banco de dados

O banco contém tabelas para:

- Produtos;
- Usuários;
- Funcionários;
- Vendas;
- Produtos associados às vendas;
- Avaliações.

Na primeira inicialização do volume do PostgreSQL, os arquivos presentes em
`database/` são executados automaticamente para criar e preencher o banco.

Caso os scripts do banco sejam alterados e seja necessário recriar todos os
dados:

```bash
docker compose down -v
docker compose up --build
```

## Próximas etapas

- Implementar as operações completas de cadastro, consulta, atualização e
  exclusão;
- Criar endpoints para usuários, funcionários, vendas e avaliações;
- Adicionar validação e tratamento padronizado de erros;
- Implementar autenticação;
- Desenvolver o frontend com React e Vite;
- Integrar o frontend à API;

## Objetivo

O objetivo é evoluir gradualmente a aplicação enquanto aplico os conhecimentos
adquiridos no curso e estudo novas práticas de desenvolvimento full stack.
