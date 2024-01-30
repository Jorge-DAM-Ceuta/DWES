CREATE DATABASE dwes DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;

USE dwes;

CREATE TABLE tienda (
  cod INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  tlf VARCHAR(13) NULL
) ENGINE = INNODB;

CREATE TABLE producto (
  cod VARCHAR(12) NOT NULL,
  nombre VARCHAR(200) NULL,
  nombre_corto VARCHAR(50) NOT NULL,
  descripcion TEXT NULL,
  PVP DECIMAL(10, 2) NOT NULL,
  familia VARCHAR(6) NOT NULL,
  PRIMARY KEY (cod),
  INDEX (familia),
  UNIQUE (nombre_corto)
) ENGINE = INNODB;

CREATE TABLE familia (
  cod VARCHAR(6) NOT NULL,
  nombre VARCHAR(200) NOT NULL,
  PRIMARY KEY (cod)
) ENGINE = INNODB;

CREATE TABLE stock (
  producto VARCHAR(12) NOT NULL,
  tienda INT NOT NULL,
  unidades INT NOT NULL,
  PRIMARY KEY (producto, tienda),
  FOREIGN KEY (producto) REFERENCES producto(cod) ON UPDATE CASCADE,
  FOREIGN KEY (tienda) REFERENCES tienda(cod) ON UPDATE CASCADE
);

CREATE USER dwes IDENTIFIED BY 'root';
GRANT ALL ON dwes.* TO dwes;
