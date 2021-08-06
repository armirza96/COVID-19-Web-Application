<?php
require 'connection.php';

$sql = $_GET["SQL"];
$path = "/patients/$sql.txt";

$myfile = fopen($path, "r") or die("Unable to open file!");

$sql = fread($myfile,filesize($path));

fclose($myfile);

// these lines are needed when we need to bind parameters to our sql
// prevents sql injection
// $stmt = $conn->prepare($sql);
//
// $stmt->bind_param("s", $var);

$stmt->execute();

$result = $stmt->get_result();

$data = [];

while($row = $result->fetch_assoc()) {
  $data[] = $row;
}

$conn->close();

echo json_encode($patients);
