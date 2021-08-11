<?php
require_once("././inserter.php");

$bindings = [];

$bindings["BINDING_TYPES"] = "ssssssssisss";
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
                                $_POST["EMAIL"]
                                $_POST["MEDICARE"]
                        );

$result = insertData("healthcareWorker/add/addHealthcareWorker.txt", $bindings);

$healthcareWorkerID = $result["LAST_INSERTED_ID"];

$bindings["BINDING_TYPES"] = "iis";
$bindings["VALUES"] = array(    $healthcareWorkerID,
                                $_POST["IS_CITIZEN"],
                                $_POST["ID_NUMBER"],
                        );
$result = insertData("healthcareWorker/add/addCitizenshipStatus.txt", $bindings);


$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Added!", "ID" => $healthcareWorkerID];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to add Patient."];
}

// returnData is used in base.php
// continues in delete.php
