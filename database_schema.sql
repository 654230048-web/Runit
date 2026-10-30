-- ============================================================
-- IT RUNNER — Database Schema (ดำ-เหลือง)
-- ============================================================

CREATE DATABASE IF NOT EXISTS it_runner_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE it_runner_db;

DROP TABLE IF EXISTS registrations;
DROP TABLE IF EXISTS events;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(100) NOT NULL,
    role ENUM('admin', 'staff') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255) NOT NULL,
    location_province VARCHAR(100) NOT NULL,
    location_venue VARCHAR(255) NOT NULL,
    event_date DATE NOT NULL,
    category ENUM('Fun Run', 'Mini Marathon', 'Half Marathon', 'Full Marathon', 'Trail') NOT NULL,
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    banner_img VARCHAR(255) NULL,
    description TEXT NULL,
    status ENUM('open', 'closed', 'upcoming') DEFAULT 'open',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE registrations (
    reg_id INT AUTO_INCREMENT PRIMARY KEY,
    reg_number VARCHAR(30) NOT NULL UNIQUE,
    event_id INT NOT NULL,
    runner_firstname VARCHAR(100) NOT NULL,
    runner_lastname VARCHAR(100) NOT NULL,
    id_card_passport VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    shirt_size ENUM('S', 'M', 'L', 'XL', '2XL', '3XL') NOT NULL,
    payment_status ENUM('pending', 'paid', 'cancelled') DEFAULT 'pending',
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(event_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users (username, password, fullname, role) VALUES 
('admin', '$2y$10$e8T/oU3L/Hj4dK3d.VzJ1.fJ4dK3d.VzJ1.fJ4dK3d.VzJ1.f', 'IT Admin', 'admin');

INSERT INTO events (event_name, location_province, location_venue, event_date, category, price, status) VALUES
('IT RUNNER Nakhon Pathom Night Run 2026', 'นครปฐม', 'องค์พระปฐมเจดีย์ อ.เมือง', '2026-11-15', 'Mini Marathon', 550.00, 'open'),
('Mahidol IT Cyber Run 2026', 'นครปฐม', 'มหาวิทยาลัยมหิดล ศาลายา', '2026-12-05', 'Fun Run', 450.00, 'open'),
('Silpakorn Heritage Run 2026', 'นครปฐม', 'พระราชวังสนามจันทร์', '2026-12-20', 'Half Marathon', 750.00, 'open');
