DROP TABLE IF EXISTS manufacturer; 
CREATE TABLE manufacturer(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    address VARCHAR(100),
    contact_no VARCHAR(50)
);

INSERT INTO manufacturer (name, address, contact_no) VALUES 
('Audi','Germany','+880 185 695 6622'),
('Toyota','Japan','+880 195 695 6622'),
('Lamborghini','Italy','+880 175 695 6622');


DROP TABLE IF EXISTS product ; 
CREATE TABLE product(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    price INT(5),
    manufacturer_id INT(10)
);

INSERT INTO product (name, price, manufacturer_id) VALUES 
('Audi A3',4000, 1),
('Audi A4',4500, 1),
('Audi A5',5000, 1),
('Toyota RAV4',1300, 2),
('Toyota Tacoma',1200, 2),
('Toyota Corolla',1000, 2),
('Lamborghini Gallardo',4500, 3),
('Lamborghini Aventador',85000, 3),
('Lamborghini Revuelto',10000, 3);



DELIMITER //
DROP PROCEDURE IF EXISTS addManufacturer //
CREATE PROCEDURE addManufacturer(_name VARCHAR(50), _address VARCHAR(100), _contact VARCHAR(50))
BEGIN
INSERT INTO manufacturer (name, address, contact_no) VALUES 
(_name, _address, _contact);                         
END //
DELIMITER ;    



drop view if exists wv_product;
create view wv_product AS
SELECT p.*, m.name AS mfg 
FROM product AS p, manufacturer AS m
WHERE p.manufacturer_id = m.id and price > 5000;
                          