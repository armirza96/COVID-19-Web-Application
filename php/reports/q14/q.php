<?php
require_once("php/getter.php");

$data = getData("php/reports/q14/sql.txt");

$columnNames = [ "FIRST_NAME",
  "LAST_NAME",
  "DOB",
  "EMAIL",
  "PHONE",
  "DATE_GIVEN",
  "VACCINE_TYPE",
  "COUNT_OF_INFECTIONS"];
