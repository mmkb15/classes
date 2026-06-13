-- Select the database to work with
USE round_70a;

-- Remove manufactures table if it already exists
DROP TABLE IF EXISTS manufactures;
-- Create manufactures table to store company details
CREATE TABLE manufactures (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Unique ID for each manufacturer
    name VARCHAR(100),                 -- Manufacturer name
    address VARCHAR(255)               -- Manufacturer address
);

-- Remove products table if it already exists
DROP TABLE IF EXISTS products;
-- Create products table to store product details
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Unique ID for each product
    name VARCHAR(100),                 -- Product name
    manufacture_id INT,                -- Links product to manufacturer (foreign key)
    price FLOAT                        -- Product price
);

-- Insert sample manufacturers
INSERT INTO manufactures (name, address) VALUES ("HP","USA");
INSERT INTO manufactures (name, address) VALUES ("Dell","UK");

-- Insert sample products linked to manufacturers
INSERT INTO products (name, manufacture_id, price) VALUES ("Mouse", 1, 800);
INSERT INTO products (name, manufacture_id, price) VALUES ("Monitor", 1, 1100);
INSERT INTO products (name, manufacture_id, price) VALUES ("Mouse", 2, 9900);
INSERT INTO products (name, manufacture_id, price) VALUES ("Speaker", 2, 5500);




-- Remove procedure if it already exists (look like funciton)
DROP PROCEDURE IF EXISTS createManufacturer;
DELIMITER //
-- Create procedure to insert a new manufacturer easily
CREATE PROCEDURE createManufacturer(pname VARCHAR(100), paddress VARCHAR(255))
BEGIN
    INSERT INTO manufactures (name, address) VALUES(pname, paddress);
END //
DELIMITER ;




-- Remove view if it already exists
DROP VIEW IF EXISTS vw_product_list;
-- Create view to list products with price greater than 5000
CREATE VIEW vw_product_list AS
SELECT p.id, p.name, p.price, m.name AS mfg 
FROM products AS p, manufactures AS m  
WHERE p.manufacture_id = m.id AND p.price > 5000;





-- Remove trigger if it already exists
DROP TRIGGER IF EXISTS delete_mfg;
-- Create trigger: when a manufacturer is deleted, delete its products too
CREATE TRIGGER delete_mfg
AFTER DELETE ON manufactures
FOR EACH ROW 
DELETE FROM products WHERE manufacture_id = OLD.id;
