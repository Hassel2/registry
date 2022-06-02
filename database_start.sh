#!/bin/bash 
docker start -i tasksDB
# docker run --name tasksDB -p "5432:5432" -e POSTGRES_USER=admin -e POSTGRES_PASSWORD=1234 -e POSTGRES_DB=tasker -d postgres
