# Library Management System (Simple PHP + MySQL)

## Overview
This is a simple, easy-to-run Library Management System built with plain PHP (no framework), MySQL, HTML/CSS and minimal JavaScript. It includes:
- User authentication (Admin and Librarian roles)
- Book management (add/edit/delete, quantity tracking)
- Borrow / Return flow
- Simple search & reservations
- Responsive UI (basic)

## Default credentials
- **Admin:** admin@gmail.com / admin@123
- You can add other librarians/users via the database.

## Requirements
- PHP 7.4+ with PDO extension
- MySQL / MariaDB
- A webserver (Apache / Nginx) or PHP built-in server

## Install
1. Import the SQL: `mysql -u root -p < db.sql` (or use phpMyAdmin)
2. Edit `config.php` database credentials.
3. Place project files into your webserver document root.
4. Open `http://localhost/library_system/index.php` or run `php -S localhost:8000` inside the folder.

## Notes
- Mail notifications are placeholders (no SMTP configured).
- This code is intentionally straightforward so you can extend it (AJAX, REST API, RBAC, file uploads, etc.)
