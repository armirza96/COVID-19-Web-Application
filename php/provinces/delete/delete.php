<?php
require_once("././deleter.php");

$bindings["BINDING_TYPES"] = "i";
$bindings["VALUES"] = array(
                                $_POST["ID"]
                        );
$result = deleteData("provinces/delete/delete.txt", $bindings);

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Deleted province!"];
} else {
        $data = ["RESULT" => "2", "MESSAGE" => "Unable to delete province."];
}

// returnData is used in base.php
