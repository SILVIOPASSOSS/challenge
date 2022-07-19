# challenge
Project of test
# GrupoA - Challenge Test 

Esta aplicação tem como finalidade realizar cadastros.


# Tecnologias usadas

 - **Front-end**
	 - Framework Vue.js (versão 2): 
		 - vue-router: gerenciamento das rotas 
		 - vuetify: Vue UI
	
 - **Bibliotecas de Terceiros**
	- axios: consumo de api
	- vuelidate: realizar validações nos forms de cadastro e edição
	- v-mask: aplicação de máscara 
		 
 - **Back-end**
	 - Framework Laravel (versão 9x):
	 
	 - Fazendo uso do Xampp como servidor:
		 - Apache/2.4.53
		 - PHP: 8.1.6
		 - Versão do servidor: 10.4.24-MariaDB
	 
	 

## Etapas do desenvolvimento

 1. Antes de tudo, configuração do ambiente de desenvolvimento -
 Instalação do Xampp, Composer, Node.js, Instalação do Laravel e VueJs
 Obs: O back-end foi criado em pasta separado do front-end.
 
 2. Após a instalação, criei o banco de dados utilizando o phpmyadmin: "laravel_bd_test".
 3. Adicionado o banco nas configurações do .env no laravel, criei a tabela "students" utilizando migration do laravel.
 4. Criação dos controllers para o CRUD do painel de cadastro
 5. Criação das rotas no back-end
Abaixo segue as rotas configuras no laravel:

| Método HTTP | Préfixo |        Rota       | Função  |
|-------------|--------:|:-----------------:|---------|
| GET         | /api    | /student          | index   |
| GET         | /api    | /student/{id}     | show    |
| POST        | /api    | /student/register | store   |
| DELETE      | /api    | /student/{id}     | destroy |
| PUT         | /api    | /student/{id}     | update  |


No front-end tenho o arquivo config.js

    export const API_BASE_URL =  'http://127.0.0.1:8000/api'
Caso mude a URL do servidor, precisaria apenas substituir 'http://127.0.0.1:8080' pela nova URL deixando apenas o '/api'

 6. Criação da SPA/Front
 Rotas gerenciados pelo VueRouter
 
Segue as páginas abaixo:

| Nome/Página     |   Componente |  Rota/patch |                                                           Método - Função                                                           |
|-----------------|-------------:|:-----------:|:-----------------------------------------------------------------------------------------------------------------------------------:|
| home            | HomeView     | /           | GET - Nesta página está direcionando para exibição de todos os cadastros. DELETE - Contém a opção para "Excluir" determinado aluno. |
| registerStudent | Register.vue | /register   | POST - direciona para a página para cadastrar um novo aluno.                                                                        |
| editStudent     | Edit.vue     | /edit/:id   | PUT - página para editar alguns dados dos alunos.                                                                                   |
| detailStudent   | Detail.vue   | /detail/:id | GET - Página para exibição completa dos dados de determinado aluno                                                                  |
| about           | AboutView    | /about      | Página em branco...apenas demonstração                                                                                              |

 7. Desenvolvimento das páginas:
	 Criação da interface utilizando o Vuetify;
	 Validações dos inputs são feitos com o Vuelidate e algumas customizadas.
	 Não realizei testes unitários "direto no código", todos realizados foram feitos manualmente.

## Publicação - Deploy

 - Front-end hospedado no netlify:
	 - https://vermillion-croquembouche-6fa28e.netlify.app
- Servidor/API - Heroku:
	- https://buildernew.herokuapp.com

## Possíveis Atualizações

 - Melhoria na API desenvolvida;
 - "Dividiria" mais o front-end, em componentes menores e mais reutilizáveis;
 - Criação de páginas de login e register;

# Requisitos obrigatórios

- Não utilização de arquitetura de desenvolvimento
- Testes unitários


## Agradecimentos
Independentemente do resultado desse teste.
Quero deixar meus agradecimentos pela oportunidade concedida.








