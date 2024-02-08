#!/bin/bash

# Update Apache to match number of CPU's
procs=$(cat /proc/cpuinfo | grep processor | wc -l)
sed -i "s/StartServers          2/StartServers          $procs/" /etc/apache2/apache2.conf

# Always chown webroot for better mounting
chown -Rf www-data:www-data /usr/share/apache2/

# Start Apache
/usr/sbin/apache2ctl -D FOREGROUND
