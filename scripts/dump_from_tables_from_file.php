<?php

// MySQL database credentials
$host = 'localhost';
$username = 'root';
$password = 'root123';
$database = 'db_KIOT';

$currentDate = date('Y-m-d');

// File containing table names
$tablesFile = 'important_tables.txt';

// Directory to store the dump files
$outputDir = '/var/backup/important_tables_backup/';

// Open the file containing table names
if (($handle = fopen($tablesFile, 'r')) !== false) {
    // Initialize an empty array to store table names
    $tables = array();
    
    // Read the file line by line
    while (($tableName = fgets($handle)) !== false) {
        // Remove any trailing newline characters
        $tableName = trim($tableName);
        
        // Add the table name to the array
        $tables[] = $tableName;
    }
    
    // Close the file handle
    fclose($handle);
    
    // Construct the dump file name
    $dumpFile = $outputDir . 'tables_dump.sql.gz';

    // Construct the mysqldump command
    $command = "mysqldump -u $username -p$password $database " . implode(' ', $tables) . " | gzip >  $dumpFile";

    // Execute the command
    exec($command, $output, $returnValue);

    // Check if the command executed successfully
    if ($returnValue === 0) {
        echo "Tables dumped successfully.";
    } else {
        echo "Error dumping tables: " . implode("\n", $output);
    }
} else {
    echo "Error opening file $tablesFile.\n";
}
?>
