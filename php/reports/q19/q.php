<?php
require_once("php/getter.php");

$data = getData("php/reports/q19/sql.txt");

$columnNames =
[ "ID",
	  "SSN",
	  "FIRST_NAME",
	  "LAST_NAME",
	  "DOB",
	  "MEDICARE_NUMBER",
	  "PHONE",
    "ADDRESS",
    "CITY",
	  "NAME",
	  "POSTAL_CODE",
	  "CITIZEN",
	  "EMAIL",
		"EMP_RECORD"];
