# Authentication

## Purpose
Planned authentication approach.

## Rules
- Planned: Laravel Sanctum token authentication.
- Not implemented yet. No users, guards, or login flows exist.
- Protected routes apply authentication middleware at the route group level.
- Unauthenticated requests return 401 JSON responses.
- Follow Laravel security best practices (hashed passwords, rate limiting on sensitive endpoints).

## Related Documentation
- [Permissions](../permissions/overview.md)
- [Routes](../modules/routes.md)
