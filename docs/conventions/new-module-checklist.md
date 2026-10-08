# New Module Checklist

## Purpose
Steps to verify when adding a module. Process details are in [Module Creation](../architecture/module-creation.md).

## Checklist
- [ ] A real, requested feature requires the module.
- [ ] No existing module or component already covers it.
- [ ] Route file `routes/{module}.php` created and included in `routes/api.php`.
- [ ] Invokable Controllers in `app/Http/Controllers/{Module}/`.
- [ ] Form Requests in `app/Http/Requests/{Module}/`.
- [ ] Services in `app/Services/{Module}/` with `execute()`.
- [ ] Policy added if authorization is required.
- [ ] Model, migration, and factory added only if new data is required.
- [ ] Feature tests in `tests/Feature/{Module}/`; unit tests for non-trivial logic.
- [ ] Bruno requests added in `bruno/`.
- [ ] All content in English.
- [ ] Documentation updated only if a standard changed.

## Related Documentation
- [Module Creation](../architecture/module-creation.md)
- [Naming Conventions](naming.md)
