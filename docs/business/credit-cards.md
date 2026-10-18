# Credit Cards

## Purpose
The user's credit cards, the purchases made with them, and which monthly invoices were paid.

## Credit Card Fields
- Name (e.g. "Nubank").
- Bank ([bank keys](#banks)), used by clients for the logo and color.
- Limit ([integer cents](transactions.md#money)).
- Invoice due day (1–31).
- Owner ([Data Ownership](data-ownership.md)).

## Card Purchases
- Fields: credit card, description, category ([Transaction Categories](transaction-categories.md)), total amount (positive cents), installments count (1–24), purchase date.
- A purchase is not a [transaction](transactions.md): it is paid through the card invoice, in installments.
- Installments are derived, never stored:
  - The total is split into integer cents; the remainder adds 1 cent to the first installments (BRL 100.00 in 3 → 33.34 + 33.33 + 33.33).
  - Installment N falls on the purchase day, N − 1 months later; when that day does not exist in the month, the month's last day is used.
- The card's invoice for a month is the sum of the installments falling in that month.
- Removing a credit card removes its purchases and invoice payments.

## Invoice Payments
- The user marks a month's invoice (`YYYY-MM`) as paid, or unmarks it.
- Marking does not create a transaction (see BR-002 in [Pending Decisions](pending-decisions.md) for the equivalent bill rule).

## Derived Values
Calculated by clients from the stored records; not stored:
- Committed amount: installments from the current month on.
- Available limit: limit minus committed amount (negative when over the limit).

## Banks
`nubank`, `inter`, `itau`, `bradesco`, `santander`, `banco_do_brasil`, `caixa`, `c6_bank`, `btg_pactual`, `xp`, `mercado_pago`, `picpay`, `pagbank`, `neon`, `sicoob`, `sicredi`, `other`.

## API
- `GET /credit-cards` returns every card with its paid invoice months (`paid_invoice_months`); not paginated, a user has few cards.
- `GET /card-purchases` returns every purchase; clients derive installments from them. Not paginated.
- `PUT` / `DELETE /credit-cards/{id}/paid-invoices/{month}` mark and unmark an invoice; both are idempotent.

## Related Documentation
- [Transactions](transactions.md)
- [Bills](bills.md)
