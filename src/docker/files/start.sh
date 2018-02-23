#!/bin/bash

# publish assets & run migrations
/srv/www/yii migrate/up --interactive=0

# start php-fpm
exec php-fpm
