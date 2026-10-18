# Subscriptions

## Purpose
Azzup paid subscription plans.

## Plans
| Plan | Price |
|---|---|
| Monthly | BRL 14.99/month for the first three months; BRL 29.99/month from the fourth month. |
| Annual | BRL 269.90, billed once per year. |

## Payment Methods
| Plan | Accepted methods | Renewal |
|---|---|---|
| Monthly | Credit card only. | Charged automatically every month. |
| Annual | Credit card or Pix. | Card: charged automatically every year. Pix: one-time payment; the user pays again to renew. |

- No other payment methods (boleto, debit card, recurring Pix) are accepted.
- Payment provider: Stripe (Billing for card subscriptions, one-time Checkout payment for annual Pix).
  Pix on Brazilian Stripe accounts is invite-only; until it is enabled, the annual plan accepts card only.
- Annual Pix renewal handling is unresolved: see [Pending Decisions](pending-decisions.md).

## Rules
- Prices are defined in BRL and stored as integer cents ([Transactions — Money](transactions.md#money)).
- Subscription billing is separate from personal financial transactions unless a future requirement connects them.
- Not defined: card renewal failures, trial, cancellation, grace period, and feature restrictions. See [Pending Decisions](pending-decisions.md).
