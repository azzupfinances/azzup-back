# Sorting

## Purpose
Reusable standard for ordering list endpoints.

## Rules
- Sorting is controlled by query parameters.
- Only whitelisted fields can be sorted.
- Each endpoint defines a deterministic default sort.
- Direction is ascending or descending only.

## Conventions
- Exact parameter syntax is defined when the first sortable list endpoint is implemented, then documented here.
- Endpoints with a fixed order (e.g. the monthly statement: newest date first, then newest record) take no sort parameter.

## Related Documentation
- [Filtering](filtering.md)
- [Pagination](pagination.md)
