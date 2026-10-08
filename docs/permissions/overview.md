# Permissions

## Purpose
Planned authorization and permission approach.

## Rules
- Authorization is enforced through Policies.
- The permission strategy (roles, permission storage, assignment) is not defined yet.
- Do not create roles, permissions, or departments until a feature requires them.
- Permission seeders, when needed, live in `database/seeders/Permissions/`.

## Conventions
- Permission keys use dot notation (e.g. `{module}.{action}`).

## Related Documentation
- [Policies](../modules/policies.md)
- [Authentication](../authentication/overview.md)
