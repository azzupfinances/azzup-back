# Bills

## Purpose
Fixed monthly obligations (e.g. rent, electricity, internet, gym membership).

## Fields
- Name.
- Amount ([integer cents](transactions.md#money)).
- Category ([Transaction Categories](transaction-categories.md)).
- Due day (1–31). In months without that day, the bill is due on the month's last day.
- Paid months (`YYYY-MM`).
- Owner ([Data Ownership](data-ownership.md)).

## Recurrence
Every bill repeats monthly: it is due in every month, with the same amount, until the user removes it. No occurrences are generated or stored; a month's bill is the bill itself plus whether that month is paid. One-time bills are not supported.

## Status
Derived per month, never stored:

| Key | Meaning |
|---|---|
| `paid` | The month is in the bill's paid months. |
| `overdue` | Not paid and the month's due date has passed. |
| `pending` | Not paid and the due date has not passed. |

## Paying a Bill
- The user marks a month as paid, or unmarks it.
- Automatic creation of an expense transaction is not confirmed: see BR-002.

## Listing
- The bills screen shows the current month: fixed bills plus each credit card's invoice for the month ([Credit Cards](credit-cards.md)).
- Order: overdue first, then pending, then paid; by due day within each group.

## API
- `GET /bills` returns every bill with its `paid_months`; not paginated, a user has few bills. Clients derive the month's status.
- `PUT` / `DELETE /bills/{id}/paid-months/{month}` mark and unmark a month; both are idempotent.

## Related Documentation
- [Transactions](transactions.md)
- [Receivables](receivables.md)
- [Pending Decisions](pending-decisions.md)
