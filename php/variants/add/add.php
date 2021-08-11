<?php
require_once("././inserter.php");

$bindings = [];

$bindings["BINDING_TYPES"] = "ss";
$bindings["VALUES"] = array(
                                $_POST["NAME"],
                                $_POST["TYPE"],
                        );

$result = insertData("variants/add/add.txt", $bindings);

$variantID = $result["LAST_INSERTED_ID"];


$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Variant Successfully Added!", "ID" => $variantID];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to add variant."];
}

// returnData is used in base.php
// continues in delete.php
