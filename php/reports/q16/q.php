<?php
require_once("php/getter.php");

$data = getData("php/reports/q16/sql.txt");

$columnNames = [ "PROVINCE_NAME",
"VACCINE_NAME",
  "TOTAL_NUMBER_VACCINATIONS_GIVEN"];
