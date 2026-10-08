# Directory Structure

## Purpose
Defines where each kind of file lives.

## Repository Root
| Path | Responsibility |
|---|---|
| `src/` | Laravel application root (future installation target). |
| `docker/` | Container definitions (`nginx/`, `php/`). |
| `docs/` | Architectural standards. |
| `bruno/` | Bruno HTTP request collections. |
| `docker-compose.yml`, `deploy.sh`, `.env.example` | Infrastructure entry points. |

## Application (`src/app/`)
| Path | Responsibility |
|---|---|
| `Http/Controllers/{Module}/` | Invokable controllers. |
| `Http/Requests/{Module}/` | Form Requests. |
| `Http/Middleware/` | HTTP middleware. |
| `Services/{Module}/` | Business logic. |
| `Services/Concerns/` | Traits shared across Services. |
| `Policies/` | Authorization. |
| `Models/` | Eloquent models. |
| `Enums/` | PHP backed enums. |
| `Jobs/` | Queued jobs. |
| `Console/Commands/` | Artisan commands. |
| `Mail/` | Mailables. |
| `Events/`, `Listeners/` | Domain events and handlers. |
| `Exceptions/` | Custom exceptions. |
| `Helpers/` | Stateless helper functions. |
| `Contracts/` | Interfaces, only when multiple implementations exist. |
| `Rules/` | Custom validation rules. |
| `Support/` | Reusable infrastructure code (e.g. listing query helpers). |
| `Providers/` | Service providers. |

## Other `src/` Paths
- `routes/api.php` includes `routes/{module}.php` files. `routes/console.php` holds commands and schedules.
- `database/migrations/`, `database/factories/`, `database/seeders/` (`seeders/Permissions/` for permission seeders).
- `tests/Feature/`, `tests/Unit/`.

## Rules
- Paths must stay compatible with a standard Laravel installation.
- Empty directories are preserved with `.gitkeep`; remove it once the directory has real files.

## Related Documentation
- [Module Creation](module-creation.md)
- [Naming Conventions](../conventions/naming.md)
