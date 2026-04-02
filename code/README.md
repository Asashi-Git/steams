# Revieweo — Project Documentation

## Overview

Revieweo is a web application that allows users to search for video games, write reviews, and interact with other users through likes. The project follows a structured MVC-like architecture using PHP, with integration of an external API (RAWG) for game data.

---

## Project Architecture

The project is organized into several main directories:

### Root

- `index.php` → Entry point of the application
- `api.php` → Handles AJAX/API requests (likes, search)
- `auth.php` → Handles authentication routing (login/register)
- `dashboard.php` → User dashboard (admin & critic roles)

---

### config/

Contains configuration files:

- `database.php` → Database connection settings
- `api.php` → API keys (RAWG)

---

### controllers/

Handles application logic:

- `AuthController.php` → Login & registration logic
- `DashboardController.php` → User dashboard actions (reviews, admin actions)
- `GameController.php` → Game-related logic
- `LikeController.php` → Like/unlike system
- `ReviewController.php` → Review management

---

### models/

Handles data access:

- `Database.php` → PDO singleton for DB connection
- `GameModel.php` → Game database interactions
- `UserModel.php` → User-related queries

---

### services/

- `RawgService.php` → Handles external API calls to RAWG (search, fetch game data)

---

### views/

Contains UI templates:

- `auth/` → Login & registration pages
- `dashboard/` → Admin & critic dashboards
- `layout/` → Header & footer templates
- `game.php` → Game detail page

---

### public/

Static assets:

- `css/` → Stylesheets
- `js/likes.js` → Handles like button interactions via AJAX

---

### sql/

Database structure:

- `steams_db.sql` → Main database schema
- `steams.sql.old` → Backup/old version

---

## How the Application Works

### 1. Authentication

- Users can register and log in
- Passwords are securely hashed
- Sessions are used to maintain authentication

### 2. Game Search

- Users search games via the RAWG API
- Results are fetched dynamically using `api.php`

### 3. Reviews

- Logged-in users can:
    - Create reviews
    - Rate games (1–10)
    - View their reviews in the dashboard

### 4. Likes System

- Users can like/unlike games
- AJAX updates UI without reloading

### 5. Dashboard

- Critics:
    - Manage their reviews
- Admin:
    - Manage users (delete, change roles)

---

## Technologies Used

- PHP (backend logic)
- MySQL (database)
- PDO (secure database access)
- JavaScript (AJAX interactions)
- Bootstrap 5 (UI design)
- RAWG API (game data)

---

## Security Features

- Password hashing (bcrypt)
- Prepared SQL statements (PDO)
- Input sanitization (`htmlspecialchars`)
- Session-based authentication

---

## How to Run the Project

1. Import the database:
    
    - Use `sql/steams_db.sql`
2. Configure database access:
    
    - Edit `config/database.php`
3. Configure API key:
    
    - Add your RAWG API key in `config/api.php`
4. Run the project:
    
    - Place in a local server (XAMPP, WAMP, Docker)
    - Access via browser (e.g., [http://localhost](http://localhost))

---

## Notes

- The project follows a simplified MVC pattern
- External API errors are handled gracefully
- Code is modular for easy maintenance and extension

---

## Authors

Project developed by a student group as part of a web development course.

