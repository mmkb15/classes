drop table if EXISTS teacher;
CREATE table teacher(
    id int AUTO_INCREMENT primary key,
    name varchar(50),
    qualification varchar(50),
    contact_no varchar(20)
);

drop table if EXISTS course;
CREATE table course(
    id int AUTO_INCREMENT primary key,
    name varchar(50),
    fee int(50),
    teacher_id int(10)
);


INSERT INTO teacher(name, qualification, contact_no) VALUES 
('Rion','Ph.D ','0167 858 9889'),
('Masum','Masters','0167 858 9889'); 

INSERT INTO course(name, fee,  teacher_id) VALUES 
('WDPF',20000,1),
('GAVE',12000,2),
('JEE',25000,1),
('NT',12000,2); 


DROP procedure if exists newTeacher;
DELIMITER //
CREATE procedure newTeacher(_name varchar(50), _qualification varchar(50), _contact_no varchar(20))
BEGIN
INSERT INTO teacher(name, qualification, contact_no) VALUES (_name,_qualification, _contact_no); 
END //
DELIMITER ;


drop view if exists vw_course;
CREATE view vw_course AS
select c.*, t.name as teacher from teacher as t, course as c
where c.teacher_id = t.id and c.fee > 15000;



drop trigger if exists delete_course;
CREATE trigger delete_course
after delete on teacher
for each row
delete from course where teacher_id = old.id;
