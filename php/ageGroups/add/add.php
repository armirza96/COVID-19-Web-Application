<?php
require_once("././inserter.php");

$bindings = [];

$bindings["BINDING_TYPES"] = "ii";
$bindings["VALUES"] = array(
                                $_POST["LOWER_AGE_BOUND"],
                                $_POST["UPPER_AGE_BOUND"]

                        );

$result = insertData("ageGroups/add/add.txt", $bindings);

$id = $result["LAST_INSERTED_ID"];


$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Age group Successfully Added!", "ID" => $id];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to add age group."];
}

// returnData is used in base.php
