<?php
require_once("././inserter.php");

$bindings = [];

$vaccineID = $_POST["VACCINE_ID"];
$facilityID = $_POST["FACILITY_ID"];
$totalVaccinesReceived = $_POST["NOV"];

$bindings["BINDING_TYPES"] = "iisi";
$bindings["VALUES"] = array(
                          $vaccineID,
                          $facilityID,
                          $_POST["DOR"],
                          $totalVaccinesReceived
                        );

$result = insertData("shipments/add/addShipment.txt", $bindings);

$bindings["BINDING_TYPES"] = "iii";
$bindings["VALUES"] = array(
                        $vaccineID,
                        $facilityID,
                        $totalVaccinesReceived
                        );

$result = insertData("shipments/add/addInventory.txt", $bindings);


$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Added!"];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to add Shipment."];
}

// returnData is used in base.php
// continues in delete.php
