# Request Lifecycle

## Purpose
Order in which an API request is processed.

## Flow
```text
Nginx → PHP-FPM → Middleware (auth, etc.) → Route
  → Form Request (validation) → Controller
  → Policy (authorization) → Service::execute()
  → Model / database → Controller builds JSON response
Exceptions at any step → centralized exception handler → JSON error
```

## Rules
- Validation failures stop the request before the Controller runs.
- Authorization happens before business logic is executed.
- Services never build HTTP responses.
- All responses, including errors, are JSON.

## Related Documentation
- [Controllers](../modules/controllers.md)
- [JSON Responses](../api/json-responses.md)
- [Exception Handling](../api/exception-handling.md)
