<?php
require_once("././updater.php");

$facilityID = $_POST["FACILITY_ID"];
$bindings = [];
$bindings["BINDING_TYPES"] = "issssssissi";
$bindings["VALUES"] = array(
                                $_POST["MANAGER_EMPLOYEE_RECORD_ID"],
                                $_POST["NAME"],
                                $_POST["PHONE"],
                                $_POST["ADDRESS"],
                                $_POST["PHONE"],
                                $_POST["CITY"],
                                $_POST["POSTAL_CODE"],
                                $_POST["PROVINCE"],
                                $_POST["WEB_ADDRESS"],
                                $_POST["TYPE"],
                                $facilityID
                        );

$result = updateData("facility/update/updateFacility.txt", $bindings);

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Updated!", "ID" => $facilityID];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to upate Facility."];
}

// returnData is used in base.php
//
