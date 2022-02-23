#!/bin/bash

# Let script fail until database is available and moodle can be installed
set -e

if [ ! -f config.php ]; then
  cd /var/www/html

  # Install Moodle
  # Remark: wwwroot is later changed to dynamic root
  php admin/cli/install.php \
    --wwwroot="http://localhost:$MOODLE_DOCKER_WEB_PORT" \
    --dbtype="$MOODLE_DOCKER_DBTYPE" \
    --dbhost=moodledb \
    --dbname="$MOODLE_DOCKER_DBNAME" \
    --dbuser="$MOODLE_DOCKER_DBUSER" \
    --dbpass="$MOODLE_DOCKER_DBPASS" \
    --fullname="My Moodle" \
    --shortname="moodle" \
    --adminpass="$MOODLE_DOCKER_ADMINPASS" \
    --adminemail="admin@example.com" \
    --non-interactive \
    --agree-license \
    --allow-unstable

  chmod 644 config.php

  # Install plugins
  php admin/cli/init_moodle.php
fi

set +e

if [ "$ENABLE_XDEBUG" == "1" ]; then
  # Enable debugging
  pecl install xdebug
  docker-php-ext-enable xdebug
  sed -i 's/^; zend_extension=/zend_extension=/' /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
fi

# Start cron
service cron start

# Run Moodle
exec /usr/local/bin/apache2-foreground
