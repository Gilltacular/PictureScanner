# PictureScanner

**Secure Image Scanning Platform with Authentication Hardening**

---

<div align="center">

![Security](https://img.shields.io/badge/Security-Auth-brightgreen)
![PHP](https://img.shields.io/badge/PHP-MySQL-darkblue)
![Full-Stack](https://img.shields.io/badge/Full-Stack-orange)

</div>

---

## Status

⚠️ **Completed University Project (2017)** — Security hardening and SQL injection fixes applied 2026.

Core authentication system, session management, and registration flow are complete and secure. 
Image upload and color scanning are functional. Search and delete features were planned but not implemented.

---

## 🔐 Security-First Architecture

This project implements security best practices throughout the application stack. Built with PHP, MySQL, and JavaScript featuring bcrypt + SHA512 password hashing, session hardening, and brute-force attack mitigation.

---

## 📁 Project Overview

PictureScanner is a web-based image scanning application that allows users to upload and analyze images with embedded metadata extraction and color profiling. Built as a collaborative team project with emphasis on secure authentication flows and defensive coding practices.

**Team Members:** Gill, MDeque, JC

---

## 🛠️ Tech Stack

- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap
- **Backend:** PHP, MySQL (mysqli with prepared statements)
- **Note:** Uses Bootstrap 3 (legacy). Fully functional but would require migration for Bootstrap 5 compatibility.
- **Authentication:** bcrypt + SHA512, session management
- **Architecture:** MVC-inspired separation of concerns

---

## 🔒 Security Features Implemented

- Password Hashing — Combined bcrypt and SHA512 for defense-in-depth
- Session Hardening — Regenerated session IDs on login, timeout enforcement
- Brute-Force Protection — Login attempt throttling and account lockout
- SQL Injection Prevention — Prepared statements (mysqli) throughout authentication and registration flows
- XSS Mitigation — Input sanitization and output escaping
- CSRF Protection — Token-based request validation

---

## 💡 Skills Demonstrated

- Secure Authentication — Multi-layer password hashing, session regeneration
- Session Management — Hardened cookies, HTTP-only flags, secure transport
- SQL Injection Prevention — PDO prepared statements, parameter binding
- XSS/CSRF Mitigation — Input sanitization, token validation
- Full-Stack Development — PHP/MySQL/JavaScript integration
- Team Collaboration — Distributed development, version control workflow

---

## 📄 License

MIT License - See LICENSE file for details.

---

<div align="center">

[![License](https://img.shields.io/badge/License-MIT-yellow)](#license)
[![Author](https://img.shields.io/badge/Author-Jon_Gill-purple)](https://github.com/Gilltacular)

</div>

---

Built with ❤️ by **Jon Gill** - Security-focused developer transitioning from law enforcement investigation  
*Demonstrating secure authentication architecture and full-stack development*
