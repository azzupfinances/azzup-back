# Architecture Overview

## Purpose
High-level shape of the API. Details live in the linked standards.

## Rules
- JSON-only REST API built on Laravel.
- Code is organized by module: each module owns its Controllers, Requests, Services, and route file.
- Responsibilities are separated: validation (Form Requests), authorization (Policies), business logic (Services), HTTP coordination (Controllers), persistence (Models).
- Modules are created only when a real feature requires them. No sample modules.
- Prefer simple, direct code. Avoid premature abstraction.

## Related Documentation
- [Directory Structure](directory-structure.md)
- [Request Lifecycle](request-lifecycle.md)
- [Module Creation](module-creation.md)
