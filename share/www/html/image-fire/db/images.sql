CREATE DATABASE IF NOT EXISTS image_fire;

USE image_fire;

CREATE TABLE IF NOT EXISTS Images (
  id      INT(11)      NOT NULL AUTO_INCREMENT,
  name    VARCHAR(100) NOT NULL,
  contain VARCHAR(100) NOT NULL,
  description VARCHAR(256),
  tags VARCHAR(256),
  PRIMARY KEY (id)
)
