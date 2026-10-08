# Policies

## Purpose
Authorize actions on resources.

## Rules
- Authorization logic lives only in Policies, never in Services or Form Requests.
- Policies answer yes/no; they do not modify state.
- Denied authorization results in a 403 JSON response via the exception handler.
- Permission strategy is not defined yet; see the permissions overview.

## Conventions
- Location: `app/Policies/`.
- Name: `{Model}Policy`, methods in camelCase matching the action.

## Related Documentation
- [Permissions Overview](../permissions/overview.md)
- [Controllers](controllers.md)
