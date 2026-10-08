# Services

## Purpose
Hold business logic, isolated from HTTP concerns.

## Rules
- One responsibility per Service.
- Single public entry point: `execute()`.
- No access to the HTTP request or response objects; receive plain data.
- Throw exceptions for failures; do not return HTTP status codes.
- Reuse existing Services and `Services/Concerns/` traits when appropriate.
- Avoid unnecessary abstractions (no interface unless multiple implementations exist).

## Conventions
- Location: `app/Services/{Module}/`.
- Name: `{Verb}{Subject}Service` (PascalCase).
- Shared traits: `app/Services/Concerns/`.

## Related Documentation
- [Controllers](controllers.md)
- [Exception Handling](../api/exception-handling.md)
