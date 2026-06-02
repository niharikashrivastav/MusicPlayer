# 🎧 Dhwani Music Player — PHP Setup Guide

## Requirements
- XAMPP (or WAMP / LAMP)
- PHP 8+
- MySQL

---

## 📁 Project Structure

```
dhwani-php/
├── api/
│   ├── db.php          ← Database connection
│   ├── login.php       ← POST /api/login.php
│   ├── signup.php      ← POST /api/signup.php
│   └── songs.php       ← GET  /api/songs.php
├── static/
│   ├── index.html      ← Main player (your frontend)
│   ├── login.html      ← Login page
│   ├── signup.html     ← Signup page
│   ├── about.html
│   ├── style.css
│   ├── script.js
│   ├── songs/          ← Put 1.mp3 ... 9.mp3 here
│   └── covers/         ← Put 1.jpg ... 9.jpg here
└── database/
    └── schema.sql      ← Run this in phpMyAdmin first
```

---

## ⚙️ Setup Steps

### 1. Copy project to XAMPP
Copy the entire `dhwani-php` folder into:
```
C:/xampp/htdocs/dhwani-php/       (Windows)
/opt/lampp/htdocs/dhwani-php/     (Linux)
```

### 2. Setup Database
- Open **phpMyAdmin** → `http://localhost/phpmyadmin`
- Click **Import** → select `database/schema.sql` → click Go
- This creates `dhwani_db` with `users` and `songs` tables + seeds 9 songs

### 3. Add your Music Files
```
static/songs/   → 1.mp3, 2.mp3, 3.mp3 ... 9.mp3
static/covers/  → 1.jpg, 2.jpg, 3.jpg ... 9.jpg
```

### 4. Start XAMPP
- Start **Apache** and **MySQL** from XAMPP Control Panel

### 5. Open in Browser
```
http://localhost/dhwani-php/static/index.html
```

---

## 🌐 API Endpoints

| Method | URL | Description |
|--------|-----|-------------|
| POST | `/dhwani-php/api/signup.php` | Register user |
| POST | `/dhwani-php/api/login.php`  | Login user |
| GET  | `/dhwani-php/api/songs.php`  | Get all songs |

---

## 🔒 Notes
- Passwords stored as **BCrypt hashes** — secure by default
- Default MySQL password in `api/db.php` is empty (XAMPP default)
- Change the password in `db.php` if your MySQL has one set
