-- Creating brands table and adding data
DROP TABLE IF EXISTS brands;

create table brands (
id int unsigned primary key auto_increment,
name varchar(50));

INSERT INTO brands (name) VALUES ("Samsung");
INSERT INTO brands (name) VALUES ("OnePlus");
INSERT INTO brands (name) VALUES ("Xiaomi");

-- Creating categories table and adding data.
DROP TABLE IF EXISTS categories;

create table categories (
id int unsigned primary key auto_increment,
name varchar(50));

INSERT INTO categories (name) VALUES ("Chargers & Cables");
INSERT INTO categories (name) VALUES ("Phone Cases");
INSERT INTO categories (name) VALUES ("Audio Accessories");

-- Creating products table and adding data
DROP TABLE IF EXISTS products;

create table products (
id int unsigned primary key auto_increment,
product_name varchar(50),
brand_id int,
category_id int,
price int,
is_active boolean
);

INSERT INTO products (product_name, brand_id, category_id, price, is_active) VALUES ("25W Super Fast Charger", 1, 1, 1599, true);
INSERT INTO products (product_name, brand_id, category_id, price, is_active) VALUES ("Silicone Grip Case (Galaxy)", 1, 2, 899, true);
INSERT INTO products (product_name, brand_id, category_id, price, is_active) VALUES ("Warp Charge 65W Adapter", 2, 1, 1999, true);
INSERT INTO products (product_name, brand_id, category_id, price, is_active) VALUES ("Sandstone Bumper Case", 2, 2, 999, false);
INSERT INTO products (product_name, brand_id, category_id, price, is_active) VALUES ("33W Turbo Charger", 3, 1, 1249, true);
INSERT INTO products (product_name, brand_id, category_id, price, is_active) VALUES ("Liquid Silicon Case (Mi)", 3, 2, 849, true);
INSERT INTO products (product_name, brand_id, category_id, price, is_active) VALUES ("USB-C Wired Earphones", 2, 3, 1199, true);
INSERT INTO products (product_name, brand_id, category_id, price, is_active) VALUES ("Original Samsung AKG Type-C", 1, 3, 1799, true);


+----+---------+
| id | name    |
+----+---------+
|  1 | Samsung |
|  2 | OnePlus |
|  3 | Xiaomi  |
+----+---------+

+----+-------------------+
| id | name              |
+----+-------------------+
|  1 | Chargers & Cables |
|  2 | Phone Cases       |
|  3 | Audio Accessories |
+----+-------------------+

+----+-----------------------------+----------+-------------+-------+-----------+
| id | product_name                | brand_id | category_id | price | is_active |
+----+-----------------------------+----------+-------------+-------+-----------+
|  1 | 25W Super Fast Charger      |        1 |           1 |  1599 |         1 |
|  2 | Silicone Grip Case (Galaxy) |        1 |           2 |   899 |         1 |
|  3 | Warp Charge 65W Adapter     |        2 |           1 |  1999 |         1 |
|  4 | Sandstone Bumper Case       |        2 |           2 |   999 |         0 |
|  5 | 33W Turbo Charger           |        3 |           1 |  1249 |         1 |
|  6 | Liquid Silicon Case (Mi)    |        3 |           2 |   849 |         1 |
|  7 | USB-C Wired Earphones       |        2 |           3 |  1199 |         1 |
|  8 | Original Samsung AKG Type-C |        1 |           3 |  1799 |         1 |
+----+-----------------------------+----------+-------------+-------+-----------+


-- Creating view
DROP VIEW IF EXISTS vw_products;

CREATE VIEW vw_products as SELECT p.id, p.product_name, b.name AS brand, c.name AS category, p.price FROM products AS p, brands AS b, categories AS c WHERE p.brand_id = b.id AND p.category_id = c.id;

+----+-----------------------------+---------+-------------------+-------+
| id | product_name                | brand   | category          | price |
+----+-----------------------------+---------+-------------------+-------+
|  1 | 25W Super Fast Charger      | Samsung | Chargers & Cables |  1599 |
|  2 | Silicone Grip Case (Galaxy) | Samsung | Phone Cases       |   899 |
|  3 | Warp Charge 65W Adapter     | OnePlus | Chargers & Cables |  1999 |
|  4 | Sandstone Bumper Case       | OnePlus | Phone Cases       |   999 |
|  5 | 33W Turbo Charger           | Xiaomi  | Chargers & Cables |  1249 |
|  6 | Liquid Silicon Case (Mi)    | Xiaomi  | Phone Cases       |   849 |
|  7 | USB-C Wired Earphones       | OnePlus | Audio Accessories |  1199 |
|  8 | Original Samsung AKG Type-C | Samsung | Audio Accessories |  1799 |
+----+-----------------------------+---------+-------------------+-------+

-- Queries

SELECT product_name, price FROM vw_products WHERE price>1000;
+-----------------------------+-------+
| product_name                | price |
+-----------------------------+-------+
| 25W Super Fast Charger      |  1599 |
| Warp Charge 65W Adapter     |  1999 |
| 33W Turbo Charger           |  1249 |
| USB-C Wired Earphones       |  1199 |
| Original Samsung AKG Type-C |  1799 |
+-----------------------------+-------+

SELECT * FROM vw_products WHERE brand="OnePlus" AND category="Chargers & Cables";

+----+-------------------------+---------+-------------------+-------+
| id | product_name            | brand   | category          | price |
+----+-------------------------+---------+-------------------+-------+
|  3 | Warp Charge 65W Adapter | OnePlus | Chargers & Cables |  1999 |
+----+-------------------------+---------+-------------------+-------+

SELECT * FROM vw_products WHERE category="Chargers & Cables" AND price > 1200 AND PRICE < 1600;

+----+------------------------+---------+-------------------+-------+
| id | product_name           | brand   | category          | price |
+----+------------------------+---------+-------------------+-------+
|  1 | 25W Super Fast Charger | Samsung | Chargers & Cables |  1599 |
|  5 | 33W Turbo Charger      | Xiaomi  | Chargers & Cables |  1249 |
+----+------------------------+---------+-------------------+-------+


-------------------------------------------------------------
------------------------- Trigger ---------------------------

DROP TRIGGER IF EXISTS brand_delete;

CREATE TRIGGER brand_delete AFTER DELETE ON brands
FOR EACH ROW DELETE FROM products WHERE brand_id = old.id;

DELETE FROM brands WHERE id=1;