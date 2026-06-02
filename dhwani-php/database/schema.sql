-- ============================================================
-- Dhwani Music Player — MySQL Schema (PHP Version)
-- Run this in phpMyAdmin or MySQL CLI before starting
-- ============================================================

CREATE DATABASE IF NOT EXISTS dhwani_db;
USE dhwani_db;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(50)  NOT NULL UNIQUE,
    email      VARCHAR(100) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Songs table
CREATE TABLE IF NOT EXISTS songs (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    song_name  VARCHAR(100) NOT NULL,
    file_path  VARCHAR(200) NOT NULL,
    cover_path VARCHAR(200) NOT NULL,
    artist     VARCHAR(100)
);

-- Seed 9 default songs (matches script.js exactly)
INSERT INTO songs (song_name, file_path, cover_path, artist) VALUES
    ('Play-Date',        'songs/1.mp3', 'covers/1.jpg', 'Melanie Martinez'),
    ('Stay',             'songs/2.mp3', 'covers/2.jpg', 'The Kid LAROI'),
    ('Watermelon',       'songs/3.mp3', 'covers/3.jpg', 'Harry Styles'),
    ('Middle',           'songs/4.mp3', 'covers/4.jpg', 'DJ Snake'),
    ('Levitating',       'songs/5.mp3', 'covers/5.jpg', 'Dua Lipa'),
    ('Heat Waves',       'songs/6.mp3', 'covers/6.jpg', 'Glass Animals'),
    ('No Lie',           'songs/7.mp3', 'covers/7.jpg', 'Sean Paul'),
    ('Blinding Lights',  'songs/8.mp3', 'covers/8.jpg', 'The Weeknd'),
    ('I Ain\'t Worried', 'songs/9.mp3', 'covers/9.jpg', 'OneRepublic');
