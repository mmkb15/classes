/* 
1. Table Creation
1.	Create a table named positions with the following columns:
o	id (Primary Key, Auto Increment)
o	position_name (VARCHAR)
2.	Insert at least 3 sample records into the positions table.
________________________________________
2. CRUD Operations
3.	Create a table named employees with the following columns:
o	id (Primary Key, Auto Increment)
o	name (VARCHAR)
o	position_id (Foreign Key referencing positions table)
o	salary (DECIMAL)
o	hire_date (DATE)
4.	Insert at least 3 employee records into the employees table.
5.	Write a SQL query to:
o	Select all employees whose salary is less than 3000.
6.	Write a SQL query to:
o	Update the position_name of a specific position using its id.
7.	Write a SQL query to:
o	Delete an employee record by id.
________________________________________
3. View
8.	Create a view named employee_summary that displays:
o	Employee name
o	Position name
o	Salary
________________________________________
4. Stored Procedure
9.	Write a stored procedure named GetEmployeeByPosition that:
o	Takes a position name as input parameter
o	Returns all employees who belong to that position
________________________________________
5. Trigger
10.	Create an audit table named employee_log with columns:
•	log_id (Primary Key)
•	employee_id
•	action
•	action_time
11.	Write a trigger that:
•	Fires AFTER INSERT on the employees table
•	Inserts a record into employee_log containing:
o	employee_id
o	action = 'INSERT'
o	current timestamp
*/




-- 1.	Create a table named positions with the following columns:
DROP TABLE if exists positions;
CREATE TABLE positions (
    id int primary key auto_increment,
    position_name VARCHAR(50)
);

-- 2.	Insert at least 3 sample records into the positions table.
insert into positions (position_name) values
("Software Engineer"),
("Project Manager"),
("Data Analyst");

SELECT * FROM positions;


--3.	Create a table named employees with the following columns:
DROP TABLE if exists employees;
CREATE TABLE employees (
    id int primary key auto_increment,
    name VARCHAR(100),
    position_id int,
	salary FLOAT,
	hire_date timestamp
);


-- 4.	Insert at least 3 employee records into the employees table.
insert into employees (name, position_id, salary) VALUES
('Meena', 3, 3000.00),
('Raju', 1, 1400.00),
('Mithu', 2, 2000.00),
('Lali', 1, 1500.00),
('Rita', 2, 2500.00),
('Dadi', 3, 3500.00);

select * from employees;


-- 5.	Write a SQL query to:	Select all employees whose salary is less than 3000.

select * FROM employees WHERE salary < 3000;


-- 6.	Write a SQL query to:	Update the position_name of a specific position using its id.
update position set position_name = "Web Developer" WHERE id = 3;

SELECT * from positions;


-- 7.	Write a SQL query to: Delete an employee record by id.
