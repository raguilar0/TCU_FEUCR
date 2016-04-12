CREATE TABLE headquarters
(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name varchar(100) NOT NULL,
	image_name varchar(100) NOT NULL
	
);

CREATE TABLE associations
(
  id INT UNSIGNED AUTO_INCREMENT,
  acronym varchar(16) NOT NULL,
  name varchar(70) NOT NULL,
  location varchar(100) DEFAULT NULL,
  schedule varchar(100) DEFAULT NULL,
  authorized_card INT(1) DEFAULT 0 NOT NULL,
  enable INT(1) DEFAULT 1 NOT NULL,
  headquarter_id INT UNSIGNED NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(headquarter_id) REFERENCES headquarters(id)

);



CREATE TABLE amounts
(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	amount DOUBLE NOT NULL,
	amount_saving DOUBLE NOT NULL DEFAULT 0,
	date date NOT NULL,
	spent DOUBLE NOT NULL DEFAULT 0,
	deadline date NOT NULL,
	association_id INT UNSIGNED NOT NULL,
	
	FOREIGN KEY(association_id) REFERENCES associations(id)
	
);

CREATE TABLE invoices
(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	number varchar(20) NOT NULL,
	provider varchar(100) NOT NULL,
	amount DOUBLE NOT NULL, 
	clarifications varchar(1024),
	image_name varchar(100),
	detail varchar(1024),
	kind INT(1) DEFAULT 0,
	state INT(1) NOT NULL DEFAULT 0,
	date date,
	attendant varchar(100),
	association_id INT UNSIGNED NOT NULL,
	FOREIGN KEY(association_id) REFERENCES associations(id),
	CHECK(kind > -1 and kind < 3)
);

CREATE TABLE boxes
(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	amount DOUBLE NOT NULL DEFAULT 0,
	kind INT(1) DEFAULT 0,
	association_id INT UNSIGNED NOT NULL,
	FOREIGN KEY(association_id) REFERENCES associations(id),
	CHECK(kind > -1 and kind < 2)
);

CREATE TABLE warehouses
(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	amount INT(32) NOT NULL,
	date date NOT NULL,
	spent INT(32) NOT NULL,
	deadline date NOT NULL,
	association_id INT UNSIGNED NOT NULL
);

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255),
    role VARCHAR(20)
);