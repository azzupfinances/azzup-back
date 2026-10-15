# Azzup

Personal finance management API for Brazilian employees working under the CLT employment model.
See [docs/business/product-overview.md](docs/business/product-overview.md).

## Status

Laravel is installed and the development stack runs in Docker. No business functionality is implemented.

## Layout

- `src/` — Laravel application root.
- `docker/` — container definitions.
- `docs/` — architectural standards; `docs/business/` — business requirements. Start at [docs/README.md](docs/README.md).
- `bruno/` — future Bruno HTTP request collections.
- `CLAUDE.md` — documentation router for AI-assisted development.

## Stack

Laravel, PHP, PostgreSQL, Docker Compose, Nginx, Sanctum, Telescope, Pulse, Pint, Queues, Scheduler, Mailpit.
See [docs/infrastructure/docker.md](docs/infrastructure/docker.md) for setup and commands.
