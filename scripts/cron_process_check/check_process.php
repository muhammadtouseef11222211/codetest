<?php

$mysql_host = "172.27.108.63";
$mysql_user = "backup";
$mysql_password = "backup123";
$mysql_database = "db_CMS";

// Open the file for reading
$file = fopen("result.txt", "r");

// Check if the file opened successfully
if ($file) {
    // Read each line from the file
    while (($id = fgets($file)) !== false) {
        // Remove any trailing newline characters
        $id = trim($id);

        // Output the id
        echo "ID: $id\n";

##### code block #################

        if ($id == "10") {
            executeCommandsForId10();
        }
        if ($id == "28") {
            executeCommandsForId28();
        }
        if ($id == "113") {
            executeCommandsForId113();
        }
	if ($id == "1") {
            executeCommandsForId1();
        }

##### code block #################

    }

    // Close the file
    fclose($file);
} else {
    // Print an error message if the file cannot be opened
    echo "Error opening the file.";
}



// Function to execute commands for ID 10
################## Verified Function ########################

function executeCommandsForId10() {
    global $mysql_host, $mysql_database, $mysql_user, $mysql_password;

#    $remote_ip = "172.27.108.50";
#     $command = "ps aux | grep -i \"cdr_billing_cron\" | grep -vc \"grep -i cdr_billing_cron\"";
#    $ssh_command = "ssh $remote_ip \"$command\" 2>&1";
#    $output = shell_exec($ssh_command);
#    $output = intval(trim($output));  // Convert output to integer
#    echo "Output from command on $remote_ip for ID 10: $output\n";

// Define the remote IP address
$remote_ip = "172.27.108.34";

// Define the command to be executed
$command = "ps aux | grep -i 'cdr_billing_cron' | grep -vc 'grep -i cdr_billing_cron'";

// Construct the SSH command
$ssh_command = "ssh $remote_ip \"$command\" 2>&1";

// Execute the SSH command and get the output
$output = shell_exec($ssh_command);

// Remove any trailing newline characters
$output = trim($output);

// Output the result
echo "cdr_billing_cron process on $remote_ip: ==== $output\n";


    if ($output == 10) {
        try {
            // Create a new PDO instance
            $pdo = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);

            // Set PDO to throw exceptions on errors
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare and execute the SQL statement
            $pdo->exec("UPDATE sms_cron SET status='Unlocked' WHERE id=10");

            // Output success message
            echo "Query executed successfully for ID 10.\n";
        } catch (PDOException $e) {
            // If an error occurs, output the error message
            echo "Error: " . $e->getMessage();
        }
    }
}


// Function to execute commands for ID 28
################## Verified function #################
function executeCommandsForId28() {
    global $mysql_host, $mysql_database, $mysql_user, $mysql_password;

$remote_ip = "172.27.108.50";
$command = "ps aux | grep -i 'schedule_camp' | grep -vc 'grep -i schedule_camp'";
$ssh_command = "ssh $remote_ip \"$command\" 2>&1";
$output = shell_exec($ssh_command);
$output = trim($output);

echo "schedule_camp.php process  on $remote_ip: === $output\n";
if ($output == 10) {
        try {
            // Create a new PDO instance
            $pdo = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);

            // Set PDO to throw exceptions on errors
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Prepare and execute the SQL statement
            $pdo->exec("UPDATE sms_cron SET status='Unlocked' WHERE id=28");

            // Output success message
            echo "Query executed successfully for ID 28.\n";

   } catch (PDOException $e) {
            // If an error occurs, output the error message
            echo "Error: " . $e->getMessage();
        }
    }
}



###### Function for cron id 113 ##################### verified function

function executeCommandsForId113() {
    global $mysql_host, $mysql_database, $mysql_user, $mysql_password;

$remote_ip = "172.27.108.41";
$command = "ps aux | grep -i 'cdr_billing_cron_new' | grep -vc 'grep -i cdr_billing_cron_new'";
$ssh_command = "ssh $remote_ip \"$command\" 2>&1";
$output = shell_exec($ssh_command);
$output = trim($output);

echo "cdr_billing_cron_new process  on $remote_ip: ===  $output\n";
if ($output == 10) {
        try {
            // Create a new PDO instance
            $pdo = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);

            // Set PDO to throw exceptions on errors
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Prepare and execute the SQL statement
            $pdo->exec("UPDATE sms_cron SET status='Unlocked' WHERE id=113");

            // Output success message
            echo "Query executed successfully for ID 113.\n";

   } catch (PDOException $e) {
            // If an error occurs, output the error message
            echo "Error: " . $e->getMessage();
        }
    }
}


function executeCommandsForId1() {
    global $mysql_host, $mysql_database, $mysql_user, $mysql_password;

$remote_ip = "172.27.108.50";
$command = "ps aux | grep -i 'sendsms' | grep -vc 'grep -i sendsms'";
$ssh_command = "ssh $remote_ip \"$command\" 2>&1";
$output = shell_exec($ssh_command);
$output = trim($output);

echo "sendsms.php  on $remote_ip: ===  $output\n";
if ($output == 10) {
        try {
            // Create a new PDO instance
            $pdo = new PDO("mysql:host=$mysql_host;dbname=$mysql_database", $mysql_user, $mysql_password);

            // Set PDO to throw exceptions on errors
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Prepare and execute the SQL statement
            $pdo->exec("UPDATE sms_cron SET status='Unlocked' WHERE id=1");

            // Output success message
            echo "Query executed successfully for ID 1.\n";

   } catch (PDOException $e) {
            // If an error occurs, output the error message
            echo "Error: " . $e->getMessage();
        }
    }
}




?>
