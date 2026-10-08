# Migrations

## Purpose
How schema changes are made.

## Rules
- All schema changes go through migrations. Never edit the database manually.
- One concern per migration.
- Never modify a migration that has been shared; create a new one.
- Define foreign keys and indexes explicitly.
- Every migration must be reversible (`down()`), unless documented otherwise.

## Conventions
- Use Laravel's default timestamped file names with descriptive snake_case names.

## Related Documentation
- [Database Conventions](conventions.md)
- [Soft Deletes](soft-deletes.md)
