DROP TABLE IF EXISTS manufacturer;
CREATE TABLE manufacturer(
	id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    address VARCHAR(100),
    contact_no VARCHAR(50)
);

DROP TABLE IF EXISTS product;
CREATE TABLE product(
	id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    price INT(5),
    manufacturer_id INT(10)
);

INSERT INTO manufacturer(name, address, contact_no) VALUES
("HP","USA", "36541263"),
("Dell","UK", "36542363");

INSERT INTO product(name, price, manufacturer_id) VALUES
("Mouse",500,1),
("Mouse",450,2),
("Monitor",7450,2),
("Speaker",5500,1);


drop procedure if exists addManufacturer;
DELIMITER //
create procedure addManufacturer(_name VARCHAR(50), _address VARCHAR(100), _contact_no VARCHAR(50))
begin
INSERT INTO manufacturer(name, address, contact_no) VALUES(_name,_address, _contact_no);
end //
DELIMITER ;


DROP VIEW IF EXISTS wv_product;
CREATE VIEW wv_product AS
SELECT p.*, m.name AS mfg
FROM product AS p, manufacturer AS m
WHERE p.manufacturer_id = m.id and p.price > 5000;


DROP trigger if exists delete_mfg;
CREATE trigger delete_mfg
after delete on manufacturer
for each row
delete from product where manufacturer_id = old.id;
