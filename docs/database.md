-- Create the database
CREATE DATABASE mf_clinic;

-- Use the database
USE mf_clinic;

-- Create the users table
    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        phone_number VARCHAR(20) NOT NULL,
        user_type ENUM('patient', 'admin', 'nurse', 'doctor') NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
ALTER TABLE users ADD COLUMN last_login DATETIME NULL;


CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    event_type VARCHAR(50),
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
SELECT * FROM logs ORDER BY created_at DESC;

