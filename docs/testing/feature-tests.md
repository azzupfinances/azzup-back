# Feature Tests

## Purpose
Test endpoints end to end through HTTP.

## Rules
- Location: `tests/Feature/{Module}/`.
- One test class per endpoint (matching its Controller).
- Cover success, validation (422), authentication (401), and authorization (403) cases as applicable.
- Use Factories for data; reset the database between tests.
- Test names and assertions in English.

## Conventions
- Class: `{Verb}{Subject}Test`. Methods: descriptive snake_case or camelCase, consistent per project.

## Related Documentation
- [Unit Tests](unit-tests.md)
- [JSON Responses](../api/json-responses.md)
