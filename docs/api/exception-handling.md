# Exception Handling

## Purpose
Convert all exceptions into consistent JSON errors in one place.

## Rules
- Exception rendering is centralized in Laravel's exception configuration (`bootstrap/app.php`).
- Controllers and Services do not catch exceptions just to format responses.
- Custom exceptions live in `app/Exceptions/` and map to a defined status code.
- Messages are in English and safe to show to clients.
- Unexpected errors are logged (in English) and returned as a generic 500 message.

## Related Documentation
- [JSON Responses](json-responses.md)
- [Validation Errors](validation-errors.md)
