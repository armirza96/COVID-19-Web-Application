<?php
require_once("././inserter.php");

$bindings = [];

$bindings["BINDING_TYPES"] = "ssi";
$bindings["VALUES"] = array(
                                $_POST["NAME"],
                                $_POST["CODE"],
                                $_POST["AGE_GROUP"]
                        );

$result = insertData("provinces/add/add.txt", $bindings);

$id = $result["LAST_INSERTED_ID"];

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Province Successfully Added!", "ID" => $id];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to add provinces."];
}

// returnData is used in base.php
