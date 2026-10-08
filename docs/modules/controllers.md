# Controllers

## Purpose
Coordinate an HTTP request: authorization, Service execution, and response.

## Rules
- One Controller per action, using `__invoke()`.
- Keep Controllers thin. No business logic.
- Receive a Form Request for validated input.
- Authorize via Policies before calling the Service.
- Inject Services through dependency injection.
- Return responses following the JSON response standard.

## Conventions
- Location: `app/Http/Controllers/{Module}/`.
- Name: `{Verb}{Subject}Controller` (PascalCase).

## Related Documentation
- [Form Requests](form-requests.md)
- [Services](services.md)
- [Policies](policies.md)
- [JSON Responses](../api/json-responses.md)
