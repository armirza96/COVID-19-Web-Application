<?php
function deleteData($path, $bindings) {
  require 'connection.php';

  $myfile = fopen($path, "r") or die("Unable to open file!");

  $sql = fread($myfile,filesize($path));

  fclose($myfile);

  // these lines are needed when we need to bind parameters to our sql
  // prevents sql injection
   $stmt = $conn->prepare($sql);
  //

  $stmt->bind_param($bindings["BINDING_TYPES"], ...$bindings["VALUES"]);

  $stmt->execute();

  $result = $stmt->get_result();

  $conn->close();

  if($result) {
    return true;
  } else {
    return false;
  }
}
