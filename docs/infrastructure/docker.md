# Docker

## Purpose
Container layout for local development.

## Status
Development stack only. Production deployment (`deploy.sh`) is not defined yet.

## Services
| Service | Responsibility |
|---|---|
| `app` | PHP-FPM running Laravel (`docker/php/Dockerfile`). Installs Composer dependencies on startup when `vendor/` is missing. |
| `nginx` | HTTP server (`docker/nginx/default.conf`), published on `APP_PORT`. |
| `postgres` | PostgreSQL 17, data in the `postgres-data` volume, published on `DB_FORWARD_PORT`. |
| `queue` | `php artisan queue:work`. |
| `scheduler` | `php artisan schedule:work`. |
| `mailpit` | Development email capture, UI on `MAILPIT_UI_PORT`. |

## Rules
- `app`, `queue`, and `scheduler` share one PHP image (`azzup-php`).
- PHP containers run as a non-root user whose UID/GID match the host (`UID`/`GID` in `.env`), so generated files keep host ownership.
- `src/` is bind-mounted; code changes need no rebuild. Changes to `docker/php/*` require `docker compose build`.
- The root `.env` is the only environment file: Compose reads it for interpolation and passes it to the PHP containers. There is no `src/.env`. Recreate containers (`docker compose up -d`) after editing it.
- `docker/php/uploads.ini` holds PHP upload limits; keep them in sync with `client_max_body_size` in `docker/nginx/default.conf`.
- `docker/php/entrypoint.sh` holds container startup steps. Migrations are never run automatically.
- Run PHP, Artisan, and Composer through the `app` container, never on the host.

## First Run
```sh
cp .env.example .env
docker compose build
docker compose run --rm --no-deps app php artisan key:generate --show   # paste into APP_KEY in .env
docker compose up -d
docker compose exec app php artisan migrate
```
If a default port is taken, change `APP_PORT`, `DB_FORWARD_PORT`, or `MAILPIT_UI_PORT` (and `APP_URL`) in `.env`.

## Common Commands
| Task | Command |
|---|---|
| Artisan | `docker compose exec app php artisan <command>` |
| Composer | `docker compose exec app composer <command>` |
| Tests | `docker compose exec app php artisan test` |
| Logs | `docker compose logs -f <service>` |
| Restart workers after code changes | `docker compose restart queue` |
| Stop | `docker compose down` (add `-v` to delete the database) |

## Related Documentation
- [Nginx](nginx.md)
- [Queues](queues.md)
- [Scheduler](scheduler.md)
