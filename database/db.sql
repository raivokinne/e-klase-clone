CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password TEXT NOT NULL,
    role ENUM('admin', 'student', 'teacher') NOT NULL DEFAULT 'student',
    avatar VARCHAR,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, password, role) 
VALUES (
    'Alice Admin',
    'alice.admin@example.com',
    '$2a$12$neUO9IA47So5tcMOuLvppOnZ3LzB3uGoOgyQ5hEdCnpYSs8.2HNFO', -- hash for 'AdminPass123'
    'admin'
);

INSERT INTO users (name, email, password, role) 
VALUES (
    'Tom Teacher',
    'tom.teacher@example.com',
    '$2a$12$cRoHDJ1ZK5bN7CyuDKjnduqAMPvlzvSz292pUV8dT0Oje6l.D7vV2', -- hash for 'TeacherPass123'
    'teacher'
);

INSERT INTO users (name, email, password, role) 
VALUES (
    'Sam Student',
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