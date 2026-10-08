# Scheduler

## Purpose
Planned scheduled task execution.

## Rules
- Schedules are defined in `routes/console.php`.
- Scheduled work calls Artisan commands (`app/Console/Commands/`) or Jobs.
- Prevent overlapping runs for long tasks.
- Executed by the `scheduler` service.

## Related Documentation
- [Queues](queues.md)
- [Docker](docker.md)
