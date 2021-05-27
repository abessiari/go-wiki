#!/bin/bash

if [[ ! "$(service mysql status)" =~ "start/running" ]]
then
    echo " The MySQL service on the server has been stopped. It has now been restarted." 
    service mysql start
else
    echo " The MySQL service on the server has been restarted." 
fi

mysql -u root -w -e "use wiki;" > /dev/null 2>&1

if [[ $? -ne 0 ]]
then
   echo "Loading the sql dump at /DATA/sqldump.sql"
   mysql -u root -e "CREATE DATABASE wiki"
   mysql -u root -D wiki < /DATA/sqldump.sql
else
   echo "Database wiki already loaded"
fi

if [[ ! "$(service apache2 status)" =~ "start/running" ]]
then
    echo " The Apache service on the server has been stopped. It has now been restarted." 
    service apache2 restart
else
    echo " The Apache service on the server has been restarted." 
fi

exec "$@"
