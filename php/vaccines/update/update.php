<?php
require_once("././updater.php");

$id = $_POST["ID"];
$bindings = [];
$bindings["BINDING_TYPES"] = "ssii";
$bindings["VALUES"] = array(
                                $_POST["NAME"],
                                $_POST["TYPE"],
                                $_POST["DOSES"],
                                $id
                        );

$result = updateData("vaccines/update/update.txt", $bindings);

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Updated Vaccine!", "ID" => $id];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to upate Vaccine."];
}

// returnData is used in base.php
//
