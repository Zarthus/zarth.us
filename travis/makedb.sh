#!/bin/bash

DATABASE_NAME=zarthus

mysql $DATABASE_NAME < database/logs.sql
mysql $DATABASE_NAME < database/projects.sql
mysql $DATABASE_NAME < database/visitor.sql
