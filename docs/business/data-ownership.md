# Data Ownership

## Purpose
User data isolation. This is the authoritative ownership rule for all financial resources.

## Rules
- Each regular user (`user` role) can only access, create, update, or delete their own financial data.
- Applies to transactions, bills, imported statements, dashboard information, financial reports, and any other user-owned financial resource.
- Ownership and authorization are always enforced by the backend.
- Client-provided identifiers are never sufficient to grant access to another user's data.

## Administrators
- Administrator (`admin` role) access to users' private financial data is not granted by default.
- Any admin capability must be explicitly defined as a requirement before implementation.

## Related Documentation
- [Users](users.md)
- [Policies](../modules/policies.md)
- [Permissions](../permissions/overview.md)
