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
ins

-- Trigger --




