<?php
$pageToHit = $_GET["PAGE"] ?? $_POST["PAGE"];

$data = [];

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
  case "variants/get":
    require_once("variants/get/get.php");
  break;
  case "variants/update":
    require_once("variants/update/update.php");
  break;
  case "variants/add":
    require_once("variants/add/add.php");
  break;
  case "variants/delete":
    require_once("variants/delete/delete.php");
  break;
  default:
    $data = ["RESULT" => "2", "MESSAGE" => "Command not added to base.php"];
  break;
}

echo json_encode($data);
