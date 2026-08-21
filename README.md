# PictureScanner

**Secure Image Scanning Platform with Authentication Hardening**

---

<div align="center">

![Security](https://img.shields.io/badge/Security-Defense_In_Depth-brightgreen)
![PHP](https://img.shields.io/badge/PHP-MySQL-darkblue)
![Full-Stack](https://img.shields.io/badge/Full-Stack-orange)

</div>

---

## 🔐 Security Architecture Summary

This web application implements a **defense-in-depth security model** throughout the authentication and data access layers. Every security control maps to an OWASP Top 10 mitigation category, demonstrating secure coding practices as a first-class requirement rather than an afterthought.

**Security Controls Implemented:**
- Multi-layer password hashing (bcrypt + SHA512) — mitigates OWASP A07 (Identification and Authentication Failures)
- Session regeneration and hardening — mitigates OWASP A07
- Brute-force rate limiting — mitigates OWASP A07
- Parameterized queries — mitigates OWASP A03 (Injection)
- Input validation and output encoding — mitigates OWASP A03 and A07 (Cross-Site Scripting)

[View full threat model →](#threat-model-stride-analysis) (coming soon...)

---

## Status

⚠️ **Completed University Project (2017)** — Security hardening and SQL injection fixes applied 2026.

Core authentication system, session management, and registration flow are complete and secure. 
Image upload and color scanning are functional. Search and delete features were planned but not implemented.

**Security Audit Date:** August 2026 | **OWASP Alignment:** Verified against OWASP Secure Coding Practices Quick Reference Guide

---

## Project Overview

PictureScanner is a web-based image scanning application that allows users to upload and analyze images with embedded metadata extraction and color profiling. Built as a collaborative team project with emphasis on secure authentication flows and defensive coding practices.

**Team Members:** Gill, MDeque, JC

---

## Tech Stack

- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap 3
- **Backend:** PHP, MySQL (mysqli with prepared statements)
- **Authentication:** bcrypt + SHA512, session management
- **Architecture:** MVC-inspired separation of concerns
- **Note:** Bootstrap 3 legacy framework; migration path exists for Bootstrap 5 compatibility.

---

## 🔒 Security Features Implemented

### Authentication Security

| Feature | Implementation | OWASP Category Mitigated |
|---------|----------------|---------------------------|
| Password Hashing | Combined bcrypt + SHA512 for defense-in-depth | A07: Identification and Authentication Failures |
| Salt Generation | Per-user cryptographic salt on registration | A07: Broken Authentication |
| Password Storage | Never stored in plaintext, never logged | A07: Credential Exposure |

### Session Hardening

| Feature | Implementation | OWASP Category Mitigated |
|---------|----------------|---------------------------|
| Session Regeneration | New session ID issued on every login | A07: Session Fixation |
| Session Timeout | Configurable idle timeout with forced logout | A07: Session Hijacking |
| HTTP-Only Cookies | Session cookie inaccessible to JavaScript | A07: Session Theft via XSS |
| Secure Transport | HTTPS enforcement (deployment requirement) | A07: Man-in-the-Middle |

### Attack Mitigation

| Feature | Implementation | OWASP Category Mitigated |
|---------|----------------|---------------------------|
| Brute-Force Protection | Login attempt throttling with exponential backoff and account lockout after configurable threshold | A07: Brute Force Attacks |
| SQL Injection Prevention | Parameterized queries (prepared statements) throughout all database operations | A03: Injection |
| XSS Mitigation | Input sanitization at entry points, output encoding at display layer | A03: Cross-Site Scripting |
| CSRF Protection | Token-based request validation on state-changing operations | A08: Security Misconfiguration |

---

## Threat Model (STRIDE Analysis)

A STRIDE threat model was conducted to identify potential attack vectors. This section documents the identified threats and their mitigations.

### Threat Categories

| Threat Type | Identified Risk | Mitigation Implemented |
|-------------|-----------------|------------------------|
| **S**poofing | Attacker impersonating legitimate user | Strong password hashing, session regeneration |
| **T**ampering | Attacker modifying user data in transit or at rest | Prepared statements, input validation |
| **R**epudiation | User denying actions taken | Session logging, audit trail (future enhancement) |
| **I**nformation Disclosure | Sensitive data exposed to unauthorized parties | Encrypted passwords, secure session storage |
| **D**enial of Service | Application overwhelmed by malicious traffic | Rate limiting, resource exhaustion prevention |
| **E**levation of Privilege | Regular user accessing admin functionality | Role-based access control (RBAC) design pattern |

[See full threat model diagram →](docs/THREAT_MODEL.md) *(Coming soon)*

---

## Skills Demonstrated

- **Secure Authentication:** Multi-layer password hashing, session regeneration, credential storage
- **Session Management:** Hardened cookies, HTTP-only flags, secure transport requirements
- **SQL Injection Prevention:** Prepared statements (mysqli), parameter binding, no dynamic SQL construction
- **XSS/CSRF Mitigation:** Input sanitization, token validation, output encoding
- **Full-Stack Development:** PHP/MySQL/JavaScript integration with security-first design
- **Team Collaboration:** Distributed development, version control workflow with security review checkpoints

---

## Security Documentation

This repository includes the following security artifacts:

| Artifact | Purpose |
|----------|---------|
| `SECURITY.md` | Vulnerability reporting policy and responsible disclosure guidelines |
| `THREAT_MODEL.md` | STRIDE analysis and data flow diagrams |
| `AUDIT_LOG.md` | Security hardening changes and their rationale |

---

## Credits

- Original concept: Team project (Gill, MDeque, JC)
- Security hardening: Jon Gill, 2026 (post-deployment security audit and remediation)

---

<div align="center">

[![License](https://img.shields.io/badge/License-MIT-yellow)](#license)
[![Author](https://img.shields.io/badge/Author-Jon_Gill-purple)](https://github.com/Gilltacular)

</div>

---

## License

MIT License - See LICENSE file for details.

---

Built with ❤️ by **Jon Gill** - Security-focused developer  
*Demonstrating secure authentication architecture, defense-in-depth patterns, and OWASP-aligned secure coding practices*
