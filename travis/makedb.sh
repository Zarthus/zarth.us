#!/bin/bash

DATABASE_NAME=zarthus

mysql -e 'CREATE DATABASE IF NOT EXISTS `$DATABASE_NAME`;'
mysql -D "$DATABASE_NAME" < database/logs.sql
mysql -D "$DATABASE_NAME" < database/projects.sql
mysql -D "$DATABASE_NAME" < database/visitor.sql
