# Authentication

## Purpose
How API clients authenticate.

## Rules
- Laravel Sanctum personal access tokens (`Authorization: Bearer {token}`).
- Users log in with CPF and password ([Users](../business/users.md)). CPF is stored as 11 digits; formatted input is normalized in the Form Request.
- Passwords are hashed with Argon2id (`config/hashing.php`). Tests lower `ARGON_MEMORY` and `ARGON_TIME` in `phpunit.xml` for speed.
- Registration and login return `data.user` and `data.token`. Logout revokes only the current token.
- Invalid credentials return 401 with `Invalid credentials.`, without revealing whether the CPF exists.
- Protected routes apply `auth:sanctum` at the route group level.
- Unauthenticated requests return 401 JSON responses.
- Registration and login use the `auth` rate limiter (`AppServiceProvider`), keyed by CPF and IP.

## Endpoints
| Method | Path | Auth |
|---|---|---|
| POST | `/api/auth/register` | none |
| POST | `/api/auth/login` | none |
| POST | `/api/auth/logout` | token |

## Related Documentation
- [Permissions](../permissions/overview.md)
- [Routes](../modules/routes.md)
