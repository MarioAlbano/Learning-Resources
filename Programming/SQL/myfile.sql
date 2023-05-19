ALTER TABLE empregados ADD COLUMN colunaTeste VARCHAR(50);
ALTER TABLE empregados MODIFY COLUMN colunaTeste INT;
SELECT * FROM empregados;
UPDATE empregados SET colunaTeste = 12345 WHERE id= 01;
INSERT INTO empregados VALUES (2,'Joshua', 34, 'Estudante', '2020-12-12 23:01:02', 2222);
SHOW columns FROM empregados;
SELECT * from empregados WHERE id = 1;
UPDATE empregados SET colunaTeste = 9999 WHERE id = 01;
INSERT INTO empregados (iD, nome, idade, profissao) VALUES(4,'John', 30, 'Futuro Dev');
DELETE FROM empregados WHERE id = 4;
SELECT * FROM empregados;
SELECT idade,nome,profissao FROM empregados WHERE id = 3;
CREATE TABLE banco_talentos (
id INT,
nome VARCHAR(255),
potencial VARCHAR(50)
);
INSERT INTO banco_talentos VALUES (1, 'Jonnhy', 'Alta');
SELECT * FROM banco_talentos;
SELECT * FROM empregados INNER JOIN banco_talentos ON empregados.id = banco_talentos.id;
SELECT * FROM empregados LEFT JOIN banco_talentos ON empregados.id = banco_talentos.id;
SELECT * FROM empregados RIGHT JOIN banco_talentos ON empregados.id = banco_talentos.id;
SELECT SUM(idade) FROM empregados GROUP BY diaContrato;