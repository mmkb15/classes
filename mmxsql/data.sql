DROP TABLE IF EXISTS manufacturer;
CREATE TABLE manufacturer(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    address VARCHAR(100),
    contact_no VARCHAR(50)
);

INSERT INTO manufacturer (name, address, contact_no) VALUES 
('Samsung Electronics', 'Dhaka, Bangladesh', '+8801711111111'),
('Sony Corporation', 'Tokyo, Japan', '+81312345678'),
('Intel Industries', 'California, USA', '+14081234567');



DROP TABLE IF EXISTS product ;
CREATE TABLE product(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    price INT(5),
    manufacturer_id INT(10)
);
INSERT INTO product (name, price, manufacturer_id) VALUES 
('Laptop Pro 15', 75000, 1),
('Wireless Mouse', 1200, 2),
('Mechanical Keyboard', 6500, 2),
('Gaming Monitor 24inch', 18500, 3),
('Bluetooth Headphones', 3200, 1),
('USB-C Hub Multiport', 2500, 2);



DROP PROCEDURE IF EXISTS addManufacturer;
DELIMITER //
CREATE PROCEDURE addManufacturer(_name VARCHAR(50), _address VARCHAR(100), _contact_no VARCHAR(50))
BEGIN
INSERT INTO manufacturer (name, address, contact_no) VALUES (_name, _address, _contact_no);
END //
DELIMITER ;


DROP TRIGGER IF EXISTS delete_mfg;
CREATE TRIGGER delete_mfg
AFTER DELETE ON manufacturer
FOR EACH ROW
DELETE FROM product WHERE manufacturer_id = old.id;



DROP VIEW IF EXISTS vw_product;
CREATE VIEW vw_product AS
SELECT p.*, m.name AS mfg FROM manufacturer AS m, product AS p 
WHERE p.manufacturer_id = m.id and p.price > 5000;
