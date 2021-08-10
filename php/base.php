<?php
$pageToHit = $_GET["PAGE"];

switch($pageToHit) {
  case "getPatients":
    require_once("patients/getPatient/getPatients.php");
  break;
  case "deletePatient":
    require_once("patients/deletePatient/deletePatient.php");
  break;
  default:
  break;
}

echo json_encode($data);
