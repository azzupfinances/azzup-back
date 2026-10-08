# Validation Errors

## Purpose
Format of validation failure responses.

## Rules
- Validation failures return HTTP 422.
- Body contains `message` and an `errors` object keyed by field, each with a list of messages.
- All messages and attribute names in English.
- Rely on Laravel's default validation exception rendering; do not hand-build these responses.

## Conventions
```json
{ "message": "The given data was invalid.", "errors": { "field_name": ["Error message."] } }
```

## Related Documentation
- [Form Requests](../modules/form-requests.md)
- [JSON Responses](json-responses.md)
