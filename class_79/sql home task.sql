
DROP database if EXISTS home_task;
create database home_task;
USE home_task;

DROP TABLE if EXISTS brands;
CREATE TABLE brands(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)
);
INSERT INTO brands(name) VALUES('Apple'),('Samsung'),('Techno');

DROP TABLE if EXISTS categories;
CREATE TABLE categories(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)
);
INSERT INTO categories(name) VALUES('Mobile'),('Smart Watch'),('Laptop');

DROP TABLE if EXISTS products;
CREATE TABLE products(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    brand_id INT,
    category_id INT,
    price FLOAT,
    is_active TINYINT
);
INSERT INTO products( name, brand_id, category_id, price, is_active) 
values("iPhone 14",1,1,1000,1),
("Samsung Galaxy S22",2,1,800,1),
("Techno X2",3,2,600,1),
("Smart Watch 2",1,2,300,1),
("Laptop 2",1,3,2000,1),
("Smart Watch 3",2,2,400,1);


DROP VIEW if EXISTS vw_active_products;
CREATE VIEW vw_active_products as
SELECT p.id, p.name, b.name as brand , c.name as category, p.price 
FROM products p, brands b, categories c
WHERE p.brand_id = b.id AND p.category_id = c.id AND p.is_active=1;


select * FROM vw_active_products WHERE price > 1000;

select * FROM vw_active_products WHERE category = "Mobile" AND brand = "Apple";

select * FROM vw_active_products WHERE category = "Mobile" AND price > 500 AND price < 1500;


