CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password TEXT NOT NULL,
    role ENUM('admin', 'student', 'teacher') NOT NULL DEFAULT 'student',
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
