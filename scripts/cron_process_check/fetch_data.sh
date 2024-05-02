#!/bin/bash

# MySQL connection details
mysql_host="172.27.108.63"
mysql_user="backup"
mysql_password="backup123"
mysql_database="db_CMS"

# MySQL query
query="SELECT id FROM sms_cron WHERE status='Locked';"

# Execute MySQL query and capture the output
query_output=$(mysql -h "$mysql_host" -u "$mysql_user" -p"$mysql_password" -D "$mysql_database" -se "$query" --batch)

# Store the query output in a file
echo "$query_output" > result.txt

# Echo the query output
echo "Output of MySQL query:"
echo "$query_output"

