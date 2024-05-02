<?php

// MySQL database connection parameters
$host = '172.27.103.25';
$username = 'root';
$password = 'root123';
$database = 'kannel';
$table = 'credits';

// Create a directory based on the current date
$currentDate = date('Y-m-d');
$directoryPath = '/var/backup/AAQOO_Backup/SMPP_SERVER_BACKUPS/SINCH_172.27.103.25/DB_Backups' . '/' . $currentDate;

if (!is_dir($directoryPath)) {
    mkdir($directoryPath, 0777, true);
}

// Get the current hour
$currentHour = date('H');

// Generate MySQL dump for the current hour and store it in the current date folder
$dumpFileName = 'credits_103_25_'.$currentHour .'H'. '.sql';
$dumpFilePath = $directoryPath . '/' . $dumpFileName;

// Construct the mysqldump command
$command = "mysqldump -h{$host} -u{$username} -p{$password} {$database} {$table}  > {$dumpFilePath}";

// Execute the mysqldump command
exec($command);

echo "Dump created for hour {$currentHour}\n";

echo "MySQL dump for the current hour has been created successfully.\n";
// MySQL database connection parameters
$host = '172.27.108.37';
$username = 'backup';
$password = 'backup123';
$database = 'kannel';
$table = 'credits';

// Create a directory based on the current date
$currentDate = date('Y-m-d');
$directoryPath = '/var/backup/AAQOO_Backup/SMPP_SERVER_BACKUPS/SINCH_172.27.108.37/DB_backups' . '/' . $currentDate;

if (!is_dir($directoryPath)) {
    mkdir($directoryPath, 0777, true);
}

// Get the current hour
$currentHour = date('H');

// Generate MySQL dump for the current hour and store it in the current date folder
$dumpFileName = 'credits_108_37_'.$currentHour .'H'. '.sql';
$dumpFilePath = $directoryPath . '/' . $dumpFileName;

// Construct the mysqldump command
$command = "mysqldump -h{$host} -u{$username} -p{$password} {$database} {$table} > {$dumpFilePath}";

// Execute the mysqldump command
exec($command);

echo "Dump created for hour {$currentHour}\n";

echo "MySQL dump for the current hour has been created successfully.\n";
