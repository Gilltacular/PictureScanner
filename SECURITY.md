# Security Policy

## Supported Versions

This policy applies to the following versions of PictureScanner:

| Version | Supported |
| ------- | --------- |
| Latest (2026 security hardening) | ✅ Yes |
| Original University Project (2017) | ⚠️ Historical only |

**Note:** This is a completed university project with security hardening applied in 2026. It is not under active development. Vulnerabilities reported against the legacy 2017 codebase will be reviewed for educational reference but may not receive patches.

## Reporting a Vulnerability

I take security seriously and welcome responsible disclosure from security researchers. If you believe you've found a security vulnerability in PictureScanner, please follow these guidelines:

### How to Report

**Preferred Method:** Create a private security advisory via GitHub Security Advisories (if available for this repository)

**Alternative Method:** Email directly to `vulnerability.authentic389@passmail.net` with the subject line: `[VULN] PictureScanner - [Vulnerability Type]`

**PGP Key:** [Available upon request via secure channel](https://proton.me/pass)

### What to Include

Please provide the following information to help me understand and reproduce the vulnerability:

- **Vulnerability Type:** (e.g., SQL Injection, XSS, CSRF, Authentication Bypass, etc.)
- **Location:** File path, function name, or endpoint affected
- **Impact:** What an attacker could achieve if exploited
- **Reproduction Steps:** Detailed steps or proof-of-concept code
- **Affected Version:** Which version of the codebase is vulnerable
- **Remediation Suggestion:** (Optional) Any fix guidance you can provide

### Response Timeline

I follow OWASP Vulnerability Disclosure best practices and commit to:

| Stage | Expected Timeline |
| ----- | ----------------- |
| Initial Acknowledgment | Within 48 hours of report receipt |
| Vulnerability Assessment | Within 14 days of acknowledgment |
| Remediation Plan | Within 30 days if vulnerability is confirmed |
| Public Disclosure | Only after fix is available and users have had reasonable time to patch |

## Safe Harbor

If you conduct vulnerability research in accordance with this policy, I will not initiate or support legal action against you for accidental or good-faith violations of this policy. This includes:

- Testing the application in your own environment or with explicit permission
- Reporting vulnerabilities through the designated channels
- Providing reasonable time for remediation before public disclosure

This project follows GitHub's [Coordinated Disclosure Guidelines](https://docs.github.com/en/code-security/concepts/vulnerability-reporting-and-management/coordinated-disclosure) and OWASP's [Vulnerability Disclosure Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/Vulnerability_Disclosure_Cheat_Sheet.html).

## Scope

This security policy covers the following components:

| Component | In Scope | Notes |
| --------- | -------- | ----- |
| Authentication System | ✅ Yes | Login, registration, session management |
| Password Storage | ✅ Yes | bcrypt + SHA512 implementation |
| Session Management | ✅ Yes | Session hardening, regeneration, timeout |
| Database Layer | ✅ Yes | Prepared statements, parameterized queries |
| Input Validation | ✅ Yes | User input sanitization at all entry points |
| Image Upload Handler | ✅ Yes | File type validation, malware scanning |
| Third-Party Dependencies | ⚠️ Partial | Reviewed during security audit only |
| Deployment Configuration | ❌ No | Assumes secure hosting environment |

## Known Limitations

This project has documented security limitations that should be understood before deployment:

| Issue | Severity | Status |
| ----- | -------- | ------ |
| Bootstrap 3 Legacy Framework | Moderate | ⚠️ Accepted Risk — Migration to Bootstrap 5 pending |
| No Automated SAST Scanning in CI/CD | Moderate | 📋 Planned — Security pipeline integration scheduled |
| No Formal Penetration Test | Low | ℹ️ Educational project — Not intended for production use |
| Limited Test Coverage for Edge Cases | Low | 📋 In Progress — Security-focused unit tests being added |

## Security Best Practices Reference

The security controls implemented in this project align with the following standards:

- **OWASP Top 10 2025:** [owasp.org/www-project-top-ten/](https://owasp.org/www-project-top-ten/)
- **OWASP Secure Coding Practices:** [owasp.org/www-project-secure-coding-practices-quick-reference-guide/](https://owasp.org/www-project-secure-coding-practices-quick-reference-guide/)
- **OWASP Authentication Cheat Sheet:** [cheatsheetseries.owasp.org/cheatsheets/Authentication_Cheat_Sheet.html](https://cheatsheetseries.owasp.org/cheatsheets/Authentication_Cheat_Sheet.html)
- **OWASP Password Storage Cheat Sheet:** [cheatsheetseries.owasp.org/cheatsheets/Password_Storage_Cheat_Sheet.html](https://cheatsheetseries.owasp.org/cheatsheets/Password_Storage_Cheat_Sheet.html)

## Credits

Security hardening applied by Jon Gill, August 2026.

Original project concept by Team: Gill, MDeque, JC.

Thank you to security researchers who responsibly disclose vulnerabilities — your work helps make software more secure for everyone.

---

Last Updated: August 2026
