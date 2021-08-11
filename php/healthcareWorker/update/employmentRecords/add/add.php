<?php
require_once("././inserter.php");

$healthcareWorkerID = $_POST["EMPLOYEE_ID"];
$endDate = $_POST["END_DATE"];

$bindings = [];
$result =  null;

if(!empty($endDate)) {
        $bindings["BINDING_TYPES"] = "iissi";
        $bindings["VALUES"] = array(
                                        $healthcareWorkerID,
                                        $_POST["FACILITY_ID"],
                                        $_POST["START_DATE"],
                                        $cureDate,
                                        $_POST["VACCINES_RECEIVED"]

                                );
        $result = insertData("healthcareWorker/update/employmentRecords/add/addEmploymentRecords.txt", $bindings);
} else {
        $bindings["BINDING_TYPES"] = "iisi";
        $bindings["VALUES"] = array(
                                        $healthcareWorkerID,
                                        $_POST["FACILITY_ID"],
                                        $_POST["START_DATE"],
                                        $_POST["VACCINES_RECEIVED"]
                                );
        $result = insertData("patients/update/employmentRecords/add/addEmploymentRecordsWithoutEndDate.txt", $bindings);
}


$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Added Employment Record!", "ID" => $healthcareWorkerID];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to add Employment Record.", ];
}

// returnData is used in base.php
// continues in delete.php
