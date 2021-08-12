<?php
require_once("././updater.php");

$bindings = [];
$result =  null;

$id = $_POST["ID"];
$bindings["BINDING_TYPES"] = "si";
$bindings["VALUES"] = array(
                                $_POST["END_DATE"],
                              $id
                            );
$result = updateData("healthcareWorker/update/employmentRecords/update/update.txt", $bindings);

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully updated Record!", "ID" => $id];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to update Record." ];
}

// returnData is used in base.php
