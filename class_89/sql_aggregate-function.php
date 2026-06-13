<?php
require_once("db-config.php");

$sql = "select count(*) from students where address='Mothijheel'";
$sql = "SELECT count(*) AS stu_num FROM students WHERE address='Mothijheel'";


// SUM
$sql = "SELECT sum(score) AS total_score FROM results where student_id=1";
$sql = "SELECT sum(score) AS total_score FROM results where exam_type='Mid-1'";
$sql = "SELECT max(score) AS total_score, full_name  FROM students,results where student_id=students.id AND exam_type='mid-2'";

$sql = "SELECT r.student_id, s.full_name   
FROM  students s, results r 
where exam_type='mid-2' AND r.student_id = s.id";

$sql = "SELECT p.name as Name, m.name as Brand, p.price as minimum_price
FROM  manufacturer as m, product as p 
where m.id = p.manufacturer_id and p.price = (SELECT MIN(price) FROM product)";

$sql = "SELECT AVG(price) FROM product";
$sql = "SELECT AVG(score) FROM results WHERE exam_type='mid-1'";

$sql = "SELECT exam_type, AVG(score) as avg_score FROM results GROUP BY exam_type";
$sql = "SELECT exam_type, AVG(score) as avg_score FROM results GROUP BY exam_type ORDER BY exam_type";






?>