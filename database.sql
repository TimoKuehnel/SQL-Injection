DROP DATABASE IF EXISTS sql_demo;
CREATE DATABASE sql_demo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sql_demo;

CREATE TABLE benutzer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    passwort VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);

INSERT INTO benutzer (username, passwort, email) VALUES
('admin', 'Admin123!', 'admin@example.local'),
('alice', 'sonne123', 'alice@example.local'),
('bob', 'geheim456', 'bob@example.local'),
('charlie', 'test789', 'charlie@example.local');