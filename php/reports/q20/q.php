<?php
require_once("php/getter.php");

$data = getData("php/reports/q20/sql.txt");

$columnNames =
[ "ID",
	  "FIRST_NAME",
	  "LAST_NAME",
	  "DOB",
	  "PHONE",
    "CITY",
	  "EMAIL",
		"LOCATION_NAME"];
