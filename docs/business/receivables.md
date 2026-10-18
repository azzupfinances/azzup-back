# Receivables

## Purpose
Money someone owes the user, paid back in monthly installments (e.g. a loan to a friend, a sale paid in installments).

## Fields
- Description.
- Payer name.
- Total amount ([integer cents](transactions.md#money)).
- Installments count (1–24).
- First installment date.
- Received months (`YYYY-MM`).
- Owner ([Data Ownership](data-ownership.md)).

## Installments
Derived, never stored, with the same rules as [card purchase installments](credit-cards.md#card-purchases): integer split with the remainder on the first installments; installment N falls on the first installment's day, N − 1 months later.

## Status
Per month, for the installment falling in it: `paid` (received), `overdue` (not received and its date has passed), or `pending`.

## Receiving
- The user marks a month's installment as received, or unmarks it.
- Marking does not create an income transaction.

## API
- `GET /receivables` returns every receivable with its `received_months`; not paginated.
- `PUT` / `DELETE /receivables/{id}/received-months/{month}` mark and unmark a month; both are idempotent.

## Related Documentation
- [Bills](bills.md)
