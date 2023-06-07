CREATE DATABASE Runa_blanca;

CREATE TABLE socios (
    id_socio INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellido1 VARCHAR(50) NOT NULL,
    apellido2 VARCHAR(50) NOT NULL,
    correo VARCHAR(50) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    localidad VARCHAR(50) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    contrasenia VARCHAR(100) NOT NULL,
    permiso BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY(id_socio)
) engine=innodb;


INSERT INTO socios VALUES (1,"Asociacion Runa Blanca", "Runa", "Blanca", "asociacionRunaBlanca@gmail.com", "666778899", "Marchamalo", "03-05-21", "1", 1);
-- nombres aleatorios
INSERT INTO socios (nombre, apellido1, apellido2, correo, telefono, localidad, fecha_nacimiento, contrasenia)
VALUES 
("Daniel", "Agustín", "Arroyo", "danielagustin87@gmail.com", "676933835", "Guadalajara", "87-09-16", "1"),
("Juan", "García", "Fernández", "juangf@gmail.com", "666555444", "Madrid", "1990-02-14", "1"),
("Laura", "Hernández", "Sánchez", "laurahs@gmail.com", "677888999", "Barcelona", "1985-07-22", "1"),
("Pedro", "Martínez", "Gómez", "pedromg@gmail.com", "644333222", "Valencia", "1995-05-11", "1"),
("Sofía", "López", "González", "sofialg@gmail.com", "655444333", "Sevilla", "1988-09-30", "1"),
("María", "García", "Martínez", "mariaggm@gmail.com", "699111222", "Zaragoza", "1992-04-01", "1"),
("Antonio", "Pérez", "Ruiz", "antoniopr@gmail.com", "688555222", "Málaga", "1983-11-25", "1"),
("Ana", "González", "Pérez", "anagp@gmail.com", "666222111", "Bilbao", "1998-08-12", "1"),
("Javier", "Fernández", "López", "javierfl@gmail.com", "655666777", "Granada", "1986-01-08", "1"),
("Marta", "Sánchez", "Hernández", "martash@gmail.com", "677333888", "Valladolid", "1991-06-17", "1"),
("Rubén", "Gómez", "Martínez", "rubengm@gmail.com", "699222333", "Alicante", "1996-03-04", "1"),
("Natalia", "Ruiz", "García", "nataliarg@gmail.com", "655777888", "Murcia", "1989-12-19", "1"),
("David", "López", "Pérez", "davidlp@gmail.com", "688666555", "Córdoba", "1993-10-27", "1"),
("Cristina", "Pérez", "Sánchez", "cristinaps@gmail.com", "677444111", "Santander", "1984-02-03", "1"),
("Alejandro", "García", "Fernández", "alejandrogf@gmail.com", "699333222", "Gijón", "1997-07-31", "1"),
("Lucía", "Hernández", "González", "luciahg@gmail.com", "688777444", "Pamplona", "1994-09-23", "1"),
("Manuel", "Martínez", "Sánchez", "manuelms@gmail.com", "677111333", "Cádiz", "1987-05-16", "1"),
("Sara", "González", "Martínez", "saragm@gmail.com", "666444111", "Guadalajara", "1986-01-08", "1");
-- INSERT INTO socios (nombre, apellido1, apellido2, correo, telefono, localidad, fecha_nacimiento, contrasenia)
-- VALUES 
-- ("Daniel", "Juarez", "Arroyo", "danielagustin87@gmail.com", "698552211", "Guadalajara", "87-09-16", "1");

SELECT * FROM socios;
UPDATE socios SET contrasenia = SHA1(123) WHERE id_socio = 17;


CREATE TABLE juegos (
    id_juego INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    editorial VARCHAR(50) NOT NULL,
    min_jugadores INT(3) NOT NULL,
    max_jugadores INT(3) NOT NULL,
    fecha_publicacion DATE,
    fecha_adquisicion DATE NOT NULL,
    mecanica VARCHAR (50) NOT NULL,
    edad int(4) NOT NULL,
    coste DECIMAL NOT NULL,
    reservado BOOLEAN NOT NULL DEFAULT 0,
    cambio_socio INT(4) NOT NULL DEFAULT 0,
    PRIMARY KEY(id_juego)
) engine=innodb;

-- INSERT INTO juegos (nombre, editorial, min_jugadores, max_jugadores, fecha_publicacion, fecha_adquisicion, mecanica, 
-- edad, coste, reservado, cambio_socio) 
-- VALUES ("Blood Rage", "Edge", 2, 4, "15-05-22", "18-03-10", "Mayorias", 14, 89.99, 0, 0);

 SELECT * from juegos WHERE reservado = 1;


INSERT INTO juegos (nombre, editorial, min_jugadores, max_jugadores, fecha_publicacion, fecha_adquisicion, mecanica,
edad, coste, reservado, cambio_socio) VALUES
("7 Wonders", "Repos Production", 3, 7, "2010-11-05", "2022-03-18", "Construcción de cartas", 10, 39.99, 0, 0),
("Agrícola", "Devir Iberia", 1, 5, "2016-04-25", "2020-12-09", "Colocación de trabajadores", 12, 49.99, 1, 0),
("Azul", "Next Move Games", 2, 4, "2017-11-21", "2021-09-12", "Colocación de losetas", 8, 39.99, 0, 1),
("Autos Locos", "Ludonova", 2, 6, "2019-10-31", "2021-06-05", "Carrera", 8, 49.99, 0, 0),
("Bang!", "daVinci Games", 4, 7, "2002-07-31", "2019-05-23", "Roles ocultos", 8, 24.99, 1, 0),
("Bunny Kingdom", "IELLO", 2, 4, "2017-09-14", "2020-02-29", "Mayorias", 12, 49.99, 0, 0),
("Blood Rage", "Edge", 2, 4, "15-05-22", "18-03-10", "Mayorias", 14, 89.99, 0, 0),
("Camel Up", "Z-Man Games", 2, 8, "2014-06-01", "2018-11-14", "Apuestas", 8, 34.99, 0, 0),
("Carcassonne", "Hans im Glück", 2, 5, "2000-10-21", "2022-01-07", "Colocación de losetas", 7, 29.99, 0, 0),
("Catan", "Devir Iberia", 3, 4, "1995-10-18", "2018-05-09", "Gestió de recursos", 10, 44.99, 0, 1),
("Colt Express", "Ludonaute", 2, 6, "2014-11-14", "2019-08-01", "Programación de acciones", 10, 29.99, 0, 0),
("Cocos Locos", "Mercurio", 2, 4, "2018-05-10", "2020-01-15", "Memoria y observación", 5, 19.99, 0, 0),
("Código Secreto", "Czech Games Edition", 2, 8, "2015-09-01", "2020-05-20", "Roles ocultos", 10, 19.99, 0, 0),
("Crokinole", "Mayday Games", 2, 4, "01-01-70", "22-11-19", "Habilidad", 8, 199.99, 0, 0),
("Cubirds", "Devir", 2, 5, "01-01-17", "10-10-19", "Cartas", 8, 15.99, 0, 0),
("Dinosaur Island", "Pandasaurus Games", 1, 4, "01-10-17", "05-06-19", "Colocación de trabajadores, Gestión de recursos", 10, 59.99, 0, 0),
("El Grande", "Devir", 2, 5, "01-01-95", "06-12-15", "Control de áreas, Control de mayorías", 12, 37.95, 0, 0),
("Five Tribes", "Days of Wonder", 2, 4, "01-01-14", "12-05-17", "Colocación de trabajadores", 13, 59.99, 0, 0),
("Fórmula D", "Asmodee", 2, 10, "01-01-91", "06-05-18", "Lanzamiento de dados", 10, 39.95, 0, 0),
("Fresco", "Queen Games", 2, 4, "01-01-10", "02-09-15", "Gestión de recursos", 10, 39.99, 0, 0),
("Gaia Proyect", "Maldito Games", 1, 5, "01-01-17", "12-02-20", "Gestión de recursos", 12, 79.99, 0, 0),
("Great Western Trail", "Maldito Games", 2, 4, "15-07-16", "17-05-22", "Construcción de mazo", 14, 39.95, 0, 0),
("Imagine", "Asmodee", 3, 8, "15-08-18", "19-01-05", "Adivinación, creatividad", 12, 21.95, 0, 0),
("Jungle Speed", "Asmodee", 2, 10, "15-03-20", "18-08-10", "Habilidad", 7, 19.99, 0, 0),
("Junkart", "Haba", 3, 8, "16-01-01", "17-10-22", "Construcción de objetos", 8, 44.99, 0, 0),
("King of New York", "Edge", 2, 6, "14-11-05", "16-09-11", "Dados, monstruos", 14, 44.99, 0, 0),
("Keystone", "Devir", 2, 4, "21-05-27", "21-06-05", "Construcción de mazo, colocación de trabajadores", 14, 39.99, 0, 0),
("La Isla Prohibida", "Devir", 2, 4, "10-05-21", "21-03-09", "Cooperativo, estrategia", 10, 19.99, 0, 0),
("La Tripulación", "Goliath", 2, 4, "01-04-20", "22-08-21", "Cartas", 10, 12.99, 0, 0),
("Lacrimosa", "Abba", 3, 5, "01-01-21", "10-02-21", "Tablero y cartas", 16, 42.99, 0, 0),
("Marco Polo", "Devir", 2, 4, "01-01-15", "12-05-18", "Colocación de dados", 14, 39.99, 0, 0),
("Misión Planeta Rojo", "Gen-X", 2, 4, "01-11-20", "22-05-21", "Mayorias", 12, 31.99, 0, 0),
("Monolith Arena", "Portal Games", 2, 4, "01-08-18", "10-06-19", "Tablero y cartas", 10, 34.99, 0, 0),
("No Game Over", "GDM Games", 2, 5, "01-06-18", "22-09-18", "Rol y narrativa", 16, 34.99, 0, 0),
("Oceanos", "Iello", 2, 5, "01-08-19", "15-06-20", "Draft de cartas", 8, 29.99, 0, 0),
("Palacio de Jabba", "Asmodee", 2, 5, "01-01-18", "21-02-11", "Cartas, Dados, Puntos de Acción", 12, 29.99, 0, 0),
("Photosynthesis", "GDM Games", 2, 4, "01-01-17", "19-10-15", "Colocación de trabajadores, Gestión de recursos", 10, 39.99, 0, 0),
("Potion Explosion", "Edge", 2, 4, "01-01-15", "16-09-10", "Colocación de fichas, Colección de sets", 8, 44.99, 0, 0),
("Roll Player", "Arrakis Games", 1, 4, "01-01-16", "19-07-13", "Colocación de dados, Gestión de personajes", 10, 49.99, 0, 0),
("Russian Railroads", "Devir", 2, 4, "01-01-13", "15-08-07", "Colocación de trabajadores, Gestión de recursos", 12, 54.99, 0, 0),
("Sagrada", "Edge", 1, 4, "01-01-17", "19-02-09", "Colocación de dados", 8, 44.99, 0, 0),
("Sheriff de Nottingham", "Devir", 3, 5, "01-01-14", "14-04-06", "Negociación, Engaño", 14, 29.99, 0, 0),
("Small World", "Days of Wonder", 2, 5, "01-01-09", "21-04-10", "Control de Áreas", 10, 44.99, 0, 0),
("Stone Age", "Devir", 2, 4, "15-10-08", "19-11-17", "Colocacion de trabajadores", 10, 47.95, 0, 0),
("The Island", "Ludonova", 1, 5, "20-11-19", "21-03-23", "Puteo", 10, 23.95, 0, 0),
("Times Up", "Repos Production", 4, 12, "99-01-01", "20-08-09", "Adivinanza, Tiempo", 12, 29.95, 0, 0),
("Tzolk'in", "CGE", 2, 4, "12-05-12", "19-08-06", "Colocacion de trabajadores, Gestión de recursos", 13, 49.95, 0, 0),
("Virus", "Tranjis Games", 2, 6, "17-03-17", "20-06-29", "Cartas", 8, 16.95, 0, 0),
("Wingspan", "Stonemaier Games", 1, 5, "19-03-08", "21-01-15", "Gestion de mano, Drafting", 10, 64.95, 0, 0),
("Yangtze", "Repos Production", 2, 4, "20-03-26", "21-03-23", "Gestion de mano", 14, 37.95, 0, 0),
("Zombicide Black Plague", "Edge", 1, 6, "01-10-15", "17-08-16", "Cooperativo, Supervivencia", 14, 89.99, 0, 0),
("Charlestone", "Devir", 2, 5, "01-01-13", "20-02-15", "Gestión de recursos", 12, 29.99, 0, 0),
("Cottage Garden", "Devir", 1, 4, "01-01-16", "20-03-18", "Colocación de losetas, Puzzles", 8, 34.99, 0, 0),
("Fuji", "Mercurio", 2, 4, "01-01-16", "19-07-17", "Control de áreas, Movimiento programado", 10, 29.99, 0, 0),
("Herbáceas", "Devir", 1, 4, "01-01-14", "18-11-15", "Colocación de trabajadores, Gestión de recursos", 12, 34.99, 0, 0),
("Noria", "Devir", 2, 4, "30-03-2018", "10-06-2021", "Colocación de trabajadores", 12, 65.95, 0, 0),
("Riverboat", "Pegasus Spiele", 2, 4, "28-03-2017", "05-08-2020", "Gestión de recursos", 12, 39.99, 0, 0),
("Topito", "Mercurio Distribuciones", 2, 6, "2016", "06-09-2021", "Memoria, Aventuras", 4, 14.95, 0, 0),
("Rodas", "Devir", 2, 5, "22-09-2017", "16-02-2021", "Colocación de trabajadores", 14, 49.99, 0, 0);


select cambio_socio FROM juegos WHERE nombre = "Agrícola";
 
UPDATE juegos SET cambio_socio = cambio_socio + 1 WHERE nombre = "Agrícola";

SELECT * FROM juegos;


ALTER TABLE juegos ADD COLUMN ruta_foto VARCHAR(100);

update juegos set ruta_foto = "./img/juegos/Crokinole.jpg"  
 where nombre = "Crokinole";

update juegos set mecanica = "Colocación de trabajadores" 
 where nombre = "Tzolk'in";


CREATE TABLE reserva (
    id_reserva INT(11) NOT NULL AUTO_INCREMENT,
    id_socio INT(11) NOT NULL,
    id_juego INT(11) NOT NULL,
    fecha_reserva DATE,
    PRIMARY KEY(id_reserva),
    Foreign Key (id_socio) REFERENCES socios (id_socio),
    Foreign Key (id_juego) REFERENCES juegos (id_juego)

) engine=innodb;

SELECT * FROM reserva;

INSERT INTO reserva (id_socio, id_juego, fecha_reserva) VALUES (5, (select id_juego from juegos where nombre = "Bang!"), NOW());
-- agricola y bang


CREATE TABLE movimientos (
    id_movimiento INT(11) NOT NULL AUTO_INCREMENT,
    id_socio INT(11) NOT NULL,
    cantidad DECIMAL NOT NULL,
    concepto VARCHAR(100) NOT NULL,
    fecha_movimiento DATE NOT NULL,
    tipo_gasto VARCHAR(10) NOT NULL,
    PRIMARY KEY(id_movimiento),
    Foreign Key (id_socio) REFERENCES socios (id_socio)
) engine=innodb;

INSERT INTO movimientos (id_socio, cantidad, concepto, fecha_movimiento, tipo_gasto) VALUES 
 (2,37,"Banner", "2023-01-03", "gasto"), (1,70,"Gaia Proyect", "2023-04-27", "gasto")
, (14,30,"Torneo 40K", "2023-02-13", "ingreso"), (1,80.50,"Caja Magic", "2023-01-10", "gasto"), (2,468,"Subvencion año 2023", "2023-05-10", "ingreso"), 
    (1,45.73,"Tapetes x-wing", "2023-01-14", "gasto")
, (1,100,"Armario para juegos", "2023-04-01", "gasto"), (14,110,"Torneo x-wing", "2023-01-03", "ingreso"), (1,0,"Junk art", "2023-02-02", "donación"),
(1,80.50,"Caja Magic2", "2023-01-10", "gasto"), (1,82.73,"Tapetes x-wing neopreno", "2023-01-14", "gasto");
-- INSERT INTO movimientos (id_socio, cantidad, concepto, fecha_reserva) 
-- VALUES (2, 200, "Apertura Asociacion", NOW());
-- INSERT INTO movimientos (id_socio, cantidad, concepto, fecha_reserva) 
-- VALUES (2, -20, "Compra tapete", NOW());

-- DELETE FROM movimientos WHERE cantidad = -20;

-- SELECT * FROM movimientos;





CREATE TABLE torneos (
    id_torneo INT(11) NOT NULL AUTO_INCREMENT,
    organizador1 INT(11) NOT NULL,
    organizador2 INT(11),
    organizador3 INT(11),
    actividad VARCHAR(50) NOT NULL,
    num_participantes INT(11) NOT NULL,
    fecha DATE NOT NULL,
    coste_entrada DECIMAL,
    recaudacion_total DECIMAL NOT NULL,
    PRIMARY KEY(id_torneo),
    Foreign Key (organizador1) REFERENCES socios (id_socio),
    Foreign Key (organizador2) REFERENCES socios (id_socio),
    Foreign Key (organizador3) REFERENCES socios (id_socio)
) engine=innodb;



INSERT INTO torneos (organizador1, organizador2, organizador3, actividad, num_participantes, fecha, coste_entrada, recaudacion_total) 
VALUES 
(5,1, 1, "Torneo xwing",12, "2023.09.14",5, 0);


SELECT * from


CREATE TABLE inventario (
    id_objeto INT(11) NOT NULL AUTO_INCREMENT,
    tipo VARCHAR(50) NOT NULL,
    marca VARCHAR(50),
    medidas VARCHAR(50),
    cantidad INT(4) NOT NULL,
    coste DECIMAL,
    juego VARCHAR(50),
    pintado BOOLEAN,
    color VARCHAR(50),
    comprador INT(11) NOT NULL,
    observaciones VARCHAR(200),
    PRIMARY KEY(id_objeto),
    Foreign Key (comprador) REFERENCES socios (id_socio)
) engine=innodb;

INSERT INTO inventario (tipo, marca, medidas, cantidad, coste, juego, pintado, color, comprador, observaciones) 
VALUES 
("Banner","", "2 metros x 1 metro", 1,75,"Asociacion", "","Azul y blanco", 1, ""),
("Tapete xwing","", "90x90", 8,63.20,"Xwing", "si","", 1, ""),
("Armario Juegos","", "Enorme", 1,140,"", "","Gris", 1, ""),
("Armario escenografia","", "Grande", 1,64.20,"", "","Marrón", 1, ""),
("Fundas Mini Euro","Mayday", "45mm x 68mm", 150,3,"Juego de mesa", "","", 2, "Fundas Premium"),
("Fundas USA","Mayday", "56mm x 87mm", 400,4,"Juego de mesa", "","", 2, "Fundas Premium"),
("Fundas Mini Usa","Mayday", "41mm x 63mm", 200,4,"Juego de mesa", "","", 2, "Fundas Premium"),
("escenografia bosque grande","", "40x27", 1,0,"wargames", "no","", 2, "Fabricada por los socios"),
("escenografia bosque pequeño","", "20x25", 5,0,"wargames", "si","", 2, "Fabricada por los socios"),
("escenografia charrco","", "12x12", 4,0,"wargames", "si","", 2, "Fabricada por los socios");




-- UPDATE movimientos set cantidad = 20 WHERE id_movimiento = 3;


-- ALTER TABLE movimientos MODIFY cantidad FLOAT NOT null;

ALTER TABLE juegos ADD COLUMN ruta_foto VARCHAR(100);
update juegos set ruta_foto = "./img/juegos/bloodRage.jpg" where nombre = "Blood Rage";


SELECT SUM(cantidad) as ingresos From movimientos WHERE tipo_gasto = "ingreso";
SELECT SUM(cantidad) as gastos From movimientos WHERE tipo_gasto = "gasto";



INSERT INTO movimientos (id_socio, cantidad, concepto, fecha_movimiento, tipo_gasto) VALUES (2,2600,"Banner", "2023-01-03", "ingreso");





SELECT SUM(cantidad) -  (SELECT SUM(cantidad) as ingresos From movimientos WHERE tipo_gasto = "ingreso") as total
From movimientos WHERE tipo_gasto = "gasto";



SELECT COUNT(id_movimiento) as donaciones from movimientos where tipo_gasto = "donacion";

select * from movimientos WHERE cantidad;

SELECT id_socio as id FROM socios WHERE nombre = "Daniel" AND apellido1 = "Agustín";





SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
FROM movimientos m JOIN socios s WHERE m.id_socio = s.id_socio; 



SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
    FROM movimientos m 
    JOIN socios s WHERE m.id_socio = s.id_socio ORDER BY s.nombre ;



SELECT MAX(fecha) FROM torneos;

SELECT fecha
FROM torneos
WHERE fecha > CURDATE()
ORDER BY ABS(DATEDIFF(fecha, CURDATE()))
LIMIT 1;

INSERT INTO torneos (organizador1, actividad, num_participantes, fecha, coste_entrada, recaudacion_total) 
VALUES 
(5, "Torneo Warhammer",12, "2023.06.14",0, 0);


SELECT nombre, min_jugadores, max_jugadores, mecanica, edad, reservado
    FROM juegos;



SELECT s.nombre, s.apellido1, s.correo, s.telefono FROM socios s 
JOIN reserva r ON s.id_socio = r.id_socio WHERE r.id_socio = 2;


SELECT nombre, cambio_socio FROM juegos ORDER BY cambio_socio DESC LIMIT 10;


SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
    FROM movimientos m 
    JOIN socios s  on m.id_socio = s.id_socio WHERE s.nombre LIKE "%Da%";


    SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
    FROM movimientos m 
    JOIN socios s  on m.id_socio = s.id_socio WHERE m.cantidad = 10;



ALTER TABLE socios DROP COLUMN permiso;
ALter TABLE socios ADD COLUMN permiso VARCHAR(1);
ALTER table socios modify permiso VARCHAR(5);





SELECT nombre, min_jugadores, max_jugadores, mecanica, edad, reservado, ruta_foto, id_juego, cambio_socio
    FROM juegos order by nombre;

SELECT id_socio FROM reserva ;
SELECT id_socio FROM juegos;





SELECT r.id_socio as `socio reserva`, r.id_juego as `juego reservado`, j.* 
FROM  juegos j
LEFT JOIN reserva r ON r.id_juego = j.id_juego;



SELECT s.nombre, s.apellido1, s.correo, s.telefono FROM socios s 
            JOIN reserva r on s.id_socio = r.id_socio WHERE r.id_socio = 2 AND r.id_juego = 42 ;
            


SELECT s.nombre, s.apellido1, t.actividad, t.num_participantes, t.fecha, t.coste_entrada, t.cartel, s.telefono
FROM torneos t JOIN socios s ON t.organizador1 = s.id_socio ORDER BY t.fecha; 

ALTER Table torneos ADD COLUMN cartel VARCHAR(50);

UPDATE torneos SET coste_entrada = 0 WHERE id_torneo = 2;


SELECT id_socio FROM socios where nombre = "Daniel" AND apellido1 = "Agustín";


SELECT r.id_socio as `socio reserva`, r.id_juego as `juego reservado`, j.*
        FROM  juegos j
        LEFT JOIN reserva r ON r.id_juego = j.id_juego;


SELECT nombre, cambio_socio FROM juegos ORDER BY cambio_socio DESC LIMIT 10;

ALTER Table inventario CHANGE juego utilidad VARCHAR(50) NOT null;



SELECT i.*, s.nombre, s.apellido1 FROM inventario i JOIN socios s on i.comprador = s.id_socio;

ALTER TABLE socios AUTO_INCREMENT = 19;

SELECT m.id_movimiento, s.nombre, s.apellido1, m.cantidad, m.concepto, m.fecha_movimiento, m.tipo_gasto 
                    FROM movimientos m JOIN socios s on m.id_socio = s.id_socio WHERE m.cantidad = 10 ORDER BY id_movimiento ;



SELECT r.id_socio as `socio reserva`, r.id_juego as `juego reservado`, j.*
        FROM  juegos j
        LEFT JOIN reserva r ON r.id_juego = j.id_juego ORDER BY j.nombre
