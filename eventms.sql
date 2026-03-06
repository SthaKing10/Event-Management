-- Create the database
CREATE DATABASE IF NOT EXISTS eventmgmt;
USE eventmgmt;

-- Create user table
CREATE TABLE IF NOT EXISTS user (
    user_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone_number VARCHAR(20) DEFAULT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') DEFAULT 'user',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_image VARCHAR(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create events table
CREATE TABLE IF NOT EXISTS events (
    event_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT DEFAULT NULL,
    event_date DATE NOT NULL,
    event_time TIME NOT NULL,
    location VARCHAR(255) NOT NULL,
    capacity INT(11) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create event_bookings table
CREATE TABLE IF NOT EXISTS event_bookings (
    booking_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    event_id INT(11) NOT NULL,
    tickets INT(11) NOT NULL DEFAULT 1,
    total_price DECIMAL(10,2) NOT NULL,
    booking_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending','confirmed','cancelled') DEFAULT 'confirmed',
    payment_status ENUM('paid','unpaid','failed','pending') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(event_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



ALTER TABLE `eventmgmt`.`otp` 
ADD COLUMN `email_sent` TINYINT(1) NULL DEFAULT 0 AFTER `attempt`;