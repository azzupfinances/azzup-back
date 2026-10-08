# Filtering

## Purpose
Reusable standard for filtering list endpoints.

## Rules
- Filters are passed as query parameters.
- Only whitelisted fields can be filtered; unknown filters are rejected or ignored consistently.
- Filter parameters are validated by the endpoint's Form Request.
- Soft-deleted records are excluded by default; inclusion is opt-in and must be explicitly allowed per endpoint.
- Shared filtering logic belongs in `app/Support/` or `app/Services/Concerns/`, implemented once.

## Conventions
- Parameter names: snake_case, matching documented field names.
- Exact parameter syntax is defined when the first list endpoint is implemented, then documented here.

## Related Documentation
- [Sorting](sorting.md)
- [Pagination](pagination.md)
- [Soft Deletes](../database/soft-deletes.md)
