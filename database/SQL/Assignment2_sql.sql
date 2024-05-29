
CREATE DATABASE assignment2;
GRANT USAGE ON *.* TO root@localhost IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON root.* TO assignment2@localhost;

FLUSH PRIVILEGES;




USE assignment2;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    userId INT AUTO_INCREMENT PRIMARY KEY,
    userName VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
);



USE assignment2;
DROP TABLE IF EXISTS tasks;

CREATE TABLE tasks (
    taskId INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    taskName VARCHAR(255) NOT NULL,
    description TEXT,
    priority ENUM('High', 'Medium', 'Low') NOT NULL,
    dueDate DATE,
    createdDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status ENUM('In Progress', 'Over Due', 'Completed') NOT NULL DEFAULT 'In Progress',
    FOREIGN KEY (userId) REFERENCES users(userId)
);

