CREATE DATABASE BaseDatosCrud23;

use BaseDatosCrud23;

CREATE TABLE alumnos23 (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(30) NOT NULL,
        apellido VARCHAR(30) NOT NULL,
        edad INT(3),
        numContacto INT(12),
        email VARCHAR(50) NOT NULL,
        paginaWeb VARCHAR(90) NOT NULL

);
