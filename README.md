Tattoo Studio Web Application

Project Overview

This project is a single-page web application for a Tattoo Studio, built as part of the Web Programming course project.  
The application allows users to explore tattoo artists and gallery images with authentication for clients and admin users.
The frontend uses HTML, CSS, and JavaScript (no Bootstrap).

Deliverables:
- Project structure with frontend and backend folders.
- Static frontend SPA (views: home, aboutUs, gallery, login, register).
- Draft ERD (5 entities): users, artists, tattoo_designs, appointments, payments.
- ERD image: docs/ERD.png
- SQL schema & seed scripts: sql/schema.sql

Notes:
- Frontend: plain HTML/CSS/JS (no Bootstrap).
- Backend: planned with FlightPHP + PDO + MySQL (to be implemented in next milestones).

SQL Scheme

CREATE DATABASE IF NOT EXISTS tattoo_studio;
USE tattoo_studio;

-- 1. USERS table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('client', 'artist', 'admin') DEFAULT 'client',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. ARTISTS table
CREATE TABLE artists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNIQUE NOT NULL,
    style VARCHAR(150),
    bio TEXT,
    photo_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 3. TATTOO_DESIGNS table
CREATE TABLE tattoo_designs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    artist_id INT NOT NULL,
    title VARCHAR(150),
    image_url VARCHAR(255),
    description TEXT,
    price DECIMAL(8,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (artist_id) REFERENCES artists(id) ON DELETE CASCADE
);

-- 4. APPOINTMENTS table
CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    artist_id INT NOT NULL,
    design_id INT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    status ENUM('pending', 'confirmed', 'done', 'cancelled') DEFAULT 'pending',
    notes TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (artist_id) REFERENCES artists(id) ON DELETE CASCADE,
    FOREIGN KEY (design_id) REFERENCES tattoo_designs(id) ON DELETE SET NULL
);

-- 5. PAYMENTS table
CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    appointment_id INT UNIQUE NOT NULL,
    amount DECIMAL(8,2) NOT NULL,
    method VARCHAR(50) NOT NULL,
    paid_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (appointment_id) REFERENCES appointments(id) ON DELETE CASCADE
);

users 1 : N appointments
artists 1 : N appointments
artists 1 : N tattoo_designs
appointments N : 1 tattoo_designs
appointments 1 : 1 payments

1. users – Stores all application users with basic info and role.
2. artists – Contains artist-specific details linked to a user.
3. tattoo_designs – Holds all tattoo designs created by artists.
4. appointments – Tracks client appointments with artists and designs.
5. payments – Records payments for appointments with amount and method.

Project Structure

TattooStudio/
│
├── backend/
│ ├── routes/ # API route definitions (will handle requests)
│ ├── services/ # Business logic layer
│ ├── dao/ # Data Access Objects (database queries)
│ └── index.php # FlightPHP initialization
│
├── frontend/
│ ├── css/ # All stylesheets
│ ├── js/ # Main SPA logic and scripts
│ ├── views/ # HTML views for each page (home, about, gallery, login, etc.)
│ ├── index.html # Main SPA entry point
│ └── assets/ # Images
│
├── docs/
│ └──ERD.png # ER Diagram
│ 
├── sql/
│ └── schema.sql # SQL Scheme
│
└── README.md

Frontend Pages

- Home Page – Studio introduction and hero section  
- About Us – Description of the studio and team members  
- Gallery – Image showcase with lightbox functionality  
- Login/Register – Authentication interface  
- Footer – Contains contact info, working hours, and social links  

All navigation occurs dynamically without page reloads.
