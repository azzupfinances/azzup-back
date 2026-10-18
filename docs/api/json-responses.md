# JSON Responses

## Purpose
Single response format for all API output.

## Rules
- Every response is JSON, including errors.
- Use appropriate HTTP status codes (200, 201, 204, 401, 403, 404, 422, 500, etc.).
- Success payloads wrap content in a `data` key; optional `message` in English.
- Error payloads contain a `message` key in English; validation errors also contain `errors`.
- Never expose stack traces or internal details outside local environments.
- Keys use snake_case.

## Conventions
```json
{ "data": {}, "message": "Optional message." }
```
- Calendar dates without time (e.g. `transaction_date`) are `YYYY-MM-DD` strings, in input and output.
- Months are `YYYY-MM` strings.

## Related Documentation
- [Exception Handling](exception-handling.md)
- [Validation Errors](validation-errors.md)
- [Pagination](pagination.md)
