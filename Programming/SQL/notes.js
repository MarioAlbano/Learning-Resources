/*//Criando banco
-CREATE DATABASE <nome>
-Teremos uma entidade disponível

//Verificando banco
-SHOW DATABASES

//Removendo banco de dados
-DROP DATABASE <nome>

//Exportando bancos
-mysqldump -u root <nome> > <nome_arquivo_clonado>.sql

//Utilizando banco de dados
-USE <nome>
-Evita conflito de usar uma tabela de outro banco

//O que é tabela
-Entidade que guarda dados
-Possui colunas, que são como categorias. Possuim tipos de dados determinados(textos, números, datas) e atributos(não nulos, chave primária, auto incremento)

//Criando tabelas
-CREATE TABLE <nome> (<coluna><tipo de dado>);
-podemos ter varias colunas de diferente tipos. Mais comum é VARCHAR

//Removendo tabelas
-Todos os dados serão perdidos!
-DROP TABLE <nome>;
-Exportar tabela antes

//Tipos de dados
-Classificam um dados e os limitam
-Texto, numérico, data e espacial

//Tipo de texto
-CHAR(x)
-VARCHAR(x)
-TINYTEXT
-MEDIUMTEXT

//Colocando dados
-INSERT INTO <tabela> (<colunas...>) VALUES (<valores...>)

//Tipos numéricos
-BIT(x)
-TINYINT(x)
-BOOL
-INT(x)

//Tipos de data
-DATE, ex: YYYY-MM-DD
-DATETIME,  ex:YYYY-MM-DD hh:mm:ss
-TIMESTAMP, mesmo que datetime, porém entre 1970 a 2038

//Porque escoher o tipo de dado
-Escolher próximo a nossa necessidade
-Otimizar banco
-Economizar espaço

//Alteração de tabelas
-Adição de colunas
-Remoção de colunas
-Modificar tipo da coluna

//Adicionando nova coluna na tabela
-ALTER TABLE <tabela> ADD COLUMN <nome> <tipo>

//Removendo coluna da tabela
-ALTER TABLE <tabela> DROP COLUMN <nome>

//Modificando coluna
-ALTER TABLE <tabela> MODIFY COLUMN <coluna> <tipo>

//CRUD 
-Create, Read, Update, Delete

//Selecionar todos os dados
-SELECT * FROM <tabela>
-Conforme a escala, a busca fica custosa e lenta

//Selecionar colunas específicas
-SELECT coluna1, coluna2 FROM <tabela>

//Inserindo dados
-INSERT INTO <tabela> (<colunas...>) VALUES (<valores>)

//Where
-Quais registros vamos atualizar
-WHERE id = 1
-Cuidado e sempre inserir WHERE em UPDATE e DELETE
-Dica: usar SELECT antes do UPDATE ou DELETE para termos a certeza do que iremos alterar

//Atualizando dados
-UPDATE tabela SET <coluna=valor> WHERE <condição>

//Deletando dados
-DELETE FROM <tabela> WHERE <condição>

//JOIN
-SELECT * FROM tabela INNER JOIN tabela2 ON tabela.id = tabela2.id
-SELECT * FROM tabela LEFT JOIN tabela2 ON tabela.id = tabela2.id
-SELECT * FROM tabela RIGHT JOIN tabela2 ON tabela.id = tabela2.id

//GROUP BY
-Agroup rows to combine in one row
-SUM(), MAX(), MIN(), AVG(), COUNT()

//ORDER BY
-Used as asc or desc one list

//LIKE
-Search for a specific pattern in a collumn, usefull for find values ex: like 'a%' will return 'amanda'
*/
