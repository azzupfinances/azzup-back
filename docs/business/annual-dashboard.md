# Annual Dashboard

## Purpose
Financial performance across a selected calendar year.

## Monthly Results
For each month: total income, total expenses, net balance (same definitions as [Monthly Dashboard](monthly-dashboard.md)). The current month is marked `in_progress`.

## Annual Totals
- Total income, total expenses, net balance.
- A positive net balance may be described as money remaining or potentially saved, but is not treated as confirmed savings; no savings feature exists.

## Annual Category Expenses
Total annual expenses grouped by category.

## Highlights
- Best financial month.
- Worst financial month.
- Months containing additional income (e.g. profit sharing, 13th salary). Identification rules are unresolved: see [Pending Decisions](pending-decisions.md).

## API
- `GET /transactions/annual-summary?year=YYYY` returns, from transactions only, the income and expenses (positive cents) of all twelve months and the expenses per category with any spending, highest first.
- Card purchase installments are derived by clients ([Credit Cards](credit-cards.md)), so clients add them to these totals. Clients also decide which months are in progress or still to come.

