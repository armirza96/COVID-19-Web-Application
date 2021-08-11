<?php
require_once("././updater.php");

$id = $_POST["ID"];
$bindings = [];
$bindings["BINDING_TYPES"] = "iii";
$bindings["VALUES"] = array(
                                $_POST["LOWER_AGE_BOUND"],
                                $_POST["UPPER_AGE_BOUND"],
                                $id
                        );

$result = updateData("ageGroups/update/update.txt", $bindings);

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Updated Age Group!", "ID" => $id];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to upate Age Group."];
}

// returnData is used in base.php
//
