DROP DATABASE IF EXISTS website;
CREATE DATABASE website;

CREATE TABLE customers(
  id INT AUTO_INCREMENT,
  f_name VARCHAR(255),
  l_name VARCHAR(255),
  username VARCHAR(255),
  password VARCHAR(255),
  email VARCHAR(255)
)
