# Monthly Dashboard

## Purpose
Summary of the authenticated user's finances for a selected calendar month.

## Rules
- Uses only the authenticated user's records ([Data Ownership](data-ownership.md)).
- Period is the calendar month unless stated otherwise.

## Metrics
| Metric | Definition |
|---|---|
| Monthly income | Sum of positive transactions in the month. |
| Monthly expenses | Sum of absolute values of negative transactions in the month. |
| Monthly balance | Monthly income − monthly expenses. |
| Previous month comparison | Percentage difference between this month's and last month's balance, when mathematically meaningful. Zero/negative baselines are unresolved. |
| Salary cycle | Days until next salary payment and percentage of cycle elapsed ([Salary Cycles](salary-cycles.md)). |
| Category expenses | Total expenses per category, sorted highest to lowest. |
| Recent transactions | The user's most recent transactions. |
| Upcoming bills | Pending and overdue bills ([Bills](bills.md)). |

## Data Sources
No dedicated endpoint: clients build the month from the monthly statement (`GET /transactions?month=`), card purchases, bills, and the salary payment day. Card installments falling in the month count as expenses, as in the statement. The previous month comparison is shown only when last month's balance is positive.

## Related Documentation
- [Transactions](transactions.md)
- [Pending Decisions](pending-decisions.md)
