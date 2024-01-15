CREATE DATABASE IF NOT EXISTS schedule_management;
USE schedule_management;
-- Create the 'admins' table
CREATE TABLE IF NOT EXISTS admins (
    id INT(10) AUTO_INCREMENT PRIMARY KEY,
    login_id VARCHAR(20) UNIQUE,
    password VARCHAR(64),
    actived_flag INT(1) DEFAULT 1,
    reset_password_token VARCHAR(100),
    updated DATETIME,
    created DATETIME
);

-- Create the 'subjects' table
CREATE TABLE IF NOT EXISTS subjects (
    id INT(10) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(250),
    avatar VARCHAR(250),
    description TEXT,
    school_year CHAR(10),
    updated DATETIME,
    created DATETIME
);

-- Create the 'teachers' table
CREATE TABLE IF NOT EXISTS teachers (
    id INT(10) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(250),
    avatar VARCHAR(250),
    description TEXT,
    specialized CHAR(10),
    degree CHAR(10),
    updated DATETIME,
    created DATETIME
);

-- Create the 'schedules' table
CREATE TABLE IF NOT EXISTS schedules (
    id INT(10) AUTO_INCREMENT PRIMARY KEY,
    school_year CHAR(10),
    subject_id INT(10),
    teacher_id INT(10),
    week_day CHAR(10),
    lession CHAR(10),
    notes TEXT,
    updated DATETIME,
    created DATETIME,
    FOREIGN KEY(subject_id) REFERENCES subjects(id),
    FOREIGN KEY(teacher_id) REFERENCES teachers(id)
);

