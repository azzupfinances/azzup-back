# Models

## Purpose
Represent database tables through Eloquent.

## Rules
- Follow Eloquent conventions (table and key naming).
- Declare `$fillable` explicitly.
- Define casts in the `casts()` method.
- Define relationships as typed methods when needed.
- Use `SoftDeletes` only when relevant.
- Keep business logic in Services, not Models.

## Conventions
- Location: `app/Models/`.
- Name: singular PascalCase.
- Each Model has a Factory when tests require it.

## Related Documentation
- [Database Conventions](../database/conventions.md)
- [Soft Deletes](../database/soft-deletes.md)
