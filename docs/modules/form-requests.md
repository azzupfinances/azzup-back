# Form Requests

## Purpose
Validate incoming request data before it reaches the Controller.

## Rules
- Define validation in `rules()`.
- Use `attributes()` and `messages()` only when defaults are insufficient.
- All messages and attribute names in English.
- Reuse existing rules and custom rule classes (`app/Rules/`) before writing new ones.
- Authorization belongs in Policies; `authorize()` returns `true` unless a documented reason exists.

## Conventions
- Location: `app/Http/Requests/{Module}/`.
- Name: `{Verb}{Subject}Request` (PascalCase), matching its Controller.

## Related Documentation
- [Validation Errors](../api/validation-errors.md)
- [Policies](policies.md)
- [Language](../conventions/language.md)
