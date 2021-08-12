<?php
require_once("././inserter.php");

$bindings = [];

$bindings["BINDING_TYPES"] = "isssssiss";
$bindings["VALUES"] = array(
                                $_POST["MANAGERS_EMPLOYEE_RECORD_ID"],
                                $_POST["NAME"],
                                $_POST["PHONE"],
                                $_POST["ADDRESS"],
                                $_POST["CITY"],
                                $_POST["POSTAL_CODE"],
                                $_POST["PROVINCE"],
                                $_POST["WEB_ADDRESS"],
                                $_POST["TYPE"]
                        );

$result = insertData("facility/add/addFacility.txt", $bindings);

$facilityID = $result["LAST_INSERTED_ID"];

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Added!", "ID" => $facilityID];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to add facility."];
}

// returnData is used in base.php
// continues in delete.php
