# Project Configuration Documentation

## Overview

This repository contains two main configuration directories:

- **Apache HTTP Server configuration**
- **MariaDB database configuration**

This README provides a high-level explanation of what you will find inside each directory and how they are structured.

---

## Apache Configuration Directory

This directory contains the configuration files responsible for running and managing the Apache HTTP Server.

### What you will find inside:

- **Main server configuration**
    
    - Core settings such as server root, listening ports, and global behavior.
- **Module configurations**
    
    - Files enabling and configuring Apache modules (e.g., proxy, SSL, autoindex).
- **Performance and process management**
    
    - MPM (Multi-Processing Module) settings that control how Apache handles requests.
- **Error handling**
    
    - Custom error pages and multi-language error configurations.
- **Optional features**
    
    - Virtual hosts (if enabled)
    - SSL/TLS configuration
    - WebDAV support
    - Server status and info modules

### Purpose

This directory defines how the web server behaves, including:

- How it listens for requests
- How it serves content
- How it handles errors and logging
- Which features are enabled or disabled

---

## MariaDB Configuration Directory

This directory contains the configuration and documentation related to the MariaDB database.

### What you will find inside:

- **Database structure description**
    
    - Tables, columns, and data types
- **Relationships**
    
    - Links between tables (foreign keys)
- **Constraints**
    
    - Primary keys, unique constraints, and indexes
- **Database settings**
    
    - Configuration influencing performance and storage behavior

### Purpose

This directory explains how data is structured and managed, including:

- How information is stored
- How tables relate to each other
- Rules ensuring data integrity

---

## How to Use This Repository

- Refer to the **Apache documentation file** to understand server behavior.
- Refer to the **MariaDB documentation file** to understand the database schema.
- Use both together to get a complete view of how the application is deployed and how data flows through it.

---

## Summary

- Apache configuration controls **server behavior and request handling**
- MariaDB configuration defines **data structure and storage**
- This repository provides a **clear and documented overview** of both components
