# WebSocket

## Purpose
Planned real-time broadcasting (optional).

## Rules
- Laravel Reverb is optional and adopted only when a feature requires real-time updates.
- Broadcast through Laravel Events (`app/Events/`).
- Private channels require authorization.
- Runs as the `reverb` service.

## Related Documentation
- [Docker](docker.md)
