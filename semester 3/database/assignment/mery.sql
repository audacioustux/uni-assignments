-- 1
CREATE TABLE teacher
             (
                          t_id            NUMBER(10),
                          t_name          VARCHAR2(20),
                          phone           NUMBER,
                          salary          NUMBER(7),
                          email           VARCHAR2(30),
                          blood_group     VARCHAR2(3),
                          published_paper NUMBER(2),
                          designation     VARCHAR2(15)
             );
-- 2
alter TABLE teacher ADD ( department VARCHAR2(5), gender VARCHAR2(6) );
-- 3
ALTER TABLE teacher RENAME COLUMN department TO dept;
-- 4
ALTER TABLE teacher MODIFY salary NUMBER(7,3);
-- 5
alter TABLE teacher DROP COLUMN email;
-- 6
ALTER TABLE teacher RENAME TO teachers;
-- 7
INSERT INTO teachers VALUES (1, 'Harry', 123, 455.86, 'B+', 2, 'Lecturer', 'CSE', 'Male');
INSERT INTO teachers VALUES (2, 'Ron', 456, 245.78, 'O+', 1, 'Lecturer', 'BBA', 'Male');
INSERT INTO teachers VALUES (3, 'Hermione', 789, 789.56, 'A+', 8, 'Professor', 'CSE', 'Female');
INSERT INTO teachers VALUES (4, 'Malfoy', 101, 234.93, 'O-', 3, 'Instructor', 'LAW', 'Male');
INSERT INTO teachers VALUES (5, 'Bill', 102, 999.78, 'B-', 7, 'Professor', 'EEE', 'Male');
INSERT INTO teachers VALUES (6, 'Ginny', 103, 567.85, 'A-', 2, 'Lecturer', 'CSE', 'Female');
INSERT INTO teachers VALUES (7, 'Hagrid', 104, 242.89, 'AB+', 0, 'Instructor', 'ENG', 'Male');
INSERT INTO teachers VALUES (8, 'Cedric', 105, 567.88, 'B+', 7, 'Lecturer', 'CSE', 'Male');
INSERT INTO teachers VALUES (9, 'Krum', 106, 667.34, 'AB-', 4, 'Instructor', 'LAW', 'Male');
INSERT INTO teachers VALUES (10, 'Neville', 107, 787.89, 'O+', 6, 'Lecturer', 'BBA', 'Male');
-- 8
select * from teachers;
-- 9
delete from teachers where published_paper < 2;
-- 10
update teachers set designation = 'Professor' where designation != 'Professor';
 
