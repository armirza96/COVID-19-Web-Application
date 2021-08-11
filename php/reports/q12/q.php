<?php
require_once("php/getter.php");

$data = getData("php/reports/q12/sql.txt");

$columnNames = [ "FIRST_NAME",
  "LAST_NAME",
  "DOB",
  "EMAIL",
  "PHONE",
  "DATE_GIVEN",
  "VACCINE_TYPE",
  "PREVIOUSLY_INFECTED"];
