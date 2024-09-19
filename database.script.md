`````sql

CREATE DATABASE IF NOT EXISTS taskcontrol;

USE taskcontrol;


CREATE TABLE IF NOT EXISTS categories(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS users(
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
 created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS tasks(
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  user_id INT,
  category_id INT,
  status ENUM('pending', 'started', 'paused', 'finished') NOT NULL,
  start_time DATETIME,
  pause_time DATETIME,
  finish_time DATETIME,
);


CREATE TABLE IF NOT EXISTS tasks_movements(
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT,
  action ENUM('start', 'pause', 'finish') NOT NULL,
  timestamp DATETIME NOT NULL
);


-- constraints 

ALTER TABLE tasks
ADD CONSTRAINT FOREIGN KEY(user_id) REFERENCES users(id);

ALTER TABLE tasks
ADD CONSTRAINT FOREIGN KEY(category_id) REFERENCES categories(id);

ALTER TABLE tasks_movements
ADD CONSTRAINT FOREIGN KEY(task_id) REFERENCES tasks(id);

