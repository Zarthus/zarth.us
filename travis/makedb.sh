#!/bin/bash

DATABASE_NAME=zarthus

mysql -e 'CREATE DATABASE IF NOT EXISTS `$DATABASE_NAME`;'
mysql $DATABASE_NAME < database/logs.sql
mysql $DATABASE_NAME < database/projects.sql
mysql $DATABASE_NAME < database/visitor.sql
