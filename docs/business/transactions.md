# Transactions

## Purpose
Money entering or leaving a user's personal finances.

## Fields
- Description.
- Amount.
- Transaction date.
- Category ([Transaction Categories](transaction-categories.md)).
- Origin.
- Owner ([Data Ownership](data-ownership.md)).

## Money
- All monetary values in Azzup are stored as integer cents. Floating-point numbers must never be used for monetary calculations.
- Examples: BRL 150.00 → `15000`; BRL -45.90 → `-4590`.

## Type
Determined by the amount sign:
- Positive: income (e.g. salary, profit sharing, reimbursement, additional income).
- Negative: expense (e.g. groceries, transportation, rent, entertainment).
- Zero: unresolved; not assumed valid. See [Pending Decisions](pending-decisions.md).

## Origin
| Origin key | Meaning |
|---|---|
| `manual` | Created directly by the user. |
| `imported` | Created through a [statement import](statement-imports.md). |

## Operations
Users can create, list, update, and delete their own transactions. Ownership is always enforced.

## Statement View
- Transactions are displayed by calendar month.
- Within a month, grouped by day, with a daily total.
- Displayed in chronological order according to the selected presentation rules.
- Filters: type (income or expense), category, description text.

## Related Documentation
- [Filtering](../api/filtering.md)
- [Bills](bills.md)
