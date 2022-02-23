FROM moodlehq/moodle-php-apache:7.4
ARG MOODLE_VERSION

# Setup cron
RUN apt-get update && apt-get -y install cron
COPY cron /etc/cron.d/cron
RUN chmod 0644 /etc/cron.d/cron
RUN crontab /etc/cron.d/cron
RUN mkdir -p /var/log/cron

# Clone Moodle repository
RUN git clone https://github.com/moodle/moodle.git                               /var/www/html
RUN git clone https://github.com/Opencast-Moodle/moodle-local_chunkupload.git    /var/www/html/local/chunkupload
RUN git --git-dir=/var/www/html/.git                     checkout "$MOODLE_VERSION"
RUN git --git-dir=/var/www/html/local/chunkupload/.git   checkout master

COPY init_moodle.php /var/www/html/admin/cli/init_moodle.php

# Overwrite entrypoint
COPY ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]