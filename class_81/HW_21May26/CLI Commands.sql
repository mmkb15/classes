-- Creating database
DROP DATABASE IF EXISTS hw_21_may;
CREATE DATABASE hw_21_may;
use hw_21_may;

--  1.	Create a table named positions with the following columns
DROP TABLE IF EXISTS positions;
CREATE TABLE positions(
    id INT PRIMARY KEY AUTO_INCREMENT,
    position_name VARCHAR(100)
);

--  2.	Insert at least 3 sample records into the positions table.
INSERT INTO positions (position_name) VALUES
("Professor"),
("Registrar"),
("Librarian");

SELECT * FROM positions;


-- 3.	Create a table named employees with the following columns:
DROP TABLE IF EXISTS employees;
CREATE TABLE employees(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100),
    position_id INT,
    salary FLOAT,
    hire_date Timestamp
);

-- 4.	Insert at least 3 employee records into the employees table.
INSERT INTO employees (name,position_id,salary) VALUES
("Meena",2 , 2800.00 ),
("Raju",3,2500.00),
("Mithu",1,4500.00),
("Lali",2,2700.00),
("Dadi",3,2600.00),
("Rita",1,4800.00)

SELECT * FROM employees;

-- 5.	Write a SQL query to:	Select all employees whose salary is less than 3000

SELECT * FROM employees WHERE salary > 3000;

-- 6.	Write a SQL query to:	Update the position_name of a specific position using its id.

UPDATE positions SET position_name = "Admissions Officer" WHERE id=3;

SELECT * FROM positions;

-- 7.	Write a SQL query to:	Delete an employee record by id.

DELETE FROM employees WHERE id="4";

SELECT * FROM employees;

