# Online Voting System

**Project**: Online Voting System  
**Team**: TechVision Dev Team  
**Members**: Ashley (Team Leader), Dev1 (Frontend), Dev2 (Backend)

---

## Overview
A simple role-based online voting system for school elections. Features:
- Voter registration and login
- Admin login and candidate management (Add/Edit/Delete)
- Voters can cast one vote
- Vote tallying and results view
- Activity logging for admin actions

---

## Quick setup (Windows + XAMPP)

1. Install [XAMPP](https://www.apachefriends.org) and start **Apache** and **MySQL** via XAMPP Control Panel.  
2. Place the project folder under `C:\xampp\htdocs\online_voting`.  
3. Open phpMyAdmin: `http://localhost/phpmyadmin`.

---

## Database

1. Create a database named `online_voting`.
2. Import the SQL schema: `database/online_voting.sql` (phpMyAdmin → Import).
   - OR from command line:
     ```bash
     mysql -u root -p < database/online_voting.sql
     ```
3. Verify tables: `users`, `candidates`, `votes`, `admin_actions`.

---

## Configure DB connection

Copy `include/db.example.php` to `include/db.php` and update credentials:

```php
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "online_voting";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) { die("Connection failed: ".$conn->connect_error); }
?>
