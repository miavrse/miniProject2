CREATE DATABASE IF NOT EXISTS psp_portal
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE psp_portal;


CREATE TABLE IF NOT EXISTS students (

    id INT NOT NULL AUTO_INCREMENT,

    ic VARCHAR(20) NOT NULL UNIQUE,

    name VARCHAR(100) NOT NULL,

    program VARCHAR(50) NOT NULL,

    password VARCHAR(255) NOT NULL,

    marks INT DEFAULT 0,

    PRIMARY KEY (id)

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4;


INSERT INTO students
(
    ic,
    name,
    program,
    password,
    marks
)
VALUES
(
    '060716070528',
    'Mia Illisya',
    'DIT',
    '$2y$10$b/kcQ20kYPB2WbK2H8F69uQseD77GWiGSJFhYOJjtT2BPoU0lnWjG',
    85
)
ON DUPLICATE KEY UPDATE
    name = VALUES(name),
    program = VALUES(program),
    password = VALUES(password),
    marks = VALUES(marks);