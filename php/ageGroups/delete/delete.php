<?php
require_once("././deleter.php");

$bindings["BINDING_TYPES"] = "i";
$bindings["VALUES"] = array(
                                $_POST["ID"]
                        );
$result = deleteData("ageGroups/delete/delete.txt", $bindings);

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Deleted Age Group!"];
} else {
        $data = ["RESULT" => "2", "MESSAGE" => "Unable to delete Age Group."];
}

// returnData is used in base.php
