# Teste PHP para Desenvolvedor

## Objetivo:
Desenvolver uma ferramenta simples de cadastro de tickets para o setor de atendimento ao cliente da empresa.

## Requisitos:
- Você deve fazer o fork desse projeto no seu repositório;
- Utilizar: Docker, Laravel 5.x e MySQL;
- Devem ser criadas migrations de 3 tabelas relacionadas;

## Escopo:
### 1. Criar uma tela de cadastro de tickets, onde:
- Exista um formulário para cadastrar ticket
- Campos do formulário:
	- Nome do cliente
	- E-mail
	- Número do Pedido
	- Título do ticket
	- Conteúdo do ticket

#### Observação
- Ao cadastrar um ticket:
	- Deverá existir uma validação pelo e-mail informado no formulário:
		- Se não existir:
			- Cadastrar cliente
			- Cadastra o ticket
		- Se existir:
			- Aproveitar cliente já existente
	- Deverá existir uma validação por número do pedido informado no formulário
		- Se existir para outro cliente:
			- Exibir uma mensagem de erro e não realizar o cadastro
		- Se existir para o mesmo cliente:
			- Atualizar as informações do ticket
	- Mostrar uma mensagem de sucesso após executar o cadastro na tela do formulário em branco

- Criar uma tela de relatórios de tickets, onde:
	- Exista um filtro por E-mail e Número do Pedido;
	- Exista paginação de 5 tickets por página;
	- Campos que devem ser exibidos na tela:
		- Numero do ticket;
		- Número do pedido;
		- Título do Pedido;
		- E-mail do cliente;
		- Data de criação do ticket;
- Criar tela de visualização de detalhe do ticket com todos os campos da tabela de tickets


## Executando o projeto

Para inicializar a aplicação e o banco de dados, rodar:
```sh
$ docker-compose up
```

Uma vez iniciado, para criar as tabelas no banco:
```sh
$ docker-compose exec app php artisan migrate:fresh
```

Caso queira preencher as tabelas com alguns dados:
```sh
$ docker-compose exec app php artisan db:seed
```

O projeto possui basicamente 3 páginas:

| Página | Link |
|---|---|
| Novo ticket | [/tickets/create](http://localhost/tickets/create) |
| Listar tickets | [/tickets](http://localhost/tickets/) |
| Detalhes de ticket | /tickets/<ID> (por exemplo, [/tickets/1](http://localhost/tickets/1)) |
