
-- Crear tabla tbl_tema
CREATE TABLE Tema (
    Id_Tema INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(30) NOT NULL,
    Clave CHAR(5) NOT NULL
);

-- Crear tabla tbl_Pregunta
CREATE TABLE Pregunta (
    Id_Pregunta INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Id_Autor INT,
    id_Tema INT(6) UNSIGNED,
    Pregunta TEXT NOT NULL,
    Contexto TEXT,
    Hora TIME,
    Fecha DATE,
    Estado TINYINT(1), -- Modificado para ser booleano
    FOREIGN KEY (Id_Autor) REFERENCES Usuario(Id_Usu),
    FOREIGN KEY (id_Tema) REFERENCES Tema(Id_Tema)
);

-- Crear tabla Pregunta
CREATE TABLE Pregunta (
    Id_Pregunta INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Id_Autor INT UNSIGNED,
    Id_Tema INT(6) UNSIGNED,
    Pregunta TEXT NOT NULL,
    Contexto TEXT,
    Hora TIME,
    Fecha DATE,
    Estado TINYINT(1), -- Usado como un campo booleano
    FOREIGN KEY (Id_Autor) REFERENCES Usuario(Id_Usu) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (Id_Tema) REFERENCES Tema(Id_Tema) ON DELETE SET NULL ON UPDATE CASCADE
);