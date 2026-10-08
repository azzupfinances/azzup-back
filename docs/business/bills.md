# Bills

## Purpose
Financial obligations with due dates (e.g. rent, electricity, internet, gym membership).

## Fields
- Name.
- Amount ([integer cents](transactions.md#money)).
- Category ([Transaction Categories](transaction-categories.md)).
- Due date.
- Recurrence type.
- Payment status.
- Owner ([Data Ownership](data-ownership.md)).

## Recurrence Types
| Key | Meaning |
|---|---|
| `monthly` | Recurring monthly obligation. Next-occurrence generation is not confirmed: see BR-003. |
| `one_time` | Does not generate further occurrences after payment. |

## Status
| Key | Meaning |
|---|---|
| `pending` | Unpaid and not past the due date. |
| `overdue` | Unpaid and past the due date. |
| `paid` | Marked as paid by the user. |

- `pending` and `overdue` are derived from due date and payment state. The system must not rely solely on a stored status value that can become outdated.

## Paying a Bill
- The user marks a bill as paid.
- Automatic creation of an expense transaction is not confirmed: see BR-002. If approved, the bill–transaction link must prevent duplicate expenses.

## Listing
- Users can view upcoming and overdue bills.
- Order: overdue bills first, then pending bills by due date.
- Paid bills remain identifiable for financial history.

## Related Documentation
- [Transactions](transactions.md)
- [Pending Decisions](pending-decisions.md)
