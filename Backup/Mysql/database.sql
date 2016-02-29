CREATE TABLE associations
(
  id int NOT NULL UNSIGNED AUTO_INCREMENT,
  acronym varchar(16) NOT NULL,
  name varchar(70) NOT NULL,
  location varchar(100) DEFAULT NULL,
  schedule varchar(100) DEFAULT NULL,
  authorized_card INT(1) DEFAULT 0 NOT NULL,
  PRIMARY KEY(id)
);
