# Pagination

## Purpose
Reusable standard for paginating list endpoints.

## Rules
- List endpoints are paginated by default.
- Page size is client-controlled within a documented maximum.
- Responses include items under `data` plus pagination metadata.
- Use Laravel's built-in paginators.

## Conventions
- Parameter names and metadata shape are defined with the first list endpoint, then documented here.

## Related Documentation
- [JSON Responses](json-responses.md)
- [Filtering](filtering.md)
- [Sorting](sorting.md)
