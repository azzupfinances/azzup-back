#!/usr/bin/env sh
# Container startup steps. See docs/infrastructure/docker.md
set -e

# Only the app service installs dependencies; queue and scheduler wait for it to be healthy.
if [ "${CONTAINER_ROLE:-app}" = "app" ] && [ -f composer.json ] && [ ! -f vendor/autoload.php ]; then
    composer install --no-interaction --prefer-dist
fi

exec "$@"
