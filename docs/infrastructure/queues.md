# Queues

## Purpose
Planned background job processing.

## Rules
- Slow or external work (email, integrations) runs in queued Jobs.
- Jobs live in `app/Jobs/` and delegate business logic to Services.
- Jobs must be idempotent and safe to retry.
- Processed by the `queue` service.

## Related Documentation
- [Docker](docker.md)
- [Services](../modules/services.md)
