<?php
require_once("././updater.php");

$bindings = [];
$result =  null;

$id = $_POST["ID"];
$bindings["BINDING_TYPES"] = "si";
$bindings["VALUES"] = array(
                                $_POST["DATE_OF_SUSPENSION"],
                              $id
                            );
$result = updateData("vaccines/update/status/update/update.txt", $bindings);

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully updated status!", "ID" => $id];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to update status." ];
}

// returnData is used in base.php
// continues in delete.php
