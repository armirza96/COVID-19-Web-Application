<?php
require_once("././updater.php");

$id = $_POST["ID"];
$bindings = [];
$bindings["BINDING_TYPES"] = "ssi";
$bindings["VALUES"] = array(
                                $_POST["NAME"],
                                $_POST["CODE"],
                                $id
                        );

$result = updateData("provinces/update/update.txt", $bindings);

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Updated Province!", "ID" => $id];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to upate Province."];
}

// returnData is used in base.php
//
