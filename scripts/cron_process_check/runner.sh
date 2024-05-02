#!/bin/bash

# Run bash script
bash_script="fetch_data.sh"
./$bash_script

# Run PHP script
php_script="check_process.php"
php $php_script
