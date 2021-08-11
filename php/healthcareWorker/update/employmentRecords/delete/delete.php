<?php
require_once("././deleter.php");

$bindings = [];
$result =  null;

$bindings["BINDING_TYPES"] = "i";
$bindings["VALUES"] = array(
                              $_POST["EMPLOYMENTRECORD_ID"]


                            );
$result = deleteData("patients/update/employmentRecords/delete/delete.txt", $bindings);


$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully deleted Employment Records!"];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to delete Employment Records." ];
}

// returnData is used in base.php
// continues in delete.php
