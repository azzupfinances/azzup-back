# Users

## Purpose
Account registration, login, and roles.

## Registration Fields
- Full name.
- CPF.
- Email address.
- Phone number.
- Password.
- Salary payment day ([Salary Cycles](salary-cycles.md)).

## Rules
- CPF must be valid according to Brazilian CPF validation rules.
- CPF must be unique across users.
- CPF is the primary login identifier.
- Email must be unique.
- Phone must be a Brazilian number with area code (DDD): 10 digits for landlines or 11 digits starting with 9 for mobiles. Only digits are stored.
- Password must contain at least 8 characters and be securely hashed.
- Every user must have a configured salary payment day.

## Profile
The authenticated user manages their own profile. Each block is saved independently.

| Block | Fields | Rules |
|---|---|---|
| Personal data | Full name, email, phone | Same rules as registration; email stays unique. |
| Salary | Gross salary, salary payment day | Gross salary is optional (not asked at registration), stored in [integer cents](transactions.md#money) and positive when set. |
| Photo | One image per user | JPG, PNG, or WebP up to 5 MB. Private: served only to its owner. Can be replaced or removed. |
| Password | Current password, new password | The current password is required. The new one follows the registration rule. Other sessions (tokens) are revoked; the current one stays. |

- CPF cannot be changed.
- Changing the email does not require confirmation yet: see [Pending Decisions](pending-decisions.md).

## Roles
| Role key | Meaning |
|---|---|
| `user` | Regular application user. |
| `admin` | Internal administrative user. |

Access rules per role are defined in [Data Ownership](data-ownership.md).

## Related Documentation
- [Authentication](../authentication/overview.md)
- [Permissions](../permissions/overview.md)
