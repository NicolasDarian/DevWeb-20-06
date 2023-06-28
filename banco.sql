CREATE TABLE quadro (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE quadrado (
    id INT NOT NULL AUTO_INCREMENT,
    lado INT NOT NULL,
    cor VARCHAR(45) NOT NULL,
    un VARCHAR(45) NOT NULL,
    id_quadro INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_quadro) REFERENCES quadro (id) ON DELETE CASCADE
);

CREATE TABLE triangulo (
    id INT NOT NULL AUTO_INCREMENT,
    lado1 INT NOT NULL,
    lado2 INT NOT NULL,
    lado3 INT NOT NULL,
    cor VARCHAR(45) NOT NULL,
    un VARCHAR(45) NOT NULL,
    id_quadro INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_quadro) REFERENCES quadro (id) ON DELETE CASCADE
);

CREATE TABLE circulo (
    id INT NOT NULL AUTO_INCREMENT,
    raio INT NOT NULL,
    cor VARCHAR(45) NOT NULL,
    un VARCHAR(45) NOT NULL,
    id_quadro INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_quadro) REFERENCES quadro (id) ON DELETE CASCADE
);

CREATE TABLE retangulo (
    id INT NOT NULL AUTO_INCREMENT,
    base INT NOT NULL,
    altura INT NOT NULL,
    cor VARCHAR(45) NOT NULL,
    un VARCHAR(45) NOT NULL,
    id_quadro INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_quadro) REFERENCES quadro (id) ON DELETE CASCADE
);