# CLAUDE.md — Documentation Router

**Azzup** — personal finance API for Brazilian CLT employees, built on a modular Laravel architecture.
Laravel is installed in `src/` and runs in Docker (see `docs/infrastructure/docker.md`); run PHP, Artisan, and Composer through the `app` container. No business functionality is implemented.

`docs/` is the authoritative source for architectural standards; `docs/business/` for business requirements. This file only routes to them.

## Task-Based Documentation Index

| When the task involves... | Read first |
|---|---|
| Controllers | `docs/modules/controllers.md` |
| Form Requests | `docs/modules/form-requests.md` |
| Services | `docs/modules/services.md` |
| Policies | `docs/modules/policies.md` |
| Models | `docs/modules/models.md` |
| Routes | `docs/modules/routes.md` |
| New module creation | `docs/architecture/module-creation.md` |
| Directory structure | `docs/architecture/directory-structure.md` |
| Request lifecycle | `docs/architecture/request-lifecycle.md` |
| JSON responses | `docs/api/json-responses.md` |
| Exception handling | `docs/api/exception-handling.md` |
| Validation errors | `docs/api/validation-errors.md` |
| Filtering | `docs/api/filtering.md` |
| Sorting | `docs/api/sorting.md` |
| Pagination | `docs/api/pagination.md` |
| Authentication | `docs/authentication/overview.md` |
| Authorization and permissions | `docs/permissions/overview.md` |
| Migrations | `docs/database/migrations.md` |
| Soft deletes | `docs/database/soft-deletes.md` |
| Database conventions | `docs/database/conventions.md` |
| Docker | `docs/infrastructure/docker.md` |
| Nginx | `docs/infrastructure/nginx.md` |
| Jobs and queues | `docs/infrastructure/queues.md` |
| Scheduler | `docs/infrastructure/scheduler.md` |
| Monitoring | `docs/infrastructure/monitoring.md` |
| External integrations | `docs/integrations/overview.md` |
| Feature tests | `docs/testing/feature-tests.md` |
| Unit tests | `docs/testing/unit-tests.md` |
| Bruno API collections | `docs/testing/bruno.md` |
| Naming conventions | `docs/conventions/naming.md` |
| Code style | `docs/conventions/code-style.md` |
| Language standards | `docs/conventions/language.md` |
| Module creation checklist | `docs/conventions/new-module-checklist.md` |

## Business Documentation Index

| When the task involves... | Read first |
|---|---|
| Product scope and goals | `docs/business/product-overview.md` |
| Users and registration | `docs/business/users.md` |
| Subscription plans | `docs/business/subscriptions.md` |
| Financial transactions | `docs/business/transactions.md` |
| Transaction categories | `docs/business/transaction-categories.md` |
| Bank statement imports | `docs/business/statement-imports.md` |
| Bills and payments | `docs/business/bills.md` |
| Salary cycles | `docs/business/salary-cycles.md` |
| Monthly dashboard | `docs/business/monthly-dashboard.md` |
| Annual dashboard | `docs/business/annual-dashboard.md` |
| User data isolation | `docs/business/data-ownership.md` |
| Business terminology | `docs/business/business-glossary.md` |
| Unresolved business rules | `docs/business/pending-decisions.md` |

For business features: read the business document first, then the relevant architectural document.
Never implement anything listed in `docs/business/pending-decisions.md` as confirmed.

## Mandatory Instructions

1. Identify the task category before making changes.
2. Read the primary documentation file for that task.
3. Read related documentation only when necessary. Do not follow every link.
4. Inspect existing implementations before creating new components.
5. Follow the modular architecture.
6. Avoid duplicating code.
7. Avoid duplicating documentation; each rule has one authoritative document.
8. Never invent business requirements or treat pending decisions as approved.
9. Never implement features beyond the requested scope.
10. Avoid unnecessary dependencies.
11. Modify only files relevant to the current task, except for essential dependencies.
12. Update documentation when an architectural standard changes.
13. Keep `CLAUDE.md` concise.
14. Never load the entire documentation directory by default.
15. Enforce the English-only standard across all project files, including commits and PRs.

## Workflow

```text
Receive task → Identify business feature and responsibility → Check these indexes
→ Read business doc, then architectural doc
→ Inspect relevant existing files → Read additional docs if needed
→ Implement requested changes → Validate → Update docs if a standard changed
```
