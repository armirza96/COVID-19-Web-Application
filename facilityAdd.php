<?php

require "shared/header.php";
require "shared/navbar2.php";

require "shared/sidebar_begin.php";

require_once("php/getter.php");
$provinces = getData("php/provinces/get/get.txt");
$managers = getData("php\healthcareWorker\get\getHealthcareWorkers.txt");

?>
<br />
<div style="display: flex; justify-content: space-between;">

  <h2 >
  Add Facility
  </h2>
</div>

<form>
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" placeholder="Facility Name" name="NAME">
    </div>
    <div class="form-group col-md-6">
      <label for="inputState">Manager</label>
        <select id="inputState" class="form-control" name="EMPLOYEE_ID">
          <?php foreach($managers as $r): ?>
            <option value="<?=$r["ID"]?>"><?=$r["FIRST_NAME"]?></option>
          <?php endforeach; ?>
        </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="type">Type</label>
      <select id="inputState" class="form-control" name="TYPE">
          <option value="Clinic">Clinic</option>
          <option value="Hospital">Hospital</option>
          <option value="Special installment">Special installment</option>
        </select>
    </div>
    <div class="form-group col-md-4">
      <label for="webAddress">Web Address</label>
      <input type="text" class="form-control" id="webAddress" placeholder="place.com" name="WEB_ADDRESS">
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
</form>
<button class="btn btn-primary float-right" onclick="add();">Add Facility</button>

<hr />
<br />

<div class="modal" tabindex="-1" role="dialog" id="processModal" tabindex="1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Adding Facility</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="loader"></div>
        <div class="alert alert-success" role="alert">

        </div>
        <div class="alert alert-danger" role="alert">

        </div>
      </div>
    </div>
  </div>
</div>

<?php
  require "shared/sidebar_end.php";

  $jsToAddAfter[] = '<script src="js/facility/add.js"></script>';;

  require 'shared/footer.php';
?>
