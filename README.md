
## Install docker

## To run the docker container

Go to the directory where the project is: 

$ docker run -p "80:80" -v ${PWD}:/app mattrayner/lamp:latest-1604-php7

To see the app in the browser: go to http://localhost


## To go to phpMyAdmin

http://localhost/phpmyadmin/

## The user and password for phpmyadmin will be provided in the output of the terminal

look for a section like this one:

========================================================================
You can now connect to this MySQL Server with 

    mysql -uadmin -pXXXXXXXXXX -h<host> -P<port>

Please remember to change the above password as soon as possible!
MySQL user 'root' has no password but only allows local connections

enjoy!
========================================================================

## Update the db_connection.php file with the new password provided (docker container)

## Database set-up
import the inventory.sql file using phpmyadmin


###############################################################################

## To get the containers that are running. You will need this to get the id of the container

$ docker ps

## To open a shell in that container 

$ docker exec -it 51e21d88eeb9 /bin/bash

## To see the apache logs

$ tail -f /var/log/apache2/error.log

NOTE: to write stuff to this log use the `error_log` php function

## To connect to mysql as root inside of the container

$ mysql -u root

