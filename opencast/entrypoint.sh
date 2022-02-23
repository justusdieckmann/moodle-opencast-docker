#!/bin/bash

# turn on bash's job control
set -m

# Start the primary process and put it in the background
/docker-entrypoint.sh app:start &

# Sleep 30 seconds because Opencast takes some time to start
sleep 30

# Create the user
while true; do
  httpcode=$(curl -sSLf -o /dev/null -w "%{http_code}" -X POST "http://localhost:8080/admin-ng/users" \
    --digest -u "opencast_system_account:CHANGE_ME" \
    -H "X-Requested-Auth: Digest" \
    -F "username=moodle" \
    -F "password=moodle" \
    -F "name=moodle" \
    -F "email=moodle@example.com" \
    -F 'roles=[{"name": "ROLE_GROUP_MH_DEFAULT_ORG_EXTERNAL_APPLICATIONS", type:"GROUP"}, {"name": "ROLE_GROUP_MH_DEFAULT_ORG_SYSTEM_ADMINS", type:"GROUP"}]')

  if [ $httpcode == 201 ] || [ $httpcode == 409 ]; then
    echo "User 'moodle' created"
    break
  fi
  echo "User 'moodle' could not be created; trying again"
  sleep 5
done

# Bring primary process back to foreground
fg %1
