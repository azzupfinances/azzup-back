# Nginx

## Purpose
Planned HTTP server role.

## Rules
- Serves `src/public` as the document root.
- Forwards PHP requests to the `app` service (PHP-FPM).
- Upload size limits must match `docker/php/uploads.ini`.
- Configuration file: `docker/nginx/default.conf` (placeholder).

## Related Documentation
- [Docker](docker.md)
