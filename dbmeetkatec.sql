	drop database dbmeerkatec;

	create database dbmeerkatec;
	USE DBMeerkatec;


	CREATE TABLE users (
		id INT AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(255),
		password VARCHAR(255),
		email VARCHAR(255),
		email_verified_at DATETIME,
		remember_token VARCHAR(100),
		Nombre_Completo VARCHAR(25),
		CI int UNIQUE,
		Latitud float,
		Longitud float,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	);

	CREATE TABLE oauth_access_tokens (
		id VARCHAR(100) PRIMARY KEY,
		user_id INT,
		client_id VARCHAR(100),
		scopes JSON,
		revoked TINYINT(1) NOT NULL,
		expires_at DATETIME,
		created_at DATETIME,
		updated_at DATETIME
	);

	CREATE TABLE oauth_auth_codes (
		id VARCHAR(100) PRIMARY KEY,
		user_id INT,
		client_id VARCHAR(100),
		revoked TINYINT(1) NOT NULL,
		expires_at DATETIME,
		created_at DATETIME,
		updated_at DATETIME
	);

	CREATE TABLE oauth_clients (
		id INT AUTO_INCREMENT PRIMARY KEY,
		user_id INT,
		name VARCHAR(255),
		secret VARCHAR(100) NOT NULL,
		redirect VARCHAR(255) NOT NULL,
		personal_access_client TINYINT(1) NOT NULL,
		password_client TINYINT(1) NOT NULL,
		provider VARCHAR(255),
		revoked TINYINT(1) NOT NULL,
		created_at DATETIME,
		updated_at DATETIME
	);

	CREATE TABLE oauth_personal_access_clients (
		id VARCHAR(100) PRIMARY KEY,
		client_id VARCHAR(100),
		created_at DATETIME,
		updated_at DATETIME
	);

	CREATE TABLE oauth_refresh_tokens (
		id VARCHAR(100) PRIMARY KEY,
		access_token_id VARCHAR(100),
		revoked TINYINT(1) NOT NULL,
		expires_at DATETIME,
		created_at DATETIME,
		updated_at DATETIME
	);

	CREATE TABLE password_resets (
		email VARCHAR(255) PRIMARY KEY,
		token VARCHAR(255),
		created_at DATETIME
	);

	CREATE TABLE personal_access_tokens (
		id VARCHAR(100) PRIMARY KEY,
		user_id INT,
		name VARCHAR(255),
		token VARCHAR(100) NOT NULL,
		abilities TEXT,
		created_at DATETIME,
		updated_at DATETIME
	);


	CREATE TABLE Telefono_Usuarios (
		id INT,
		Num_Telefono VARCHAR(20),
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		PRIMARY KEY (id, Num_Telefono),
		FOREIGN KEY (id) REFERENCES users(id)
	);

	CREATE TABLE Empleados (
		id INT PRIMARY KEY,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (id) REFERENCES users(id)
	);

	CREATE TABLE Funcionario_Transporte (
		id INT PRIMARY KEY,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (id) REFERENCES Empleados(id)
	);

	CREATE TABLE Almacenes (
		ID_Almacen INT  auto_increment PRIMARY KEY,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		Capacidad float
	);

	CREATE TABLE Funcionario_Almacen (
		id INT,
		ID_Almacen INT,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		FOREIGN KEY (id) REFERENCES Empleados(id),
		FOREIGN KEY (ID_Almacen) REFERENCES Almacenes(ID_Almacen)
	);

	CREATE TABLE Choferes (
		id INT PRIMARY KEY,
		Licencia VARCHAR(25),
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (id) REFERENCES Funcionario_Transporte(id)
	);

	CREATE TABLE Despachadores (
		id INT PRIMARY KEY,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (id) REFERENCES Funcionario_Almacen(id)
	);

	CREATE TABLE Clientes (
		id INT PRIMARY KEY,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (id) REFERENCES users(id)

	);

	CREATE TABLE Productos (
		ID_Producto INT PRIMARY KEY,
		Peso float,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		Cantidad INT
	);

	CREATE TABLE Articulo (
		ID_Articulo INT,
		id INT,
		ID_Producto INT,
		Estado VARCHAR(25),
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		PRIMARY KEY (ID_Articulo, ID_Producto),
		FOREIGN KEY (ID_Producto) REFERENCES Productos(ID_Producto)
	);

	CREATE TABLE Camion (
		Num_Serie smallint PRIMARY KEY,
		Matricula varchar(10),
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		Capacidad float
	);

	CREATE TABLE Lote (
		ID_Lote INT auto_increment PRIMARY KEY,
		Nombre VARCHAR(25),
		Descripcion TEXT,
		Fecha_Hora_Estimada DATETIME,
		Num_Serie smallint,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (Num_Serie) REFERENCES Camion(Num_Serie)
	);

	CREATE TABLE Departamento (
		ID_Dep tinyint PRIMARY KEY,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		Nombre VARCHAR(25)
	);


	CREATE TABLE Localidad (
		ID_Loc smallint PRIMARY KEY,
		ID_Dep tinyint,
		Nombre VARCHAR(25),
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (ID_Dep) REFERENCES Departamento(ID_Dep)
	);


	CREATE TABLE Plataforma (
		ID_Plataforma smallint auto_increment PRIMARY KEY,
		ID_Loc smallint,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (ID_Loc) REFERENCES Localidad(ID_Loc)
	);


	#relaciones

	CREATE TABLE Destino (
		ID_Destino INT PRIMARY KEY,
		ID_Loc smallint,
		Latitud float,
		Longitud float,
		created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		FOREIGN KEY (ID_Loc) REFERENCES Localidad(ID_Loc)
	);



	CREATE TABLE Asignado (
	  id INT,
	  Num_Serie smallint unique,
	  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (id),
	  FOREIGN KEY (id) REFERENCES Choferes (id),
	  FOREIGN KEY (Num_Serie) REFERENCES Camion (Num_Serie)
	);


	CREATE TABLE Guarda (
	  ID_Producto INT,
	  ID_Almacen INT,
	  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (ID_Producto, ID_Almacen),
	  FOREIGN KEY (ID_Producto) REFERENCES Productos (ID_Producto),
	  FOREIGN KEY (ID_Almacen) REFERENCES Almacenes (ID_Almacen)
	);

	CREATE TABLE Contiene (
	  ID_Producto INT,
	  ID_Lote INT,
	  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (ID_Producto),
	  FOREIGN KEY (ID_Producto) REFERENCES Productos (ID_Producto),
	  FOREIGN KEY (ID_Lote) REFERENCES Lote (ID_Lote)
	);

	CREATE TABLE Descarga (
	  ID_Producto INT,
	  id INT,
	  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (ID_Producto, id),
	  FOREIGN KEY (ID_Producto) REFERENCES Productos (ID_Producto),
	  FOREIGN KEY (id) REFERENCES Despachadores (id)
	);


	CREATE TABLE Llega (
	  ID_Lote INT auto_increment,
	  ID_Destino INT unique,
	  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (ID_Lote),
	  FOREIGN KEY (ID_Lote) REFERENCES Lote (ID_Lote),
		foreign key (ID_Destino) REFERENCES Destino (ID_Destino)
	);
    


