<?php
require_once("././updater.php");

$healthcareWorkerID = $_POST["EMPLOYEE_ID"];
$bindings = [];
$bindings["BINDING_TYPES"] = "ssssssssissssi";
$bindings["VALUES"] = array(
                                $_POST["FIRST_NAME"],
                                $_POST["LAST_NAME"],
                                $_POST["DOB"],
                                $_POST["PHONE"],
                                $_POST["TELEPHONE"],
                                $_POST["ADDRESS"],
                                $_POST["CITY"],
                                $_POST["POSTAL_CODE"],
                                $_POST["PROVINCE"],
                                $_POST["SSN"],
                                $_POST["EMAIL"],
                                $_POST["CITIZENSHIP"],
                                $_POST["MEDICARE"],
                                $healthcareWorkerID
                        );

$result = updateData("patients/update/updatePatient.txt", $bindings);

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Updated!", "ID" => $healthcareWorkerID];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to upate Employee."];
}

// returnData is used in base.php
//
