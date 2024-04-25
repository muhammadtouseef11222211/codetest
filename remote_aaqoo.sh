#!/usr/bin/expect

# Ask for the IP address
send_user "Enter IP address: "
expect_user -re "(.*)\n"
set ip_address $expect_out(1,string)

# Set the .pem file path and passphrase
set pem_file_path "aaqoo.pem"
set passphrase "GhB8qG3bEXBVhehk"

# Start the SSH command
spawn ssh -i $pem_file_path $ip_address

# Expect the passphrase prompt and send the passphrase
expect "Enter passphrase for key*"
send "$passphrase\r"

# Enable interactive mode for the SSH session
interact
