<?php

require "shared/header.php";
require "shared/navbar2.php";

require "shared/sidebar_begin.php";

require_once("php/getter.php");
$provinces = getData("php/province/getProvince/getProvinces.txt");
$ageGroups = getData("php/ageGroups/getAgeGroups.txt");
?>
<br />
<div style="display: flex; justify-content: space-between;">

    <h2 >
    Add Patient
    </h2>


</div>

<form>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="firstName">First Name</label>
      <input type="text" class="form-control" id="firstName" placeholder="First Name" name="FIRST_NAME">
    </div>
    <div class="form-group col-md-4">
      <label for="lastName">Last Name</label>
      <input type="text" class="form-control" id="lastName" placeholder="lastName" name="LAST_NAME">
    </div>
    <div class="form-group col-md-4">
      <label for="medicareNumber">Medicare</label>
      <input type="text" class="form-control" id="medicareNumber" placeholder="medicare #" name="MEDICARE">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="dob">Date of Birth</label>
      <input type="date" class="form-control" id="dob" placeholder="Date of birth" name="DOB">
    </div>
    <div class="form-group col-md-4">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="someone@email.com" name="EMAIL">
    </div>
    <div class="form-group col-md-4">
      <label for="Telephone">Telephone</label>
      <input type="telephone" class="form-control" id="Telephone" placeholder="123 123 1233" name="PHONE">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="ADDRESS">
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity" name="CITY">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Province</label>
      <select id="inputState" class="form-control" name="PROVINCE">

        <?php foreach($provinces as $pr): ?>
          <option value="<?=$pr["ID"]?>"><?=$pr["NAME"]?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Postal Code</label>
      <input type="text" class="form-control" id="inputZip" name="POSTAL_CODE">
    </div>
  </div>

  <h3>Age Group</h3>
    <div class="form-row">

      <div class="form-group col-md-4">
        <label for="ageGroup">What age group do they belong to?</label>
        <select id="ageGroup" class="form-control" name="AGE_GROUP">
          <?php foreach($ageGroups as $group): ?>
            <option value="<?=$group["ID"]?>"><?="{$group['lowerAgeBound']} - {$group['upperAgeBound']}"; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

    </div>

  <h3>Citizenship status</h3>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="IDNumber">ID Number</label>
        <input type="text" class="form-control" id="IDNumber" placeholder="SSN # or passport #" name="ID_NUMBER">
      </div>

      <div class="form-group col-md-4">
        <label for="inputCitizen">Is a Ctizen of Canada?</label>
        <select id="inputCitizen" class="form-control" name="IS_CITIZEN">
          <?php foreach(array("NO"=> 0, "YES"=> 1) as $key=>$value): ?>
            <option value="<?=$value ?>"><?=$key ?></option>
          <?php endforeach; ?>
        </select>
      </div>

    </div>


</form>
<button class="btn btn-primary float-right" onclick="addPatient();">Add</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Patient</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="loader"></div>
        <div class="alert alert-success " role="alert">

        </div>
        <div class="alert alert-danger " role="alert">

        </div>
      </div>
    </div>
  </div>
</div>

<br />

<?php
  require "shared/sidebar_end.php";

  $jsToAddAfter[] = '<script src="js/patientAdd.js"></script>';;

  require 'shared/footer.php';
?>
