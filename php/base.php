<?php
$pageToHit = $_GET["PAGE"] ?? $_POST["PAGE"];

switch($pageToHit) {
  case "getPatients":
    require_once("patients/getPatient/getPatients.php");
  break;
  case "deletePatient":
    require_once("patients/deletePatient/deletePatient.php");
  break;
  case "addPatient":
    require_once("patients/addPatient/addPatient.php");
  break;
  default:
  break;
}

echo json_encode($data);
