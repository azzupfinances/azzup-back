# External Integrations

## Purpose
Standard for connecting to external services. No integrations exist yet.

## Rules
- Each integration is encapsulated in its own Service or client class.
- Credentials come from environment variables via `config/` files, never hard-coded.
- Calls that can be slow or fail run in queued Jobs when possible.
- Handle timeouts and failures explicitly; log in English without sensitive data.
- Use a Contract (`app/Contracts/`) only if multiple implementations are needed.

## Related Documentation
- [Services](../modules/services.md)
- [Queues](../infrastructure/queues.md)
