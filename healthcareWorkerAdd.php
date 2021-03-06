<?php

require "shared/header.php";
require "shared/navbar2.php";

require "shared/sidebar_begin.php";

require_once("php/getter.php");
$provinces = getData("php/provinces/get/get.txt");

?>
<br />
<div style="display: flex; justify-content: space-between;">

    <h2 >
    Add Employee
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
    <div class="form-group col-md-4">
      <label for="ssn">SSN</label>
      <input type="text" class="form-control" id="ssn" placeholder="123-123-123" name ="SSN">
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

    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="IDNumber">ID Number</label>
        <input type="text" class="form-control" id="IDNumber" placeholder="citizen # or passport #" name="ID_NUMBER">
      </div>
    </div>


</form>
<button class="btn btn-primary float-right" onclick="add();">Add</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adding Employee</h5>
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

  $jsToAddAfter[] = '<script src="js/healthcareWorker/add.js"></script>';;

  require 'shared/footer.php';
?>
