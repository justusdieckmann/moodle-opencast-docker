# moodle-opencast-docker
This repository contains a docker setup for the development of the Moodle-Opencast plugins.
**Don't use this for production!**

## Quickstart
Start all containers with:
```
# Start containers
docker compose -f docker-compose.opencast.yml -f docker-compose.moodle.yml up -d 

# Stop containers
docker compose -f docker-compose.opencast.yml -f docker-compose.moodle.yml stop

# Destroy containers and remove all data
docker compose -f docker-compose.opencast.yml -f docker-compose.moodle.yml down --volumes
```
Moodle is accessible on `http://localhost` and Opencast on `http://localhost:8080`.
The login credentials are `admin/password` for Moodle and `admin/opencast` for Opencast.
The Moodle-Opencast plugins are already configured to connect to the local Opencast instance. 
You can directly create new courses, add a block instance and upload videos. The cron job is setup so that it doesn't need be executed manually.

## Moodle
- By default, the latest Moodle 3.11 version is started. 
If you want to change the Moodle version, you can change the argument `MOODLE_VERSION` in the file `moodle/Dockerfile`.
You can specify either a branch or a version tag.
- By default, Xdebug is enabled in the Moodle container. The Xdebug configuration is configured for PhpStorm/IntelliJ and Windows/Mac. If you are using different tools or Linux, you need to adapt `moodle/docker-php-ext-xdebug.ini`.

## Opencast
- By default, JDWP is activated so that you can debug Opencast after setting up the Java Debugger in your IDE. 