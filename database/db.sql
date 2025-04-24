CREATE DATABASE IF NOT EXISTS eklase CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE eklase;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password TEXT NOT NULL,
    role ENUM('admin', 'student', 'teacher') NOT NULL DEFAULT 'student',
    avatar VARCHAR,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (first_name, last_name, email, password, role) 
VALUES (
    'Alice',
    'Admin',
    'alice.admin@example.com',
    '$2a$12$neUO9IA47So5tcMOuLvppOnZ3LzB3uGoOgyQ5hEdCnpYSs8.2HNFO', -- hash for 'AdminPass123'
    'admin'
);

INSERT INTO users (first_name, last_name, email, password, role) 
VALUES (
    'Tom',
    'Teacher',
    'tom.teacher@example.com',
    '$2a$12$cRoHDJ1ZK5bN7CyuDKjnduqAMPvlzvSz292pUV8dT0Oje6l.D7vV2', -- hash for 'TeacherPass123'
    'teacher'
);

INSERT INTO users (first_name, last_name, email, password, role) 
VALUES (
    'Sam',
    'Student',
    'sam.student@example.com',
    '$2a$12$FT0jEYdY0olzMfAnPHp1uufDDtfymblPstv5acUbCZ3e6EAGpCJvK', -- hash for 'StudentPass123'
    'student'
);

CREATE TABLE subjects (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE students (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    class VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    id_number VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE teachers (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    subject_id INT NOT NULL,
    user_id INT NOT NULL,
    id_number VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (subject_id) REFERENCES subjects(id)
);

CREATE TABLE assignments (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    subject_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (subject_id) REFERENCES subjects(id)
);

CREATE TABLE notifications (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE messages (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id),
    FOREIGN KEY (receiver_id) REFERENCES users(id)
);

CREATE TABLE tasks (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    due_date DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE grades (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    student_id INT NOT NULL,
    subject_id INT NOT NULL,
    grade DECIMAL(5, 2) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (subject_id) REFERENCES subjects(id)
);

INSERT INTO subjects (name) VALUES 
('Mathematics'), 
('English'), 
('Science'), 
('History'), 
('Geography'), 
('Biology'), 
('Chemistry'), 
('Physics'), 
('Computer Science'), 
('Economics'), 
('Political Science');

INSERT INTO users (first_name, last_name, email, password, role) VALUES
('Alice', 'Admin', 'alice.admin@example.com', '$2a$12$neUO9IA47So5tcMOuLvppOnZ3LzB3uGoOgyQ5hEdCnpYSs8.2HNFO', 'admin'),
('Tom', 'Teacher', 'tom.teacher@example.com', '$2a$12$cRoHDJ1ZK5bN7CyuDKjnduqAMPvlzvSz292pUV8dT0Oje6l.D7vV2', 'teacher'),
('Sam', 'Student', 'sam.student@example.com', '$2a$12$FT0jEYdY0olzMfAnPHp1uufDDtfymblPstv5acUbCZ3e6EAGpCJvK', 'student'),
('Bob', 'Williams', 'bob.williams@example.com', '$2a$12$FT0jEYdY0olzMfAnPHp1uufDDtfymblPstv5acUbCZ3e6EAGpCJvK', 'student');

INSERT INTO teachers (first_name, last_name, subject_id, user_id, id_number) VALUES 
('Tome', 'Smith', 1, 2, '123456789');

INSERT INTO students (first_name, last_name, class, user_id, id_number) VALUES 
('Sam', 'Smith', '10A', 3, '123456789'),
('Bob', 'Williams', '10B', 4, '123456789');

INSERT INTO assignments (name, description, subject_id) VALUES 
('Assignment 1', 'This is assignment 1', 1),
('Assignment 2', 'This is assignment 2', 2);

INSERT INTO tasks (title, description, due_date) VALUES 
('Task 1', 'This is task 1', '2023-01-01 00:00:00'),
('Task 2', 'This is task 2', '2023-01-02 00:00:00');

INSERT INTO notifications (user_id, message) VALUES 
(1, 'This is notification 1'),
(2, 'This is notification 2');

INSERT INTO grades (student_id, subject_id, grade) VALUES 
(1, 1, 4.5),
(1, 2, 3.5),
(2, 1, 4.0),
(2, 2, 3.0);

