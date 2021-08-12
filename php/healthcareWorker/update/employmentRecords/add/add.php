<?php
require_once("././inserter.php");

$healthcareWorkerID = $_POST["ID"];

$bindings = [];
$result =  null;


$bindings["BINDING_TYPES"] = "iis";
$bindings["VALUES"] = array(
                        $healthcareWorkerID,
                        $_POST["FACILITY_ID"],
                        $_POST["START_DATE"],

                );
$result = insertData("healthcareWorker/update/employmentRecords/add/addEmploymentRecords.txt", $bindings);


$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Added Employment Record!", "ID" => $healthcareWorkerID];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to add Employment Record.", ];
}

// returnData is used in base.php
// continues in delete.php
