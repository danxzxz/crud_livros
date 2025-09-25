/*
Modelo de base de dados inicial para a implementação do CRUD Jogadores
*/
CREATE DATABASE IF NOT EXISTS crud_livros;
USE crud_livros;

/* TABELA idiomas */
CREATE TABLE IF NOT EXISTS idiomas ( 
  id int AUTO_INCREMENT NOT NULL, 
  idioma varchar(70) NOT NULL,
  CONSTRAINT pk_idiomas PRIMARY KEY (id) 
);

/* Limpa a tabela antes de inserir */
DELETE FROM idiomas;

/* INSERTs idiomas */
INSERT INTO idiomas (idioma) VALUES ('Ingles');
INSERT INTO idiomas (idioma) VALUES ('Portugues');

/* TABELA livros */
CREATE TABLE IF NOT EXISTS livros (
  id int AUTO_INCREMENT NOT NULL, 
  titulo varchar(70) NOT NULL, 
  ano_publicacao int NOT NULL,
  autor varchar(70) NOT NULL, /* S=Sim, N=Não */
  id_idioma int NOT NULL, 
  CONSTRAINT pk_livros PRIMARY KEY (id)
);


ALTER TABLE livros ADD CONSTRAINT FOREIGN KEY (id_idioma) REFERENCES idiomas (id);


CREATE TABLE IF NOT EXISTS generos (
  id INT AUTO_INCREMENT NOT NULL,
  genero VARCHAR(50) NOT NULL,
  CONSTRAINT pk_generos PRIMARY KEY (id)
);

-- Insira algumas posições
INSERT INTO generos (genero) VALUES ('Drama');
INSERT INTO generos (genero) VALUES ('Comedia');
INSERT INTO generos (genero) VALUES ('Romance');


ALTER TABLE livros ADD COLUMN id_genero INT NOT NULL;
ALTER TABLE livros ADD CONSTRAINT fk_genero FOREIGN KEY (id_genero) REFERENCES generos(id);

ALTER TABLE livros ADD COLUMN capa VARCHAR(255) DEFAULT NULL;
