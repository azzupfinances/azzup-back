# Bruno

## Purpose
Manual HTTP request collections for the API.

## Rules
- The collection lives in `bruno/` in Bruno's YAML format (OpenCollection): `opencollection.yml`, one `.yml` per request, `folder.yml` per module folder.
- Folders are organized by module.
- Add requests when an endpoint is implemented.
- Use Bruno environments (`bruno/environments/`) for base URLs and tokens; never commit secrets. Scripts set tokens at runtime only.
- Request names in English.

## Related Documentation
- [Routes](../modules/routes.md)
