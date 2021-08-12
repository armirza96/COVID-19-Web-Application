<?php
require_once("././inserter.php");

$id = $_POST["ID"];
$suspensionDate = $_POST["DATE_OF_SUSPENSION"];

$bindings = [];
$result =  null;

if(!empty($suspensionDate)) {
        $bindings["BINDING_TYPES"] = "iss";
        $bindings["VALUES"] = array(
                                        $id,
                                        $_POST["DATE_OF_APPROVAL"],
                                        $suspensionDate

                                );
        $result = insertData("vaccines/update/status/add/addStatus.txt", $bindings);
} else {
        $bindings["BINDING_TYPES"] = "is";
        $bindings["VALUES"] = array(
                                        $id,
                                        $_POST["DATE_OF_APPROVAL"]
                                );
        $result = insertData("vaccines/update/status/add/addStatusWithoutSuspensionDate.txt", $bindings);
}


$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Added status!", "ID" => $id];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to add status.", ];
}

// returnData is used in base.php
// continues in delete.php
