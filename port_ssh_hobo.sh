#!/usr/bin/expect

# Ask for the IP address
send_user "Enter IP address: "
expect_user -re "(.*)\n"
set ip_address $expect_out(1,string)

# Ask for the SSH port
send_user "Enter SSH port (default is 22): "
expect_user -re "(.*)\n"
set ssh_port $expect_out(1,string)
if {$ssh_port eq ""} {
    set ssh_port 22
}

# Set the .pem file path and passphrase
set pem_file_path "hobo.pem"
set passphrase "HoBoEtEcH!@3"

# Start the SSH command
spawn ssh -i $pem_file_path -oPort=$ssh_port -C $ip_address

# Expect the passphrase prompt and send the passphrase
expect "Enter passphrase for key*"
send "$passphrase\r"

# Enable interactive mode for the SSH session
interact
