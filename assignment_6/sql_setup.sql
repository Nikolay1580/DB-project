-- creating a database called findyourgspot_db
CREATE DATABASE IF NOT EXISTS findyourgspot_db;
USE findyourgspot_db;

-- Creating users table with secure password hashing
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);

-- Inserting a sample user with hashed password (for testing)
INSERT INTO users (name, password_hash) VALUES ('admin', SHA2('adminpassword', 256));
