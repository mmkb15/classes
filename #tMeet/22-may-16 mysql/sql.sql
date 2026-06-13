-- Database Creation
DROP DATABASE IF EXISTS group_study_22_may;
CREATE DATABASE group_study_22_may;
USE group_study_22_may;

-- Creating Manufacturer table and adding data
DROP TABLE IF EXISTS manufacturers;
CREATE TABLE manufacturers(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    address VARCHAR(255)
);

INSERT INTO manufacturers (name, address) VALUES ('Dell', 'Dhaka'), ('HP', 'Noakhali'), ('Toshiba', 'Chittagong');

SELECT * FROM manufacturers;

-- Creating Product table and adding data
DROP TABLE IF EXISTS products;
CREATE TABLE products(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    manufacturer_id INT,
    price DECIMAL
);

INSERT INTO products (name, manufacturer_id, price) VALUES
('Wireless Mouse', 1, 2500),
('Mechanical Keyboard', 2, 1500),
('Gaming Monitor', 1, 2000),
('USB-C Cable', 3, 1000),
('Bluetooth Speaker', 2, 5000),
('Noise Cancelling Headphones', 3, 1600),
('External Hard Drive', 1, 1900),
('Ergonomic Office Chair', 2, 1700),
('HD Webcam', 3, 5000),
('Smart Power Strip', 1, 900);

SELECT * FROM products;

-- Creating View 
-- Product name, manufacturer name, price
DROP VIEW IF EXISTS vw_products;
CREATE VIEW vw_products AS SELECT products.name as product_name, manufacturers.name as manufacturer_name, products.price FROM products, manufacturers WHERE products.manufacturer_id = manufacturers.id;

SELECT * FROM vw_products;


SELECT * FROM vw_products WHERE price >= 2000;

-- Creating Procedure

-- Show all tables at once
DROP PROCEDURE IF EXISTS show_all_tables;

DELIMITER ??
CREATE PROCEDURE show_all_tables()
BEGIN
SELECT * FROM manufacturers;
SELECT * FROM products;
END ??

DELIMITER ;

CALL show_all_tables;

-- Adding data using procedure
DROP PROCEDURE IF EXISTS add_manufacturer;
DELIMITER ??
CREATE PROCEDURE add_manufacturer(p_naam VARCHAR(100), p_thikana VARCHAR(100))
BEGIN
INSERT INTO manufacturers (name, address) VALUES (p_naam, p_thikana);
END ??
DELIMITER ;

CALL add_manufacturer("Walton", "Gulistan");


-- Creating Trigger

-- Trigger er kaj hocche, ami jodi ekta kaj kori tahole arekta kaj nij theke hoye jabe.

DROP TRIGGER IF EXISTS delete_manufacturer;
CREATE TRIGGER delete_manufacturer AFTER DELETE ON manufacturers
FOR EACH ROW 
DELETE FROM products WHERE manufacturer_id = old.id;

-- DELETE FROM manufacturers WHERE id = 1;