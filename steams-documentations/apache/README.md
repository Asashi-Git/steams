# Apache HTTP Server Configuration Documentation

## Introduction
This document describes the structure and purpose of the provided Apache HTTP Server configuration file. It explains key directives, modules, and behaviors.

---

## Core Server Settings

### ServerRoot
- **Value:** `/etc/httpd/`
- Defines the base directory for configuration, logs, and runtime files.

### Listen
- **Value:** `8082`
- Apache listens for incoming HTTP requests on port 8082.

---

## Module Loading

Apache uses modular architecture. Enabled modules include:

### Core & Processing
- `mpm_event_module` → Handles concurrent connections efficiently

### Authentication & Authorization
- `authn_core_module`, `authz_core_module`
- `auth_basic_module`, `authz_user_module`, `authz_host_module`

### Content Handling
- `mime_module` → Determines file types
- `dir_module` → Directory index handling
- `autoindex_module` → Directory listing

### Compression & Performance
- `deflate_module` → Enables gzip compression
- `expires_module` → Controls caching headers

### Proxy
- `proxy_module`, `proxy_fcgi_module`

### Logging
- `log_config_module`

---

## User & Permissions

### User / Group
- **User:** `http`
- **Group:** `http`
- Apache runs under this system account for security.

---

## Main Server Configuration

### ServerAdmin
- **Value:** `you@example.com`
- Email address shown in error messages.

### DocumentRoot
- **Value:** `/srv/http/steams/code/`
- Root directory from which files are served.

---

## Directory Permissions

### Root Directory Restriction
```
<Directory />
    AllowOverride none
    Require all denied
</Directory>
```
- Denies access to entire filesystem by default.

### Web Directory
```
<Directory "/srv/http">
    Options Indexes FollowSymLinks
    AllowOverride None
    Require all granted
</Directory>
```

| Directive | Meaning |
|----------|--------|
| Options Indexes | Allows directory listing |
| FollowSymLinks | Allows symbolic links |
| AllowOverride None | Disables .htaccess |
| Require all granted | Allows public access |

---

## Default Index File

```
DirectoryIndex index.php
```
- Apache serves `index.php` when a directory is requested.

---

## Security

### Protect Hidden Files
```
<Files ".ht*">
    Require all denied
</Files>
```
- Prevents access to `.htaccess` and `.htpasswd`.

---

## Logging

### Error Log
- `/var/log/httpd/error_log`

### Access Log
- `/var/log/httpd/access_log`

### Log Format
- `common` format used by default

---

## CGI Configuration

### Script Alias
```
ScriptAlias /cgi-bin/ "/srv/http/cgi-bin/"
```

### Directory Permissions
```
<Directory "/srv/http/cgi-bin">
    AllowOverride None
    Options None
    Require all granted
</Directory>
```

---

## MIME Types

### Configuration File
- `conf/mime.types`

### Custom Types
- `.gz`, `.tgz` → gzip
- `.Z` → compress

---

## Included Configuration Files

| File | Purpose |
|------|--------|
| httpd-mpm.conf | Process management |
| httpd-autoindex.conf | Directory listing UI |
| httpd-languages.conf | Language support |
| httpd-userdir.conf | User directories |
| httpd-default.conf | Default settings |

---

## Optional Features (Disabled)

- SSL (`mod_ssl`)
- Virtual Hosts
- URL rewriting (`mod_rewrite`)
- HTTP/2
- WebDAV

---

## Summary

This configuration defines:
- A server running on **port 8082**
- A **document root** at `/srv/http/steams/code/`
- Strict default security with explicit directory permissions
- Logging and compression enabled
- Proxy and FastCGI support available
- Modular architecture with many optional features disabled

