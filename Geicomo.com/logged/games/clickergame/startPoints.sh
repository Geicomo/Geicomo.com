#!/bin/bash

# Generate a random number between 0 and 59
DELAY=$((RANDOM % 18000))

echo "Updating points in: ${DELAY}" >> /var/www/html/logged/games/clickergame/backups/startScript.log

# Wait for the random delay
sleep ${DELAY}

# Now call your PHP script
/usr/bin/php /var/www/html/logged/games/clickergame/updatePoints.php
