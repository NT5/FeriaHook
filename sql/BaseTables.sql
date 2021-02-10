CREATE TABLE IF NOT EXISTS `Carreras` (
	`IdCarrara` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador',
	`CodCarrera` INT(11) NOT NULL,
	`NombreCarrera` VARCHAR(50) NOT NULL,
	`CreateAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`IdCarrara`)
)
COMMENT='Lista de las carreras disponibles';

CREATE TABLE IF NOT EXISTS `Asignaturas` (
	`IdAsignatura` INT NOT NULL AUTO_INCREMENT,
	`IdCarrera` INT(11) NOT NULL,
	`CodAsignatura` VARCHAR(50) NOT NULL,
	`NombreAsignatura` VARCHAR(250) NOT NULL,
	`Nivel` INT(11) NOT NULL,
	`CreateAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`IdAsignatura`),
	CONSTRAINT FOREIGN KEY (`IdCarrera`) REFERENCES `Carreras` (`IdCarrara`) ON UPDATE CASCADE ON DELETE CASCADE
)
COMMENT='Lista de asignaturas disponibles';

CREATE TABLE IF NOT EXISTS `Categorias` (
	`IdCategoria` INT NOT NULL AUTO_INCREMENT,
	`NombreCategoria` VARCHAR(50) NOT NULL,
	`CreateAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`IdCategoria`)
);

CREATE TABLE IF NOT EXISTS `CategoriasAsignadas` (
	`IdUser` INT NOT NULL,
	`IdCategoria` INT NOT NULL,
	`CreateAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	CONSTRAINT FOREIGN KEY (`IdUser`) REFERENCES `User_Data` (`User_Id`) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY (`IdCategoria`) REFERENCES `Categorias` (`IdCategoria`) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `Estudiantes` (
	`IdEstudiante` INT NOT NULL AUTO_INCREMENT,
	`CodCarnet` INT NOT NULL,
	`NombreEstudiante` VARCHAR(50) NOT NULL,
	`CreateAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`IdEstudiante`)
);

CREATE TABLE IF NOT EXISTS `Proyectos` (
	`IdProyecto` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador',
	`NombreProyecto` TEXT NOT NULL COMMENT 'Nombre completo del proyecto',
	`Descripcion` TEXT NOT NULL COMMENT 'Breve reseña del proyecto',
	`Internet` TINYINT(1) NOT NULL COMMENT 'Requiere conexion a internet',
	`Electricidad` TINYINT(1) NOT NULL COMMENT 'Requiere electricidad',
	`EsInvestigacion` TINYINT(1) NOT NULL COMMENT 'Es proyecto de investigacion',
	`IdCarrera` INT NOT NULL COMMENT 'Nombre de la carrera',
	`IdAsignatura` INT NOT NULL COMMENT 'Nombre de la asignatura',
	`IdTutor` INT NOT NULL COMMENT 'Nombre del tutor',
	`IdCategoria` INT NOT NULL COMMENT 'Nombre de la categoria',
	`CreateAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`IdProyecto`),
	CONSTRAINT FOREIGN KEY (`IdCarrera`) REFERENCES `Carreras` (`IdCarrara`) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY (`IdAsignatura`) REFERENCES `Asignaturas` (`IdAsignatura`) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY (`IdCategoria`) REFERENCES `Categorias` (`IdCategoria`) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY (`IdTutor`) REFERENCES `User_Data` (`User_Id`) ON UPDATE CASCADE ON DELETE CASCADE
)
COMMENT='Lista de proyectos y detalles';

CREATE TABLE IF NOT EXISTS `ProyectosLikes` (
	`IdLike` INT NOT NULL AUTO_INCREMENT,
	`Device` VARCHAR(255) NOT NULL,
	`IdProyecto` INT NOT NULL,
	UNIQUE KEY(`Device`, `IdProyecto`),
	PRIMARY KEY (`IdLike`),
	CONSTRAINT FOREIGN KEY (`IdProyecto`) REFERENCES `Proyectos` (`IdProyecto`) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `Proyectistas` (
	`IdProyectista` INT NOT NULL AUTO_INCREMENT,
	`CodCarnet` INT NOT NULL,
	`IdProyecto` INT NOT NULL,
	`CreateAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`IdProyectista`),
	CONSTRAINT FOREIGN KEY (`IdProyecto`) REFERENCES `Proyectos` (`IdProyecto`) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `Votacion` (
	`IdVoto` INT NOT NULL AUTO_INCREMENT,
	`IdProyecto` INT NOT NULL,
	`IdUser` INT NOT NULL COMMENT 'Votante',
	`Documento_Score1` INT NOT NULL COMMENT 'El proyecto escrito es presentado de forma clara',
	`Documento_Score2` INT NOT NULL COMMENT 'Calidad de la presentación',
	`Documento_Score3` INT NOT NULL COMMENT 'El proyecto describe los resultados en el mediano y largo plazo',
	`Documento_Score4` INT NOT NULL COMMENT 'Redacción y ortografía',
	`Pertinencia_Score1` INT NOT NULL COMMENT 'Viabilidad técnica de la propuesta',
	`Pertinencia_Score2` INT NOT NULL COMMENT 'El proyecto responde a las líneas de investigación',
	`Pertinencia_Score3` INT NOT NULL COMMENT 'El proyecto describe el problema que se espera',
	`Pertinencia_Score4` INT NOT NULL COMMENT 'El proyecto resuelve problemas concretos',
	`Creatividad_Innovacion_Score1` INT NOT NULL COMMENT 'Originalidad de la solución propuesta',
	`Creatividad_Innovacion_Score2` INT NOT NULL COMMENT 'Solución innovadora',
	`CreateAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`IdVoto`),
	UNIQUE KEY(`IdProyecto`, `IdUser`),
	CONSTRAINT FOREIGN KEY (`IdProyecto`) REFERENCES `Proyectos` (`IdProyecto`) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT FOREIGN KEY (`IdUser`) REFERENCES `User_Data` (`User_Id`) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `Votacion_State` (
	`State` INT NOT NULL,
	`CreateAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
INSERT INTO Votacion_State (State) VALUES(0);

CREATE TABLE IF NOT EXISTS `ProyectosIdeas` (
	`IdProyecto` INT NOT NULL AUTO_INCREMENT,
	`NombreCreador` VARCHAR(250) NOT NULL DEFAULT 'Anónimo',
	`TelefonoCreador` VARCHAR(250) NOT NULL DEFAULT 'Anónimo',
	`CorreoCreador` VARCHAR(250) NOT NULL DEFAULT 'Anónimo',
	`DescripcionProyecto` TEXT NOT NULL,
	`CreateAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`IdProyecto`)
);

CREATE TABLE IF NOT EXISTS `Valoraciones` (
	`IdValoraicon` INT NOT NULL AUTO_INCREMENT,
	`Uuid` TEXT NOT NULL,
	`Score` FLOAT NOT NULL DEFAULT '0',
	`CreateAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`IdValoraicon`)
);