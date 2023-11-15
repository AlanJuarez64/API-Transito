USE dbmeerkatec;

INSERT INTO users (name, password, email, Nombre_Completo, CI, Latitud, Longitud)
VALUES
    ('prueba', '$2y$10$tp3EBc4bTw7GrfLIf7PMdeuU3H6Q87Kg3IpC1v5isbWqTEWbhgAlm', 'prueba@gmail.com', 'Usuario Uno', 1234567, 40.7128, -74.0060),
    ('prueba2', '$2y$10$tp3EBc4bTw7GrfLIf7PMdeuU3H6Q87Kg3IpC1v5isbWqTEWbhgAlm', 'prueba2@gmail.com', 'Usuario Dos', 9876543, 34.0522, -118.2437),
    ('prueba3', '$2y$10$tp3EBc4bTw7GrfLIf7PMdeuU3H6Q87Kg3IpC1v5isbWqTEWbhgAlm', 'prueba3@gmail.com', 'Usuario Tres', 5678901, 51.5074, -0.1278);


INSERT INTO Telefono_Usuarios (id, Num_Telefono)
VALUES
    (1, '123-456-7890'),
    (2, '234-567-8901'),
    (3, '345-678-9012');


INSERT INTO Empleados (id)
VALUES
    (1),
    (2),
    (3);


INSERT INTO Funcionario_Transporte (id)
VALUES
    (1);


INSERT INTO Almacenes (Capacidad)
VALUES
    (1000.0),
    (1500.0),
    (2000.0);


INSERT INTO Funcionario_Almacen (id, ID_Almacen)
VALUES
    (2, 1);


INSERT INTO Choferes (id, Licencia)
VALUES
    (1, 'Licencia A');


INSERT INTO Despachadores (id)
VALUES
    (2);




INSERT INTO Productos (ID_Producto, Peso, Cantidad)
VALUES
    (1, 10.0, 100),
    (2, 15.0, 150),
    (3, 20.0, 200);


INSERT INTO Articulo (ID_Articulo, id, ID_Producto, Estado)
VALUES
    (1, 1, 1, 'Entregado'),
    (2, 2, 2, 'Inactivo'),
    (3, 3, 3, 'En proceso');


INSERT INTO Camion (Num_Serie, Matricula, Capacidad)
VALUES
    (1, 'ABC123', 5000.0),
    (2, 'XYZ789', 6000.0),
    (3, 'LMN456', 7000.0);


INSERT INTO Lote (Nombre, Descripcion, Fecha_Hora_Estimada, Num_Serie)
VALUES
    ('Lote 1', 'Descripción del Lote 1', '2023-11-15 10:00:00', 1),
    ('Lote 2', 'Descripción del Lote 2', '2023-11-16 12:30:00', 2),
    ('Lote 3', 'Descripción del Lote 3', '2023-11-17 09:15:00', 3);


INSERT INTO Departamento (ID_Dep, Nombre)
VALUES
    (1, 'Departamento A'),
    (2, 'Departamento B'),
    (3, 'Departamento C');


INSERT INTO Localidad (ID_Loc, ID_Dep, Nombre)
VALUES
    (1, 1, 'Localidad X'),
    (2, 2, 'Localidad Y'),
    (3, 3, 'Localidad Z');


INSERT INTO Plataforma (ID_Loc)
VALUES
    (1),
    (2),
    (3);


INSERT INTO Destino (ID_Destino, ID_Loc, Latitud, Longitud)
VALUES
    (1, 1, 40.123, -74.567),
    (2, 2, 35.678, -80.123),
    (3, 3, 30.456, -90.789);


INSERT INTO Asignado (id, Num_Serie)
VALUES
    (1, 2);


INSERT INTO Guarda (ID_Producto, ID_Almacen)
VALUES
    (1, 1),
    (2, 2),
    (3, 3);


INSERT INTO Contiene (ID_Producto, ID_Lote)
VALUES
    (1, 1),
    (2, 2),
    (3, 3);


INSERT INTO Descarga (ID_Producto, id)
VALUES
    (2, 2);


INSERT INTO Llega (ID_Destino)
VALUES
    (1),
    (2),
    (3);