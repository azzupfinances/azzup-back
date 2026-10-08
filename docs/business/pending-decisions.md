# Pending Decisions

## Purpose
Single source of unconfirmed business rules. Nothing here may be implemented as a confirmed requirement until its status changes to `confirmed`.

## Proposed Rules

### BR-001 — Imported Transaction Duplicate Detection
- **Status:** `pending_confirmation`
- **Proposal:** an imported transaction is a duplicate when transaction date, amount, and description match an existing transaction of the same user.
- **Open issue:** multiple legitimate transactions can share date, amount, and description.
- **Affects:** [Statement Imports](statement-imports.md)

### BR-002 — Automatic Expense Creation When Paying a Bill
- **Status:** `pending_confirmation`
- **Proposal:** marking a bill as paid creates an expense transaction with the negative bill amount, the bill category, the payment date, and a description identifying the bill.
- **Open issues:** link between bill and transaction to prevent duplicate expenses; origin of the generated transaction.
- **Affects:** [Bills](bills.md), [Transactions](transactions.md)

### BR-003 — Automatic Monthly Bill Generation
- **Status:** `pending_confirmation`
- **Proposal:** paying a `monthly` bill creates its next monthly occurrence.
- **Open issues:** due days 29–31 and shorter months; late payments; skipped months; amount changes; whether future occurrences appear before the current bill is paid.
- **Affects:** [Bills](bills.md)

## Open Questions
| Topic | Question | Affects |
|---|---|---|
| Salary payment day | How to handle days that do not exist in shorter months? | [Salary Cycles](salary-cycles.md) |
| Month-end bills | How to handle monthly bills due near month-end? | [Bills](bills.md) |
| Legitimate duplicates | How to keep identical but legitimate imported purchases? | [Statement Imports](statement-imports.md) |
| CSV formats | How to handle bank-specific CSV variations? | [Statement Imports](statement-imports.md) |
| Zero amounts | Are zero-value transactions valid? | [Transactions](transactions.md) |
| Subscription provider | Which payment provider/gateway? | [Subscriptions](subscriptions.md) |
| Subscription lifecycle | Cancellation, renewal, trial, and grace period policies? | [Subscriptions](subscriptions.md) |
| Subscription restrictions | Which features depend on subscription status? | [Subscriptions](subscriptions.md) |
| Extraordinary income | How to classify additional income (13th salary, profit sharing)? | [Annual Dashboard](annual-dashboard.md) |
| Percentage comparisons | How to compare against zero or negative baselines? | [Monthly Dashboard](monthly-dashboard.md) |
| Generated expense origin | Which origin do bill-generated expenses use, if BR-002 is approved? | [Transactions](transactions.md) |
| Future recurring bills | Should future unpaid occurrences appear before the current bill is paid? | [Bills](bills.md) |
| Timezone | Which timezone defines day, month, and due-date boundaries? | [Language — Dates and Times](../conventions/language.md#dates-and-times) |
