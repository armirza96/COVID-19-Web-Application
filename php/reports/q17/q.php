<?php
require_once("php/getter.php");

$data = getData("php/reports/q17/sql.txt");

$columnNames = [ "CITY",
  "TOTAL_NUMBER_VACCINES_PER_CITY"];
