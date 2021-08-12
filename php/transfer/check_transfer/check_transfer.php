<?php
require_once("././getter.php");
require_once("././inserter.php");
require_once("././updater.php");

// VARIABLES
$vaccinesInInventory;
$vaccineID = $_POST["VACCINE_ID"];
$from_facilityID = $_POST["FROM_FACILITY_ID"];
$to_facilityID = $_POST["TO_FACILITY_ID"]
$totalVaccinesTransferred = $_POST["NOVT"];

// SET BINDINGS FOR GETTING INVENTORY
$bindings = [];
$bindings["BINDING_TYPES"] = "ii";
$bindings["VALUES"] = array(
                        $from_facilityID,
                        $vaccineID
                        );

// GET BOTH INVENTORIES
$fromInventory = getData("getInventory.txt", $bindings);
$toInventory = getData("getInventory.txt", $bindings);

// CHECK IF FROM INVENTORY HAS SUFFICIENT VACCINES
if($fromInventory["NOVA"] < $totalVaccinesTransferred || $fromInventory["NOVA"] == null){
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

        $result = insertData("./add/addTransfer", $bindings);

        // ADD OR UPDATE TO INVENTORY
        $bindings["BINDING_TYPES"] = "iii";
        if($toInventory["NOVA"] == null){
                $bindings["VALUES"] = array(
                        $vaccineID,
                        $to_facilityID,
                        $totalVaccinesTransferred
                        );
                $result = insertData("./add/addInventory");
        }else{
                $bindings["VALUES"] = array(
                        $toInventory["NOVA"] + $totalVaccinesTransferred,
                        $to_facilityID,
                        $vaccineID
                );
                $result = updateData("./update/updateInventory.txt", $bindings);
        }

        // UPDATE FROM INVENTORY
        $bindings["VALUES"] = {
                $fromInventory["NOVA"] - $totalVaccinesTransferred,
                $from_facilityID,
                $vaccineID
        };

        $result = updateData("./update/updateInventory.txt", $bindings);
}

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Added!"];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Insufficient amount of vaccines in inventory, unable to transfer."];
}

// returnData is used in base.php
// continues in delete.php
