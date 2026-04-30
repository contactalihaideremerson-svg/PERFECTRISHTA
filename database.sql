CREATE DATABASE IF NOT EXISTS perfect_rishta;
USE perfect_rishta;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    role ENUM('user', 'admin') DEFAULT 'user',
    status ENUM('active', 'inactive', 'suspended', 'pending') DEFAULT 'pending',
    is_verified BOOLEAN DEFAULT FALSE,
    verification_token VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Profiles table
CREATE TABLE IF NOT EXISTS profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    father_name VARCHAR(255),
    cnic VARCHAR(50),
    bio TEXT,
    dob DATE,
    gender ENUM('male', 'female', 'other'),
    city VARCHAR(100),
    country VARCHAR(255),
    religion VARCHAR(100),
    sect VARCHAR(100),
    caste VARCHAR(255),
    marital_status VARCHAR(100),
    education VARCHAR(255),
    degree VARCHAR(255),
    occupation VARCHAR(255),
    job_title VARCHAR(255),
    profile_pic VARCHAR(255) DEFAULT 'default.png',
    age INT,
    height VARCHAR(50),
    weight VARCHAR(50),
    skin_color VARCHAR(100),
    complexion VARCHAR(100),
    blood_group VARCHAR(20),
    physique VARCHAR(100),
    disability VARCHAR(100),
    permanent_address TEXT,
    temporary_address TEXT,
    whatsapp VARCHAR(50),
    is_overseas BOOLEAN DEFAULT FALSE,
    has_bike BOOLEAN DEFAULT FALSE,
    has_car BOOLEAN DEFAULT FALSE,
    employment_type VARCHAR(50),
    company_name VARCHAR(255),
    company_address VARCHAR(255),
    monthly_income DECIMAL(10, 2) DEFAULT 0.00,
    father_income DECIMAL(10, 2) DEFAULT 0.00,
    mother_income DECIMAL(10, 2) DEFAULT 0.00,
    father_status VARCHAR(50),
    mother_status VARCHAR(50),
    father_occup VARCHAR(255),
    mother_occup VARCHAR(255),
    brothers_count INT DEFAULT 0,
    married_brothers INT DEFAULT 0,
    sisters_count INT DEFAULT 0,
    married_sisters INT DEFAULT 0,
    has_children VARCHAR(50),
    children_count INT DEFAULT 0,
    living_with VARCHAR(255),
    pref_age VARCHAR(255),
    pref_height VARCHAR(255),
    pref_education VARCHAR(255),
    pref_caste VARCHAR(255),
    pref_city VARCHAR(255),
    pref_income VARCHAR(255),
    pref_others TEXT,
    form_no VARCHAR(255),
    receipt_no VARCHAR(255),
    fee DECIMAL(10, 2) DEFAULT 0.00,
    admin_signature VARCHAR(255),
    admin_notes TEXT,
    house_status VARCHAR(50),
    house_size VARCHAR(100),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Connections/Matches table
CREATE TABLE IF NOT EXISTS matches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    target_id INT NOT NULL,
    status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (target_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Messages table
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    receiver_id INT NOT NULL,
    message TEXT NOT NULL,
    type ENUM('text', 'image') DEFAULT 'text',
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Packages table
CREATE TABLE IF NOT EXISTS packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    duration_days INT NOT NULL,
    features JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Subscriptions table
CREATE TABLE IF NOT EXISTS subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    package_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status ENUM('active', 'expired', 'cancelled') DEFAULT 'active',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (package_id) REFERENCES packages(id) ON DELETE CASCADE
);

-- CMS Pages table
CREATE TABLE IF NOT EXISTS cms_pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample admin
-- PASSWORD: password123
INSERT INTO users (name, email, password, role) VALUES ('Admin', 'admin@perfectrishta.com', '$2y$10$wI5QYV0y0K1P6.Yk6g7eO.6vH5jYfC7uXU9S.f6/HkU9u8i6h5e0.', 'admin');

-- Insert sample packages
INSERT INTO packages (name, price, duration_days, features) VALUES 
('Free', 0.00, 30, '{"unlimited_messages": false, "view_contacts": false, "boost_profile": false}'),
('Premium', 29.99, 30, '{"unlimited_messages": true, "view_contacts": true, "boost_profile": true}'),
('Featured', 49.99, 90, '{"unlimited_messages": true, "view_contacts": true, "boost_profile": true, "featured_tag": true}');

-- Insert sample users
-- PASSWORD: password123
INSERT INTO users (name, email, password, role) VALUES 
('Ayesha Khan', 'ayesha@example.com', '$2y$10$wI5QYV0y0K1P6.Yk6g7eO.6vH5jYfC7uXU9S.f6/HkU9u8i6h5e0.', 'user'),
('Zaid Ahmed', 'zaid@example.com', '$2y$10$wI5QYV0y0K1P6.Yk6g7eO.6vH5jYfC7uXU9S.f6/HkU9u8i6h5e0.', 'user'),
('Sara Ali', 'sara@example.com', '$2y$10$wI5QYV0y0K1P6.Yk6g7eO.6vH5jYfC7uXU9S.f6/HkU9u8i6h5e0.', 'user');

-- Insert sample profiles
INSERT INTO profiles (user_id, bio, dob, gender, city, religion, marital_status, education, occupation, age) VALUES 
(2, 'Software engineer looking for a compatible partner.', '1995-05-15', 'female', 'Lahore', 'Islam', 'Single', 'Masters in CS', 'Developer', 30),
(3, 'Business owner, love traveling and family values.', '1992-10-20', 'male', 'Karachi', 'Islam', 'Single', 'Bachelors', 'Entrepreneur', 33),
(4, 'Doctor by profession, caring and religious.', '1997-03-12', 'female', 'Islamabad', 'Islam', 'Single', 'MBBS', 'Doctor', 28);
