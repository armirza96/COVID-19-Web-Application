<?php
require_once("php/getter.php");

$data = getData("php/reports/q15/sql.txt");

$columnNames = [ "PROVINCE_NAME",
  "TOTAL_NUMBER_VACCINES_AVAILABLE"];
