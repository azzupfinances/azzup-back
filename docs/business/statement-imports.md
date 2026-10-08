# Statement Imports

## Purpose
Importing transactions from bank statement files.

## Supported Formats
- OFX.
- CSV.

## Workflow
1. User uploads a bank statement.
2. The system parses its contents.
3. Transactions are normalized.
4. The system prepares a preview.
5. Categories are suggested.
6. The user reviews the transactions.
7. The user may change suggested categories.
8. The user confirms the import.
9. The system persists the approved transactions with origin `imported`.

## Rules
- No transaction is persisted before user confirmation.
- Each preview transaction contains the information needed to validate its financial impact (date, description, amount, suggested category).
- Categories are suggested from transaction descriptions (e.g. food delivery → `food`, ride-hailing → `transportation`). These are illustrative, not a finalized rule list.
- Users can override any suggested category before confirming.
- The import should prevent accidental duplicates. The matching strategy is not confirmed: see BR-001 in [Pending Decisions](pending-decisions.md).

## Related Documentation
- [Transactions](transactions.md)
- [Transaction Categories](transaction-categories.md)
