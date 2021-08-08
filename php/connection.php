<?php
$servername = 'nkc353.encs.concordia.ca';
$username = 'a_rz';
$password = '$';
$dbServerHost = "login.encs.concordia.ca";
$dbName = "nkc353_1";
// Create connection
//$conn = new mysqli($servername, $username, $password,'nkc353_1','3306');

shell_exec("ssh -fNg -L 3306:$dbServerHost:3306 $servername");
$conn = new mysqli($dbServerHost, $username, $password, $dbName, 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "connected";
?>
