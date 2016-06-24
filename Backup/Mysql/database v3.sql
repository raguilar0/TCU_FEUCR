CREATE TABLE headquarters
(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name varchar(100) NOT NULL,
	image_name varchar(100) NOT NULL,
  UNIQUE(name)

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
  FOREIGN KEY(headquarter_id) REFERENCES headquarters(id),

  UNIQUE(name, acronym)

);

CREATE TABLE surpluses(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  amount DOUBLE NOT NULL,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  detail varchar(2048) NOT NULL,
  association_id INT UNSIGNED NOT NULL,
  FOREIGN KEY(association_id) REFERENCES associations(id)
);

CREATE TABLE tracts
(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  number INT UNSIGNED NOT NULL DEFAULT 0,
  date date NOT NULL,
  deadline date NOT NULL,

  UNIQUE(date,deadline)
);

CREATE TABLE amounts
(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  amount DOUBLE NOT NULL,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ,
  detail varchar(2048) NOT NULL,
  type INT(2) NOT NULL DEFAULT 0, -- 0:tracto, 1:monto generado, 2:superávit
  association_id INT UNSIGNED NOT NULL,
  tract_id INT UNSIGNED NOT NULL,

  FOREIGN KEY(association_id) REFERENCES associations(id)
);




CREATE TABLE initial_amounts
(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  amount DOUBLE NOT NULL,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
  type INT(2) NOT NULL DEFAULT 0, -- 0:tracto, 1:monto generado
  association_id INT UNSIGNED NOT NULL,
  tract_id INT UNSIGNED NOT NULL,

  FOREIGN KEY(association_id) REFERENCES associations(id)
);

CREATE TABLE saving_accounts
(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  amount DOUBLE NOT NULL,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  bank VARCHAR(128) NOT NULL,
  account_owner VARCHAR(64) NOT NULL,
  card_number VARCHAR(64) NOT NULL,
  association_id INT UNSIGNED NOT NULL,

  tract_id INT UNSIGNED NOT NULL,
  FOREIGN KEY(association_id) REFERENCES associations(id),
  FOREIGN KEY (tract_id) REFERENCES  tracts(id)
);

CREATE TABLE invoices
(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  number varchar(20) NOT NULL,
  legal_certificate VARCHAR (20) NOT NULL,
  provider varchar(100) NOT NULL,
  amount DOUBLE NOT NULL,
  clarifications varchar(2048),
  image_name varchar(256),
  detail varchar(2048),
  kind INT(1) DEFAULT 0, -- 0 = Tracto, 1 = Ingresos generados, 2 = Superavit
  state INT(1) NOT NULL DEFAULT 0,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
  attendant varchar(100),
  association_id INT UNSIGNED NOT NULL,
  tract_id INT UNSIGNED NOT NULL,

  FOREIGN KEY(association_id) REFERENCES associations(id),


  CHECK(kind > -1 and kind < 3),
  CHECK(state > -1 and state < 3),

  UNIQUE(image_name)
);

CREATE TABLE boxes
(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  little_amount DOUBLE NOT NULL DEFAULT 0,
  big_amount DOUBLE NOT NULL DEFAULT 0,
  type INT UNSIGNED NOT NULL DEFAULT 0, -- 0:tracto, 1:monto generado, 2:superávit
  association_id INT UNSIGNED NOT NULL,
  tract_id INT UNSIGNED NOT NULL,

  FOREIGN KEY(association_id) REFERENCES associations(id)
);

CREATE TABLE savings
(
   id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
   amount INT(32) NOT NULL DEFAULT 0,
   state INT(1) DEFAULT 0,
   letter MEDIUMTEXT NOT NULL,
   association_id INT UNSIGNED NOT NULL,
   tract_id INT UNSIGNED NOT NULL,
   FOREIGN KEY(association_id) REFERENCES associations(id)
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
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20),
    name varchar(70) NOT NULL,
    last_name_1 varchar(30) NOT NULL,
    last_name_2 varchar(30),
    association_id INT UNSIGNED NOT NULL,
    state INT(1) NOT NULL,
    FOREIGN KEY(association_id) REFERENCES associations(id),

    UNIQUE(username)
);
