# Documentation

Authoritative source for architectural standards. Business requirements live in [business/](business/README.md). Each standard has exactly one owning document.
Read only the documents needed for the current task; use [CLAUDE.md](../CLAUDE.md) as the router.

## Sections

- **business/** — [Azzup business requirements index](business/README.md)
- **architecture/** — [overview](architecture/overview.md), [directory structure](architecture/directory-structure.md), [request lifecycle](architecture/request-lifecycle.md), [module creation](architecture/module-creation.md)
- **modules/** — [controllers](modules/controllers.md), [form requests](modules/form-requests.md), [services](modules/services.md), [policies](modules/policies.md), [models](modules/models.md), [routes](modules/routes.md)
- **api/** — [JSON responses](api/json-responses.md), [exception handling](api/exception-handling.md), [validation errors](api/validation-errors.md), [filtering](api/filtering.md), [sorting](api/sorting.md), [pagination](api/pagination.md)
- **authentication/** — [overview](authentication/overview.md)
- **permissions/** — [overview](permissions/overview.md)
- **database/** — [migrations](database/migrations.md), [soft deletes](database/soft-deletes.md), [conventions](database/conventions.md)
- **infrastructure/** — [docker](infrastructure/docker.md), [nginx](infrastructure/nginx.md), [queues](infrastructure/queues.md), [scheduler](infrastructure/scheduler.md), [monitoring](infrastructure/monitoring.md)
- **integrations/** — [overview](integrations/overview.md)
- **testing/** — [feature tests](testing/feature-tests.md), [unit tests](testing/unit-tests.md), [bruno](testing/bruno.md)
- **conventions/** — [naming](conventions/naming.md), [code style](conventions/code-style.md), [language](conventions/language.md), [new module checklist](conventions/new-module-checklist.md)
