<?php
$pageToHit = $_GET["PAGE"] ?? $_POST["PAGE"];

switch($pageToHit) {
  case "getPatients":
    require_once("patients/get/getPatients.php");
  break;
  case "deletePatient":
    require_once("patients/delete/delete.php");
  break;
  case "addPatient":
    require_once("patients/add/add.php");
  break;
  case "updatePatient":
    require_once("patients/update/update.php");
  break;
  case "addInfection":
    require_once("patients/update/infection/add/add.php");
  break;
  case "deleteInfection":
    require_once("patients/update/infection/delete/delete.php");
  break;
  default:
  break;
}

echo json_encode($data);
