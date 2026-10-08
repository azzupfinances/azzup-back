# Sorting

## Purpose
Reusable standard for ordering list endpoints.

## Rules
- Sorting is controlled by query parameters.
- Only whitelisted fields can be sorted.
- Each endpoint defines a deterministic default sort.
- Direction is ascending or descending only.

## Conventions
- Exact parameter syntax is defined when the first list endpoint is implemented, then documented here.

## Related Documentation
- [Filtering](filtering.md)
- [Pagination](pagination.md)
