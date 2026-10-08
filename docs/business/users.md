# Users

## Purpose
Account registration, login, and roles.

## Registration Fields
- Full name.
- CPF.
- Email address.
- Password.
- Salary payment day ([Salary Cycles](salary-cycles.md)).

## Rules
- CPF must be valid according to Brazilian CPF validation rules.
- CPF must be unique across users.
- CPF is the primary login identifier.
- Email must be unique.
- Password must contain at least 8 characters and be securely hashed.
- Every user must have a configured salary payment day.

## Roles
| Role key | Meaning |
|---|---|
| `user` | Regular application user. |
| `admin` | Internal administrative user. |

Access rules per role are defined in [Data Ownership](data-ownership.md).

## Related Documentation
- [Authentication](../authentication/overview.md)
- [Permissions](../permissions/overview.md)
