-- =========================================
-- PRACTICAL 8 - STUDENTHUB DATABASE
-- =========================================


-- Create Database
CREATE DATABASE studenthub;


-- Select Database
USE studenthub;


-- =========================================
-- CREATE STUDENTS TABLE
-- =========================================

CREATE TABLE students (

    student_id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    email VARCHAR(100) NOT NULL UNIQUE

);


-- =========================================
-- CREATE EVENTS TABLE
-- =========================================

CREATE TABLE events (

    event_id INT AUTO_INCREMENT PRIMARY KEY,

    event_name VARCHAR(100) NOT NULL,

    event_date DATE NOT NULL

);


-- =========================================
-- CREATE REGISTRATIONS TABLE
-- =========================================

CREATE TABLE registrations (

    registration_id INT AUTO_INCREMENT PRIMARY KEY,

    student_id INT NOT NULL,

    event_id INT NOT NULL,

    FOREIGN KEY (student_id)
        REFERENCES students(student_id),

    FOREIGN KEY (event_id)
        REFERENCES events(event_id)

);


-- =========================================
-- INSERT SAMPLE EVENTS
-- =========================================

INSERT INTO events (event_name, event_date)
VALUES
('PHP Workshop', '2026-10-01'),
('MySQL Workshop', '2026-10-05'),
('Web Development', '2026-10-10');


-- =========================================
-- INSERT SAMPLE STUDENTS
-- =========================================

INSERT INTO students (name, email)
VALUES
('Mohammad', 'mohammad@gmail.com'),
('Rahul', 'rahul@gmail.com'),
('Amit', 'amit@gmail.com');


-- =========================================
-- INSERT SAMPLE REGISTRATIONS
-- =========================================

INSERT INTO registrations (student_id, event_id)
VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 3);