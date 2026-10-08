# Module Creation

## Purpose
How to introduce a new module when a real feature requires it.

## Rules
- Create a module only for a concrete, requested feature.
- Create only the components the feature needs. Do not pre-generate CRUD.
- Before creating a file, check for an existing equivalent or reusable implementation.
- Register the module route file in `routes/api.php`.
- Update documentation only if a standard changes.

## Module Layout
```text
app/Http/Controllers/{Module}/
app/Http/Requests/{Module}/
app/Services/{Module}/
routes/{module}.php
```
Policies, Models, migrations, and tests are added only when needed.

## Related Documentation
- [New Module Checklist](../conventions/new-module-checklist.md)
- [Routes](../modules/routes.md)
- [Naming Conventions](../conventions/naming.md)
