<?php
require_once("././inserter.php");
require_once("././updater.php");
$bindings = [];

$bindings["BINDING_TYPES"] = "sssssiss";
$bindings["VALUES"] = array(

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

$bindings["BINDING_TYPES"] = "ii";
$bindings["VALUES"] = array(
                                $_POST["EMPLOYEE_ID"],
                                $facilityID
                        );

$result = insertData("facility/add/addEmploymentRecord.txt", $bindings);

$employeeRecordID = $result["LAST_INSERTED_ID"];

$bindings["BINDING_TYPES"] = "ii";
$bindings["VALUES"] = array(
                                $employeeRecordID,
                                $facilityID
                        );

$result = insertData("facility/add/updateFacility.txt", $bindings);

$employeeRecordID = $result["LAST_INSERTED_ID"];

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Added!", "ID" => $facilityID];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to add facility."];
}

// returnData is used in base.php
// continues in delete.php
