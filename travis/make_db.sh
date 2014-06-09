#!/bin/bash

DATABASE_NAME=zarth.us

SQL_FILES=`cat ../database/*`

mysql -e 'CREATE DATABASE IF NOT EXISTS `$DATABASE_NAME`;'
mysql -e "$SQL_FILES" -D "$DATABASE_NAME"
