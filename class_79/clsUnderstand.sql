
DROP database if EXISTS home_task;
create database home_task;
USE home_task;

DROP TABLE if EXISTS brands;
CREATE TABLE brands(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)
);
-- INSERT INTO brands(name) VALUES('Apple');
-- INSERT INTO brands(name) VALUES('Samsung');
-- INSERT INTO brands(name) VALUES('Techno');
INSERT INTO brands(name) VALUES('Apple'),('Samsung'),('Techno');
+----+---------+
| id | name    |
+----+---------+
|  1 | Apple   |
|  2 | Samsung |
|  3 | Techno  |
+----+---------+


DROP TABLE if EXISTS categories;
CREATE TABLE categories(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)
);
INSERT INTO categories(name) VALUES('Mobile'),('Smart Watch'),('Laptop');
+----+-------------+
| id | name        |
+----+-------------+
|  1 | Mobile      |
|  2 | Smart Watch |
|  3 | Laptop      |
+----+-------------+


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
+----+--------------------+----------+-------------+-------+-----------+
| id | name               | brand_id | category_id | price | is_active |
+----+--------------------+----------+-------------+-------+-----------+
|  1 | iPhone 14          |        1 |           1 |  1000 |         1 |
|  2 | Samsung Galaxy S22 |        2 |           1 |   800 |         1 |
|  3 | Techno X2          |        3 |           2 |   600 |         1 |
|  4 | Smart Watch 2      |        1 |           2 |   300 |         1 |
|  5 | Laptop 2           |        1 |           3 |  2000 |         1 |
|  6 | Smart Watch 3      |        2 |           2 |   400 |         1 |
+----+--------------------+----------+-------------+-------+-----------+




DROP VIEW if EXISTS vw_active_products;
CREATE VIEW vw_active_products as
SELECT p.id, p.name, b.name as brand , c.name as category, p.price 
FROM products p, brands b, categories c
WHERE p.brand_id= b.id AND p.category_id AND p.is_active=1;
+----+--------------------+---------+-------------+-------+
| id | name               | brand   | category    | price |
+----+--------------------+---------+-------------+-------+
|  1 | iPhone 14          | Apple   | Mobile      |  1000 |
|  1 | iPhone 14          | Apple   | Smart Watch |  1000 |
|  1 | iPhone 14          | Apple   | Laptop      |  1000 |
|  2 | Samsung Galaxy S22 | Samsung | Mobile      |   800 |
|  2 | Samsung Galaxy S22 | Samsung | Smart Watch |   800 |
|  2 | Samsung Galaxy S22 | Samsung | Laptop      |   800 |
|  3 | Techno X2          | Techno  | Mobile      |   600 |
|  3 | Techno X2          | Techno  | Smart Watch |   600 |
|  3 | Techno X2          | Techno  | Laptop      |   600 |
|  4 | Smart Watch 2      | Apple   | Mobile      |   300 |
|  4 | Smart Watch 2      | Apple   | Smart Watch |   300 |
|  4 | Smart Watch 2      | Apple   | Laptop      |   300 |
|  5 | Laptop 2           | Apple   | Mobile      |  2000 |
|  5 | Laptop 2           | Apple   | Smart Watch |  2000 |
|  5 | Laptop 2           | Apple   | Laptop      |  2000 |
|  6 | Smart Watch 3      | Samsung | Mobile      |   400 |
|  6 | Smart Watch 3      | Samsung | Smart Watch |   400 |
|  6 | Smart Watch 3      | Samsung | Laptop      |   400 |
+----+--------------------+---------+-------------+-------+



select * FROM vw_active_products WHERE price > 1000;
+----+----------+-------+----------+-------+
| id | name     | brand | category | price |
+----+----------+-------+----------+-------+
|  5 | Laptop 2 | Apple | Laptop   |  2000 |
+----+----------+-------+----------+-------+


select * FROM vw_active_products WHERE category = "Mobile" AND brand = "Apple";
+----+-----------+-------+----------+-------+
| id | name      | brand | category | price |
+----+-----------+-------+----------+-------+
|  1 | iPhone 14 | Apple | Mobile   |  1000 |
+----+-----------+-------+----------+-------+


select * FROM vw_active_products WHERE category = "Mobile" AND price > 500 AND price < 1500;
+----+--------------------+---------+----------+-------+
| id | name               | brand   | category | price |
+----+--------------------+---------+----------+-------+
|  1 | iPhone 14          | Apple   | Mobile   |  1000 |
|  2 | Samsung Galaxy S22 | Samsung | Mobile   |   800 |
+----+--------------------+---------+----------+-------+