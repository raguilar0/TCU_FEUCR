CREATE TABLE associations
(
  id INT UNSIGNED AUTO_INCREMENT,
  acronym varchar(16) NOT NULL,
  name varchar(70) NOT NULL,
  location varchar(100) DEFAULT NULL,
  schedule varchar(100) DEFAULT NULL,
  authorized_card INT(1) DEFAULT 0 NOT NULL,
  headquarter_id INT UNSIGNED NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(headquarter_id) REFERENCES headquarters(id)

);




CREATE TABLE headquarters
(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name varchar(100) NOT NULL,
	image_name varchar(100) NOT NULL
	
);

CREATE TABLE amounts
(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	amount INT(32) NOT NULL,
	date date NOT NULL,
	spent INT(32) NOT NULL,
	deadline date NOT NULL,
	association_id INT UNSIGNED NOT NULL,
	
	FOREIGN KEY(association_id) REFERENCES associations(id)
	
);
