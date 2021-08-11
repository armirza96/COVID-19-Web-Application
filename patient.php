<?php

require "shared/header.php";
require "shared/navbar2.php";

require "shared/sidebar_begin.php";

//get patient info
$patientID = $_GET["PATIENT_ID"] ?? -1;

require_once("php/getter.php");

$patient = getData("php/patients/getPatient/getPatient.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$patientID]])[0];
$infections = getData("php/patients/getPatient/getPatientInfections.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$patientID]]);
$provinces = getData("php/province/getProvince/getProvinces.txt");
$ageGroups = getData("php/ageGroups/getAgeGroups.txt");
$variants = getData("php/variants/getVariants/getVariants.txt");

?>
<br />
<div style="display: flex; justify-content: space-between;">

  <h2 >
  Edit Patient: <?="{$patient['FIRST_NAME']} {$patient['LAST_NAME']}";?>
  </h2>
  <button onclick="deletePatient(<?=$patientID?>)" class="btn btn-sm btn-danger" style="height: fit-content;">Delete Patient</button>

</div>

<form id="formPatient">
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="firstName">First Name</label>
      <input type="text" class="form-control" id="firstName" placeholder="First Name" name="FIRST_NAME" value="<?=$patient["FIRST_NAME"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="lastName">Last Name</label>
      <input type="text" class="form-control" id="lastName" placeholder="lastName" name="LAST_NAME" value="<?=$patient["LAST_NAME"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="medicareNumber">Medicare</label>
      <input type="text" class="form-control" id="medicareNumber" placeholder="medicare #" name="MEDICARE" value="<?=$patient["medicareNumber"]?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="dob">Date of Birth</label>
      <input type="date" class="form-control" id="dob" placeholder="Date of birth" name="DOB" value="<?=$patient["dateOfBirth"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="someone@email.com" name="EMAIL" value="<?=$patient["email"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="Telephone">Telephone</label>
      <input type="telephone" class="form-control" id="Telephone" placeholder="123 123 1233" name="PHONE" value="<?=$patient["telephone"]?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="ADDRESS" value="<?=$patient["address"]?>">
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity" name="CITY" value="<?=$patient["city"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Province</label>
      <select id="inputState" class="form-control" name="PROVINCE">

        <?php foreach($provinces as $pr): ?>
          <option value="<?=$pr["ID"]?>" <?php echo ($patient["provinceID"] == $pr["ID"] ? "selected" : "") ?>><?=$pr["NAME"]?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Postal Code</label>
      <input type="text" class="form-control" id="inputZip" name="POSTAL_CODE" value="<?=$patient["postal_code"]?>">
    </div>
  </div>

  <h3>Age Group</h3>
    <div class="form-row">

      <div class="form-group col-md-4">
        <label for="ageGroup">What age group do they belong to?</label>

          <select id="ageGroup" class="form-control" name="AGE_GROUP">
            <?php foreach($ageGroups as $group): ?>
              <option value="<?=$group["ID"]?>" <?php echo ($patient["AgeGroupID"] === $group["ID"] ? "selected" : "") ?>><?="{$group['lowerAgeBound']} - {$group['upperAgeBound']}"; ?></option>
            <?php endforeach; ?>
          </select>

      </div>

    </div>

  <h3>Citizenship status</h3>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="IDNumber">ID Number</label>
        <input type="text" class="form-control" id="IDNumber" placeholder="SSN # or passport #" name="ID_NUMBER" value="<?=$patient["IDNumber"]?>">
      </div>

      <div class="form-group col-md-4">
        <label for="inputCitizen">Is a Ctizen of Canada?</label>
        <select id="inputCitizen" class="form-control" name="IS_CITZEN">
          <?php foreach(array("YES", "NO") as $ans): ?>
            <option <?php echo ($patient["IS_CITIZEN"] === $ans ? "selected" : "") ?>><?=$ans?></option>
          <?php endforeach; ?>
        </select>
      </div>

    </div>


</form>
<button class="btn btn-primary float-right" onclick="editPatient(<?=$patientID?>);">Save</button>

<hr />
<br />
<br />





<div style="display: flex; justify-content: space-between;">

  <h3>Patient's Infections</h3>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#infectionModal">
    Add Infection
  </button>

</div>
<br />
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
        <td><button onclick="deleteInfection(<?=$infection["ID"]?>);" class="btn btn-sm btn-danger float-right">Delete</button></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="modal" tabindex="-1" role="dialog" id="processModal" tabindex="1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Patient: <?="{$patient['FIRST_NAME']} {$patient['LAST_NAME']}";?></h5>
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

<div class="modal fade" id="infectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Infection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" role="alert">

        </div>
        <div class="alert alert-danger" role="alert">

        </div>
        <form id="formInfection">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="dob">Date of Infection</label>
              <input type="date" class="form-control" id="doi" placeholder="Date of infection" name="INFECTION_DATE">
            </div>
            <div class="form-group col-md-6">
              <label for="dob">Date of Cure</label>
              <input type="date" class="form-control" id="doc" placeholder="Date of cure" name="CURE_DATE">
            </div>
            <div class="form-group col-md-12">
              <label for="variant">Variant</label>
              <select id="inputVariant" class="form-control" name="VARIANT">
                <?php foreach($variants as $v): ?>
                  <option value="<?=$v["ID"]?>"><?=$v["NAME"]?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addInfection(<?=$patientID?>);">Add Infection</button>
      </div>
    </div>
  </div>
</div>

<?php
  require "shared/sidebar_end.php";

  $jsToAddAfter[] = '<script src="js/patient/patient.js"></script>';

  require 'shared/footer.php';
?>
