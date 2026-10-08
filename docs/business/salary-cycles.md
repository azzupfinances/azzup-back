# Salary Cycles

## Purpose
The interval between a user's consecutive salary payment dates.

## Rules
- Each user configures a salary payment day ([Users](users.md)).
- The salary cycle runs from one salary payment date to the next.
- The salary cycle is distinct from the calendar month. Dashboard totals do not automatically use salary-cycle boundaries.
- Handling payment days that do not exist in shorter months is unresolved: see [Pending Decisions](pending-decisions.md).

## Derived Values
- Days remaining until the next salary payment.
- Percentage of the current salary cycle already elapsed.

## Related Documentation
- [Monthly Dashboard](monthly-dashboard.md)
