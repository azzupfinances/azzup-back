# Routes

## Purpose
Organize API endpoints by module.

## Rules
- Each module has its own route file: `routes/{module}.php`.
- `routes/api.php` only includes module route files and shared groups.
- Apply middleware (authentication, throttling) at the group level when possible.
- Route to invokable Controllers.
- Name routes using dot notation.

## Conventions
- Route file names and URL paths: kebab-case.
- Resource segments: plural nouns.
- Route names: `{module}.{action}`.
- A `{month}` segment is always `YYYY-MM`: the global pattern in `AppServiceProvider` answers 404 to anything else.

## Related Documentation
- [Controllers](controllers.md)
- [Authentication](../authentication/overview.md)
- [Naming Conventions](../conventions/naming.md)
