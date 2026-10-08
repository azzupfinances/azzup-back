# Business Glossary

## Purpose
Stable terminology used across Azzup.

| Term | Definition |
|---|---|
| Azzup | The product: a personal finance application for Brazilian CLT employees. |
| CLT | Brazilian formal employment regime (Consolidation of Labor Laws). Legal identifier kept as-is. |
| CPF | Brazilian individual taxpayer registry number. Primary login identifier. |
| BRL | Brazilian real, the currency used by Azzup. |
| Cents | Integer representation of monetary values (BRL 1.00 = `100`). |
| 13th salary | Mandatory additional annual salary payment under CLT. |
| Profit sharing | Employer profit distribution paid to employees. |
| Transaction | A money movement in a user's finances. Positive = income, negative = expense. |
| Income | A transaction with a positive amount. |
| Expense | A transaction with a negative amount. |
| Category | One of the fixed transaction categories. |
| Origin | How a transaction was created: `manual` or `imported`. |
| Statement import | Creating transactions from an OFX or CSV bank statement after preview and confirmation. |
| Preview | Unpersisted list of parsed transactions shown before import confirmation. |
| Bill | A financial obligation with a due date. |
| Recurrence type | Whether a bill is `monthly` or `one_time`. |
| Bill status | `pending`, `overdue`, or `paid`. |
| Salary payment day | Day of the month on which the user receives their salary. |
| Salary cycle | Interval between consecutive salary payment dates. |
| Monthly balance | Monthly income minus monthly expenses. |
| Net balance | Income minus expenses over a period. |
| `in_progress` | Marker for the current, incomplete month in the annual dashboard. |

## Related Documentation
- [Transactions](transactions.md)
- [Bills](bills.md)
- [Salary Cycles](salary-cycles.md)
