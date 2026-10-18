# Feature Tests

## Purpose
Test endpoints end to end through HTTP.

## Rules
- Location: `tests/Feature/{Module}/`.
- One test class per endpoint (matching its Controller).
- Cover success, validation (422), authentication (401), and authorization (403) cases as applicable.
- Use Factories for data; reset the database between tests.
- Tests run on in-memory SQLite. `phpunit.xml` overrides the environment with `<server force="true">`
  because Docker passes `.env` as real environment variables, which Laravel reads from `$_SERVER`
  first; with plain `<env>`, `RefreshDatabase` wipes the development database.
- Test names and assertions in English.

## Conventions
- Class: `{Verb}{Subject}Test`. Methods: descriptive snake_case or camelCase, consistent per project.

## Related Documentation
- [Unit Tests](unit-tests.md)
- [JSON Responses](../api/json-responses.md)
