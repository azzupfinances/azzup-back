# Transactions

## Purpose
Money entering or leaving a user's personal finances.

## Fields
- Description.
- Amount.
- Transaction date.
- Category ([Transaction Categories](transaction-categories.md)).
- Origin.
- Payment method (expenses only).
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

## Payment Method
Expenses record how they were paid; income has no payment method.

| Payment method key | Meaning |
|---|---|
| `pix` | Pix transfer. |
| `debit_card` | Debit card. |
| `cash` | Cash. |
| `boleto` | Brazilian bank slip (boleto). |

Credit card purchases are not transactions: they belong to a credit card and are paid in installments.

## Operations
- Users can create, list, update, and delete their own transactions. Ownership is always enforced.
- Transactions created by the user have origin `manual`; the origin never changes on update.
- Zero amounts are rejected while that decision is pending.

## Statement View
- Transactions are displayed by calendar month.
- Within a month, grouped by day, with a daily total.
- Displayed in chronological order according to the selected presentation rules.
- Filters: type (income or expense), category, description text.
- The API returns the whole month at once (`GET /transactions?month=YYYY-MM`), newest first; the month totals, daily grouping, and filters are applied by the client over that list.

## Related Documentation
- [Filtering](../api/filtering.md)
- [Bills](bills.md)
