<?php
require_once("././deleter.php");

$result = deleteData("patients/getPatient/getPatients.txt");

require 'php/connection.php';

$data = [];

if($result) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Deleted!"];
} else {
        $data = ["RESULT" => "2", "MESSAGE" => "Unable to delete patient"];
}

// returnData is used in base.php
// continues in delete.php
