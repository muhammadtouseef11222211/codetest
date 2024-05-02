<?php

date_default_timezone_set('Asia/Karachi');

// Redis connection parameters
$redisHost = '127.0.0.1';
$redisPort = 6379;

// Connect to Redis
$redis = new Redis();
$redis->connect($redisHost, $redisPort);

// Select database 14
$redis->select(14);

// Get current date
#$currentDate = date("Y-m-d");
$currentDate = date("Y-m-d", strtotime("-1 day"));

// Specify the pattern for keys
$keyPattern = $currentDate . "*"; // * represents any number

// Fetch keys matching the pattern
$keys = $redis->keys($keyPattern);

// Output the keys and data with parsing
#echo "Keys matching pattern '$keyPattern':\n";
foreach ($keys as $key) {
    // Parse the key into variables
    list($date, $number, $mask, $smsc) = explode('|', $key);

    // Output parsed key components
    #echo "Date: $date, Number: $number, Mask: $mask, SMSC: $smsc\n";

    // Fetch hash values for the current key
    $hashValues = $redis->hGetAll($key);

    // Output the hash values
    #echo "Hash values for key '$key':\n";
    foreach ($hashValues as $field => $value) {
        #echo "$field: $value\n";

        // MySQL connection parameters
        $mysqlHost = 'localhost';
        $mysqlUsername = 'root';
        $mysqlPassword = 'root123';
        $mysqlDatabase = 'db_CMS';

        // Connect to MySQL
        $mysqli = new mysqli($mysqlHost, $mysqlUsername, $mysqlPassword, $mysqlDatabase);

        // Check MySQL connection
        if ($mysqli->connect_error) {
            die("Connection to MySQL failed: " . $mysqli->connect_error);
        }

        // Prepare and execute SELECT query
        $query = "SELECT * FROM test WHERE username='$number' AND shortcode='$mask' AND smsc='$smsc'";
        $result = $mysqli->query($query);

        // Check if data is found
        if ($result->num_rows > 0) {
            // Output data if found
            #echo "MySQL data for key '$key':\n";
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $column => $val) {
                    #echo "$column: $val\n";
                }
            }
            #echo "\n";

            // Update data in MySQL
            foreach ($hashValues as $field => $value) {
                $updateQuery = "UPDATE test SET date='$date', shortcode='$mask', username='$number', smsc='$smsc', $field='$value' WHERE username='$number' AND shortcode='$mask' AND smsc='$smsc'";
                $updateResult = $mysqli->query($updateQuery);
                if (!$updateResult) {
                    #echo "Error updating MySQL data: " . $mysqli->error;
                }
            }
        } else {
            // Insert data into MySQL if no data found
            $insertQuery = "INSERT INTO test (date, shortcode, username, smsc, $field) VALUES ('$date', '$mask', '$number', '$smsc', '$value')";
            $insertResult = $mysqli->query($insertQuery);
            if (!$insertResult) {
                #echo "Error inserting MySQL data: " . $mysqli->error;
            } else {
                #echo "Inserted data into MySQL.\n";
            }
        }

        // Close MySQL connection
        $mysqli->close();
    }
    #echo "\n";
}

// Close Redis connection
$redis->close();

?>
