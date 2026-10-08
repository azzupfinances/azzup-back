# Docker

## Purpose
Planned container layout for development and deployment.

## Status
Placeholder only. `docker-compose.yml`, `docker/php/*`, and `deploy.sh` contain no working configuration.

## Planned Services
| Service | Responsibility |
|---|---|
| `app` | PHP-FPM running Laravel (`docker/php/Dockerfile`). |
| `nginx` | HTTP server (`docker/nginx/default.conf`). |
| `postgres` | PostgreSQL database. |
| `queue` | Queue worker. |
| `scheduler` | Scheduled task runner. |
| `mailpit` | Development email capture. |
| `reverb` | WebSocket server (optional). |

## Rules
- `app`, `queue`, `scheduler`, and `reverb` share one PHP image.
- Configuration comes from environment variables (`.env`, never committed).
- `docker/php/uploads.ini` holds PHP upload limit overrides.
- `docker/php/entrypoint.sh` holds container startup steps.

## Related Documentation
- [Nginx](nginx.md)
- [Queues](queues.md)
- [Scheduler](scheduler.md)
- [WebSocket](websocket.md)
