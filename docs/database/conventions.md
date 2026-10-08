# Database Conventions

## Purpose
Naming and structure rules for PostgreSQL schema.

## Rules
- Tables: plural snake_case. Columns: snake_case.
- Primary key: `id`. Foreign keys: `{singular_table}_id`.
- Pivot tables: singular table names in alphabetical order, snake_case.
- Include `created_at` and `updated_at` timestamps.
- Use Eloquent relationships rather than manual joins when appropriate.
- Use Factories and Seeders for test and development data.

## Related Documentation
- [Migrations](migrations.md)
- [Models](../modules/models.md)
- [Naming Conventions](../conventions/naming.md)
