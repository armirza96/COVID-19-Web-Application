<?php
require_once("././getter.php");
require_once("././inserter.php");
require_once("././updater.php");

// VARIABLES
$vaccinesInInventory;
$vaccineID = $_POST["VACCINE_ID"];
$from_facilityID = $_POST["FROM_FACILITY_ID"];
$to_facilityID = $_POST["TO_FACILITY_ID"];
$totalVaccinesTransferred = $_POST["NOVT"];

// SET BINDINGS FOR FROM INVENTORY
$bindings = [];
$bindings["BINDING_TYPES"] = "ii";
$bindings["VALUES"] = array(
                        $from_facilityID,
                        $vaccineID
                        );
$fromInventory = getData("transfer/check_transfer/getInventory.txt", $bindings);

// SET BINDINGS FOR TO INVENTORY
$bindings["VALUES"] = array(
        $to_facilityID,
        $vaccineID
        );

$toInventory = getData("transfer/check_transfer/getInventory.txt", $bindings);

// CHECK IF FROM INVENTORY HAS SUFFICIENT VACCINES
if($fromInventory['NOVA'] < $totalVaccinesTransferred || $fromInventory['NOVA'] == null){
        $result["RESULT"] = 2;
}else{

        // ADD TRANSFER
        $bindings["BINDING_TYPES"] = "iiisi";
        $bindings["VALUES"] = array(
                $from_facilityID,
                $to_facilityID,
                $vaccineID,
                $_POST["DOT"],
                $totalVaccinesTransferred
              );

        $result = insertData("transfer/add/addTransfer.txt", $bindings);

        // ADD OR UPDATE TO INVENTORY
        $bindings["BINDING_TYPES"] = "iii";
        if($toInventory['NOVA'] == null){
                $bindings["VALUES"] = array(
                        $vaccineID,
                        $to_facilityID,
                        $totalVaccinesTransferred
                        );
                $result = insertData("transfer/add/addInventory.txt");
        }else{
                $vaccineTotal = $toInventory['NOVA'] + $totalVaccinesTransferred;
                $bindings["VALUES"] = array(
                        $vaccineTotal,
                        $to_facilityID,
                        $vaccineID
                );
                $result = updateData("transfer/update/updateInventory.txt", $bindings);
        }

        // UPDATE FROM INVENTORY
        $vaccineTotal = $fromInventory['NOVA'] - $totalVaccinesTransferred;
        $bindings["VALUES"] = array(
                $vaccineTotal,
                $from_facilityID,
                $vaccineID
                );

        $result = updateData("transfer/update/updateInventory.txt", $bindings);
}

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Added!"];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Insufficient amount of vaccines in inventory, unable to transfer."];
}

// returnData is used in base.php
// continues in delete.php
