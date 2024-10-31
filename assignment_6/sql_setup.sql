-- creating a data base called findyourgspot_db
CREATE DATABASE IF NOT EXISTS findyourgspot_db;
USE findyourgspot_db;


CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);
-- some testing i wanted to try
CREATE TABLE IF NOT EXISTS BLOCKS (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(100),
    block_letter CHAR(1),
    college VARCHAR(100)
);

-- my sample test data
INSERT INTO users (name, password_hash) VALUES ('admin', SHA2('adminpassword', 256));
