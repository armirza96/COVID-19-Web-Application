<?php
require_once("././updater.php");

$id = $_POST["ID"];
$bindings = [];
$bindings["BINDING_TYPES"] = "ssi";
$bindings["VALUES"] = array(
                                $_POST["NAME"],
                                $_POST["TYPE"],
                                $id
                        );

$result = updateData("variants/update/update.txt", $bindings);

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Updated variant!", "ID" => $id];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to upate variant."];
}

// returnData is used in base.php
//
