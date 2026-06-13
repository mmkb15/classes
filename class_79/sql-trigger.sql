CREATE TABLE IF NOT EXISTS student_logs(
    id int UNSIGNED auto_increment PRIMARY KEY,
    student_id int,
    status VARCHAR(20),
    time timestamp
);

-- Trigger --
create trigger add_student
after insert on students
for each row
insert into student_logs(student_id, status, time)
values(new.id, "Added", now());


+-------------+--------+----------+-----------------------------------------------------------------------------------+--------+------------------------+-----------------------------------------------------+----------------+----------------------+----------------------+--------------------+
| Trigger     | Event  | Table    | Statement                                                                         | Timing | Created                | sql_mode                                            | Definer        | character_set_client | collation_connection | Database Collation |
+-------------+--------+----------+-----------------------------------------------------------------------------------+--------+------------------------+-----------------------------------------------------+----------------+----------------------+----------------------+--------------------+
| add_student | INSERT | students | insert into student_logs(student_id, status, time)
values(new.id, "Added", now()) | AFTER  | 2026-05-19 12:09:21.74 | NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION | root@localhost | cp850                | cp850_general_ci     | utf8mb4_general_ci |
+-------------+--------+----------+-----------------------------------------------------------------------------------+--------+------------------------+-----------------------------------------------------+----------------+----------------------+----------------------+--------------------+





INSERT INTO students(full_name, email)
values("Redoy","redoy@example.com");



drop trigger if exists update_student;
CREATE trigger update_student
after update on students
for each row
insert into student_logs(student_id, status, time)
values(old.id, "Updated", now());

update students 
SET full_name = "REDOY"
WHERE id = 6;

update students 
SET full_name = "REDOY", email = "doy@gmail.com"
WHERE id = 6;


drop trigger if exists delete_student;
CREATE trigger delete_student
after delete on students
for each row
insert into student_logs(student_id, status, time)
values(old.id, "Deleted", now());

delete from students 
WHERE id = 6;
