<?php
require_once("././getter.php");

$id = $_GET["ID"];
$data = getData("healthcareWorker/get/getHealthcareWorkersEmploymentRecords.txt",["BINDING_TYPES" => "i", "VALUES"=>[$id]]);
