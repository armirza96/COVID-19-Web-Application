<?php

require "shared/header.php";
require "shared/navbar2.php";

require "shared/sidebar_begin.php";


//get patient info
$patientID = $_GET["PATIENT_ID"] ?? -1;

?>
<br />
<div style="display: flex; justify-content: space-between;">
  <?php if($patientID > 0) : ?>
    <h2 >
    Edit Patient
    </h2>
    <a href="patient.php?PATIENT_ID=-1" class="btn btn-sm btn-danger" style="height: fit-content;">Delete Patient</a>
  <?php else : ?>
    <h2 >
    Add Patient
    </h2>
  <?php endif; ?>

</div>

<form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="firstName">First Name</label>
      <input type="text" class="form-control" id="firstName" placeholder="First Name">
    </div>
    <div class="form-group col-md-6">
      <label for="lastName">Last Name</label>
      <input type="text" class="form-control" id="lastName" placeholder="lastName">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="dob">Date of Birth</label>
      <input type="date" class="form-control" id="dob" placeholder="Date of birth">
    </div>
    <div class="form-group col-md-4">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="someone@email.com">
    </div>
    <div class="form-group col-md-4">
      <label for="Telephone">Telephone</label>
      <input type="telephone" class="form-control" id="Telephone" placeholder="123 123 1233">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Province</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Postal Code</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>

<h3>Citizenship status</h3>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="IDNumber">ID Number</label>
      <input type="text" class="form-control" id="IDNumber" placeholder="SSN # or passport #">
    </div>

    <div class="form-group col-md-4">
      <label for="inputState">Is a Ctizen of Canada?</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>Yes</option>
        <option>No</option>
      </select>
    </div>

  </div>

  <button type="submit" class="btn btn-primary float-right">Save</button>
</form>
<br />
<br />


<h3>Patient Infections</h3>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Variant</th>
      <th scope="col">Infection Date</th>
      <th scope="col">Cure Date</th>
      <th scope="col">&nbsp</th>
    </tr>
  </thead>
  <tbody id="tableBody">

  </tbody>
</table>




<?php
  require "shared/sidebar_end.php";

  $jsToAddAfter[] = '<script>

                  //doAjaxCall({}, addPatientsToUI);
                  ajaxDone([{"VARIANT": "DELTA", "DATEOFINFECTION": "2021-03-04", "DATEOFCURE": "2021-03-18", "ID": 1}], {callback: "addInfectionsToUI", parentEl: "#tableBody"});

                  function addInfectionsToUI(parentEl, data) {
                    parentEl.append(`<tr>
                        <th scope="row">${data.ID}</th>
                        <th scope="row">${data.VARIANT}</th>
                        <td>${data.DATEOFINFECTION}</td>
                        <td>${data.DATEOFCURE}</td>
                        <td><a href="patient.php" class="btn btn-sm btn-info">Save</a></td>
                      </tr>`);
                  }

                </script>';

  require 'shared/footer.php';
?>
