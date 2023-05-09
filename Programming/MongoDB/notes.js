/*
//Relacional x Não relacional
-Relacional demandam forte configuração
-Não relacionais não são rigorosos
-Relacional: Flexibilidade / Não Relacional: Desorganização

//MongoDB
-Bando não relacional mais utilizado
-Dados inseridos em formao de objeto (JSON)
-Comando em métodos, podemos criar relações entre entdades, adaptável e é próximo do javascript

//Instalação
-MongoDB
-MongoDB tools

//Principais entidades
-Database: onde fica collections e dados
-Collections: são como tabelas, serve para inserir os dados
-Documents: São os dados
-Collections podem ser criadas livremente a qualquer momento e não possuem colunas fixas para os dados

//Criando um banco de dados
-usar 'mongosh' no terminal
-usar 'show dbs' para ver os bancos
-usar 'use primeirobanco' para criar um banco
-Criar collection: 'db.primeiracollection.intertOne({ nome: "Mario", idade: 30})'
-Para achar o dado: db.primeiracollection.findOne({})
 */
