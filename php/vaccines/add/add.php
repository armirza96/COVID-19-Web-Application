<?php
require_once("././inserter.php");

$bindings = [];

$bindings["BINDING_TYPES"] = "ssi";
$bindings["VALUES"] = array(
                                $_POST["NAME"],
                                $_POST["TYPE"],
                                $_POST["DOSES"]
                        );

$result = insertData("vaccines/add/add.txt", $bindings);

$id = $result["LAST_INSERTED_ID"];

$bindings["BINDING_TYPES"] = "i";
$bindings["VALUES"] = array(    $id
                        );

$result = insertData("vaccines/add/addVaccineStatus.txt", $bindings);

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Vaccine Successfully Added!", "ID" => $id];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to add vaccine."];
}

// returnData is used in base.php
