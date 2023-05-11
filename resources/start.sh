#!/usr/bin/bash

# Prerequisites:
# - mapping directory with SQL file and start.sh on /home
# - mapping website root on /php
# Mapping: -v host_path:CT_path (suffix with :O for overlay)

echo "Starting"
#cp -r /php/* /var/www/html/
service mariadb start
mysql < /home/database.sql
mysqladmin -u root password toto123
apache2ctl -DFOREGROUND