# MariaDB Documentation

## 1. Conceptual Data Model (CDM)

The CDM defines business entities and their semantic interactions, without any technical constraints related to the database engine.

![](screenshot_2026-03-31_19-02-56.png)

> [!NOTE] 
> **Asymmetric Logic of Cardinalities**
> 
> Dependency analysis has helped secure the application logic:
> - **One-to-Many (1:N)**: A review concerns one and only one game (1,1), but a game can receive from zero to many reviews (0,n). This guarantees the isolation of ratings (a single review cannot simultaneously modify the overall rating of multiple games).
> - **Many-to-Many (N:M)**: A game can be available on several platforms (1,n) and a platform hosts several games (1,n). This complex cardinality requires specific resolution when transitioning to the logical model.

---

## 2. Logical Data Model (LDM)

The LDM is the technical translation of the CDM. It paves the way for the DDL (Data Definition Language) script by introducing the concepts of primary keys (PK), foreign keys (FK), and data types.

![](screenshot_2026-03-31_19-02-25.png)

> [!IMPORTANT] 
> **Resolution of Complex Relationships**
> 
> The Many-to-Many relationships from the CDM (*Available on* and *Belongs*) have been canonically transformed into junction tables in the LDM (`available_on` and `belongs`).
> 
> **Integrity constraint**: These junction tables use a composite primary key (the strict union of `id_game` and `id_platform` / `id_category`). This prevents any logical attack or API error attempting to link the same category to the same game multiple times.


> [!NOTE] 
> **Official References**
> - [DBML (Database Markup Language) Documentation](https://dbml.org/docs/)
> - [MariaDB: InnoDB Foreign Key Constraints](https://mariadb.com/kb/en/innodb-foreign-key-constraints/)

## MariaDB Database Documentation

## Overview
This database (`steams_db`) is designed to manage a video game platform including games, users, reviews, categories, and platforms.

---

## Entity Relationship Overview

```
Users ───< Likes >─── Games ───< Belongs >─── Categories
   │                     │
   └────< Reviews >──────┘
   
Users ─── Roles
Games ─── Platforms (via available_on)
```

---

## Tables Description

### Users
Stores registered users.

- **id_user** (PK)
- username (unique)
- email (unique)
- password (hashed)
- id_role (FK → roles)

---

### Roles
Defines user permissions.

- **id_role** (PK)
- title (admin, reviewer, member)
- description

---

### Games
Stores game information.

- **id_game** (PK)
- external_id
- name
- description
- release_date
- image

---

### Categories
Game categories (genres).

- **id_category** (PK)
- name
- description

---

### Belongs (Many-to-Many)
Links games to categories.

- **id_game** (FK → games)
- **id_category** (FK → categories)

Primary Key: (id_game, id_category)

---

### Platforms
Gaming platforms.

- **id_platform** (PK)
- name
- manufacturer

Examples:
- PC
- PlayStation 5
- Xbox Series X
- Nintendo Switch

---

### Likes (Many-to-Many)
Tracks which users like which games.

- **id_user** (FK → users)
- **id_game** (FK → games)

Primary Key: (id_user, id_game)

---

### Reviews
User reviews for games.

- **id_review** (PK)
- title
- content
- notation (rating)
- creation_date
- id_user (FK → users)
- id_game (FK → games)
- pinned (boolean)

---

## Key Relationships

| Relationship | Type | Description |
|-------------|------|------------|
| Users → Roles | Many-to-One | Each user has one role |
| Users ↔ Games (Likes) | Many-to-Many | Users can like multiple games |
| Users ↔ Games (Reviews) | One-to-Many | Users write reviews |
| Games ↔ Categories | Many-to-Many | Games belong to categories |

---

## Constraints & Rules

- **Foreign Keys with CASCADE DELETE**
  - Deleting a user removes:
    - their likes
    - their reviews
  - Deleting a game removes:
    - related likes
    - related reviews
    - category links

- **Unique Constraints**
  - username
  - email

---

## Notes

- Database uses **InnoDB** engine (supports transactions & FK constraints)
- Character encoding: **utf8mb4** (full Unicode support)
- Reviews include a **pinned** feature for highlighting content
- Composite tables (`likes`, `belongs`) ensure efficient many-to-many relationships

---

## Example Use Cases

- A user can:
  - Like multiple games
  - Write reviews
  - Have a role (admin, reviewer, member)

- A game can:
  - Belong to multiple categories
  - Receive multiple reviews
  - Be liked by many users

---

## Summary

This schema follows a **relational design with normalization**, using:
- Junction tables for many-to-many relationships
- Foreign keys for integrity
- Cascading deletes for consistency

It is well-suited for a **game review and discovery platform**.