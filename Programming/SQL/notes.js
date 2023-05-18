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

//Texto gerado pelo chatGPT
As a junior full-stack developer working with SQL, it's important to have a good understanding of fundamental SQL commands to interact with databases effectively. Here are some essential SQL commands that a junior full-stack developer should know:

1. **SELECT**: Used to retrieve data from a database table. It allows you to specify the columns to retrieve, apply filters with the `WHERE` clause, join tables, and perform various other operations.

2. **INSERT INTO**: Used to insert new records into a database table. You provide the table name and the values to be inserted into the corresponding columns.

3. **UPDATE**: Used to modify existing records in a database table. It allows you to update specific columns with new values based on specified conditions using the `WHERE` clause.

4. **DELETE**: Used to delete records from a database table. It allows you to remove specific rows based on specified conditions using the `WHERE` clause.

5. **CREATE TABLE**: Used to create a new database table. You define the table name and its columns along with their data types, constraints, and other attributes.

6. **ALTER TABLE**: Used to modify the structure of an existing database table. It enables you to add, modify, or delete columns, change data types, and perform other structural changes.

7. **DROP TABLE**: Used to delete an entire database table and remove all its data.

8. **JOIN**: Used to combine rows from two or more tables based on related columns. Common join types include `INNER JOIN`, `LEFT JOIN`, `RIGHT JOIN`, and `FULL JOIN`.

9. **GROUP BY**: Used in conjunction with aggregate functions like `SUM`, `COUNT`, `AVG`, etc., to group rows based on specified columns.

10. **ORDER BY**: Used to sort the result set in ascending or descending order based on one or more columns.

11. **WHERE**: Used to filter rows based on specified conditions in `SELECT`, `UPDATE`, or `DELETE` statements.

12. **LIKE**: Used in conjunction with the `WHERE` clause to search for patterns in string values using wildcard characters (`%` and `_`).

These are some of the essential SQL commands that a junior full-stack developer should be familiar with. Understanding these commands will provide a solid foundation for working with databases and performing common database operations.
*/
