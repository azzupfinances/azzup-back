# Soft Deletes

## Purpose
When and how to use soft deletion.

## Rules
- Use `SoftDeletes` only when deleted records must be recoverable or retained.
- The table needs a nullable `deleted_at` column (`softDeletes()` in migrations).
- Soft-deleted records are excluded from queries by default.
- Exposing soft-deleted records in list endpoints is opt-in and whitelisted per endpoint.

## Related Documentation
- [Models](../modules/models.md)
- [Filtering](../api/filtering.md)
