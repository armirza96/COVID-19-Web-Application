<?php

require "shared/header.php";
require "shared/navbar2.php";

require "shared/sidebar_begin.php";

//get patient info
$patientID = $_GET["PATIENT_ID"] ?? -1;

require_once("php/getter.php");

$patient = getData("php/patients/getPatient/getPatient.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$patientID]])[0];
$infections = getData("php/patients/getPatient/getPatientInfections.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$patientID]]);
$provinces = getData("php/province/getProvince/getProvinces.txt")
?>
<br />
<div style="display: flex; justify-content: space-between;">
  <?php if($patient) : ?>
    <h2 >
    Edit Patient: <?="{$patient['FIRST_NAME']} {$patient['LAST_NAME']}";?>
    </h2>
    <button onclick="deletePatient(<?=$patientID?>)" class="btn btn-sm btn-danger" style="height: fit-content;">Delete Patient</button>
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
      <input type="text" class="form-control" id="firstName" placeholder="First Name" value="<?=$patient["FIRST_NAME"]?>">
    </div>
    <div class="form-group col-md-6">
      <label for="lastName">Last Name</label>
      <input type="text" class="form-control" id="lastName" placeholder="lastName" value="<?=$patient["LAST_NAME"]?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="dob">Date of Birth</label>
      <input type="date" class="form-control" id="dob" placeholder="Date of birth" value="<?=$patient["dateOfBirth"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="someone@email.com"  value="<?=$patient["email"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="Telephone">Telephone</label>
      <input type="telephone" class="form-control" id="Telephone" placeholder="123 123 1233"  value="<?=$patient["telephone"]?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"  value="<?=$patient["address"]?>">
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity"  value="<?=$patient["city"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Province</label>
      <select id="inputState" class="form-control">

        <?php foreach($provinces as $pr): ?>
          <option <?php echo ($patient["provinceID"] == $pr["ID"] ? "selected" : "") ?>><?=$pr["NAME"]?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Postal Code</label>
      <input type="text" class="form-control" id="inputZip"  value="<?=$patient["postal_code"]?>">
    </div>
  </div>

<h3>Citizenship status</h3>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="IDNumber">ID Number</label>
      <input type="text" class="form-control" id="IDNumber" placeholder="SSN # or passport #" value="<?=$patient["IDNumber"]?>">
    </div>

    <div class="form-group col-md-4">
      <label for="inputState">Is a Ctizen of Canada?</label>
      <select id="inputState" class="form-control">
        <?php foreach(array("YES", "NO") as $ans): ?>
          <option <?php echo ($patient["IS_CITIZEN"] === $ans ? "selected" : "") ?>><?=$ans?></option>
        <?php endforeach; ?>
      </select>
    </div>

  </div>

  <button type="submit" class="btn btn-primary float-right">Save</button>
</form>
<br />
<br />


<h3>Patient's Infections</h3>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Variant</th>
      <th scope="col">Infection Date</th>
      <th scope="col">Cure Date</th>
      <th scope="col">&nbsp</th>
    </tr>
  </thead>
  <tbody id="tableBody">
    <?php foreach($infections as $infection): ?>
      <tr>
        <td scope="row"><?= $infection["NAME"]; ?></td>
        <td scope="row"><?= $infection["TYPE"]; ?></td>
        <td><?= $infection["DATE_OF_INFECTION"]; ?></td>
        <td><?= $infection["DATE_OF_CURE"]; ?></td>
        <td><button href="patient.php" class="btn btn-sm btn-danger float-right">Delete</button></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Deleting Patient: <?="{$patient['FIRST_NAME']} {$patient['LAST_NAME']}";?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="loader"></div>
        <div class="alert alert-success hide" role="alert">

        </div>
        <div class="alert alert-danger hide" role="alert">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php
  require "shared/sidebar_end.php";

  $jsToAddAfter[] = "<script>
                    function deletePatient(patientID) {
                      doAjaxCall({PAGE: 'deletePatient', 'PATIENT_ID': ${patientID}}, {callback: 'showDeletedPatientAlert', parentEl: '.modal-body', type: 'UI_UPDATE'});
                    }

                    function showDeletedPatientAlert(parentEl, data) {
                      if(data.RESULT == 1) {
                        $('.alert-success').text(data.MESSAGE);
                      } else {
                        $('.alert-danger').text(data.MESSAGE);
                      }
                    }

                </script>";

  require 'shared/footer.php';
?>
