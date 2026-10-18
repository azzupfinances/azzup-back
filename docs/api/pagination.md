# Pagination

## Purpose
Reusable standard for paginating list endpoints.

## Rules
- List endpoints are paginated by default.
- Page size is client-controlled within a documented maximum.
- Responses include items under `data` plus pagination metadata.
- Use Laravel's built-in paginators.

## Exceptions
- A list bounded by a required period filter whose client needs every item at once (e.g. the monthly statement, which shows month totals) is not paginated. The endpoint documents this.

## Conventions
- Parameter names and metadata shape are defined with the first list endpoint, then documented here.

## Related Documentation
- [JSON Responses](json-responses.md)
- [Filtering](filtering.md)
- [Sorting](sorting.md)
