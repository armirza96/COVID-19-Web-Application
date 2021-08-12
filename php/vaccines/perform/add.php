<?php
require_once("././inserter.php");
require_once("././updater.php");

$bindings = [];

$patientID = $_POST["PATIENT_ID"];
$vaccineID = $_POST["VACCINE_ID"];
$facilityID = $_POST["FACILITY_ID"];
$employeeRecordID = $_POST["EMPLOYEE_RECORD_ID"];
$dateGiven = $_POST["DATE_GIVEN"];

$bindings["BINDING_TYPES"] = "iiiis";
$bindings["VALUES"] = array(
                          $patientID,
                          $facilityID,
                          $vaccineID,
                          $employeeRecordID,
                          $dateGiven
                        );

$result = insertData("vaccines/perform/addVaccination.txt", $bindings);

$bindings["BINDING_TYPES"] = "ii";
$bindings["VALUES"] = array(
                        $facilityID,
                        $vaccineID
                        );

$result = updateData("vaccines/perform/decreaseInventory.txt", $bindings);


$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Performed!"];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to perform vaccination"];
}

// returnData is used in base.php
// continues in delete.php
