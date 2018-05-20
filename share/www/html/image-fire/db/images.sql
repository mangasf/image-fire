CREATE DATABASE IF NOT EXISTS image_fire;

USE image_fire;

CREATE TABLE IF NOT EXISTS Images (
  id      VARCHAR(50)      NOT NULL,
  name    VARCHAR(100) NOT NULL,
  contain VARCHAR(100) NOT NULL,
  description VARCHAR(256) DEFAULT '',
  tags VARCHAR(256) DEFAULT '',
  PRIMARY KEY (id)
)
