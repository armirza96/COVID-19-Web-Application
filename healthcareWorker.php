<?php

require "shared/header.php";
require "shared/navbar2.php";

require "shared/sidebar_begin.php";


//get patient info
$id = $_GET["ID"] ?? -1;

require_once("php/getter.php");

$data = getData("php/healthcareWorker/get/getHealthcareWorker.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]])[0];
$records = getData("php/healthcareWorker/get/getHealthcareWorkerEmploymentRecords.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]]);
$provinces = getData("php/provinces/get/get.txt");
$facilities = getData("php/facility/get/getFacilities.txt");

?>
<br />
<div style="display: flex; justify-content: space-between;">
  <h2 >
  Edit Employee: <?="{$data['FIRST_NAME']} {$data['LAST_NAME']}";?>
  </h2>
  <button onclick="deleteEmployee(<?=$id?>)" class="btn btn-sm btn-danger" style="height: fit-content;">Delete Employee</button>

</div>

<form>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="firstName">First Name</label>
      <input type="text" class="form-control" id="firstName" placeholder="First Name" name="FIRST_NAME" value="<?=$data["FIRST_NAME"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="lastName">Last Name</label>
      <input type="text" class="form-control" id="lastName" placeholder="lastName" name="FIRST_NAME" value="<?=$data["LAST_NAME"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="medicareNumber">Medicare</label>
      <input type="text" class="form-control" id="medicareNumber" placeholder="123-123-123" name="MEDICARE" value="<?=$data["MEDICARE"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="ssn">SSN</label>
      <input type="text" class="form-control" id="ssn" placeholder="123-123-123" name ="SSN" value="<?=$data["SSN"]?>">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="dob">Date of Birth</label>
      <input type="date" class="form-control" id="dob" placeholder="Date of birth" name="FIRST_NAME" value="<?=$data["DOB"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="someone@email.com" value="<?=$data["EMAIL"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="Telephone">Telephone</label>
      <input type="telephone" class="form-control" id="Telephone" placeholder="123 123 1233" value="<?=$data["PHONE"]?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?=$data["ADDRESS"]?>">
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity" value="<?=$data["CITY"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Province</label>
      <select id="inputState" class="form-control" name="PROVINCE">

        <?php foreach($provinces as $pr): ?>
          <option value="<?=$pr["ID"]?>" <?php echo ($data["provinceID"] == $pr["ID"] ? "selected" : "") ?>><?=$pr["NAME"]?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Postal Code</label>
      <input type="text" class="form-control" id="inputZip" value="<?=$data["POSTAL_CODE"]?>">
    </div>
  </div>


</form>
<button class="btn btn-primary float-right" onclick="edit(<?=$id?>);">Save</button>
<hr />

<br />
<br />


<div style="display: flex; justify-content: space-between;">

  <h3>Employment Records</h3>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#employmentModal">
    Add Record
  </button>

</div>

<br />

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Facility</th>
      <th scope="col">Start Date</th>
      <th scope="col">End Date</th>
      <th scope="col">&nbsp</th>
    </tr>
  </thead>
  <tbody id="tableBody">
    <?php foreach($records as $r): ?>
      <tr>
        <td scope="row"><?= $r["NAME"]; ?></td>
        <td scope="row"><?= $r["START_DATE"]; ?></td>
        <td><?= $r["END_DATE"]; ?></td>
        <?php if(!(!empty($r["START_DATE"]) && !empty($r["END_DATE"]))) : ?>
          <td scope="row"><button class="btn btn-warning float-right"data-toggle="modal" data-target="#editRecordModal">Edit</button></td>
        <?php endif; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="modal" tabindex="-1" role="dialog" id="processModal" tabindex="1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Employee: <?="{$data['FIRST_NAME']} {$data['LAST_NAME']}";?></h5>
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


<div class="modal fade" id="employmentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" role="alert">

        </div>
        <div class="alert alert-danger" role="alert">

        </div>
        <form id="formRecord">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="dob">Start Date</label>
              <input type="date" class="form-control" id="doi" placeholder="Date of infection" name="START_DATE">
            </div>
            <div class="form-group col-md-12">
              <label for="variant">Facility</label>
              <select id="inputVariant" class="form-control" name="FACILITY_ID">
                <?php foreach($facilities as $f): ?>
                  <option value="<?=$f["ID"]?>"><?=$f["NAME"]?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addRecord(<?=$id?>);">Add Record</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editRecordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Employment Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" role="alert">

        </div>
        <div class="alert alert-danger" role="alert">

        </div>
        <form id="formEditRecord">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="dob">End Date</label>
              <input type="date" class="form-control" id="doc" placeholder="end date" name="END_DATE">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="editStatus(<?=$id?>);">Save Record</button>
      </div>
    </div>
  </div>
</div>
<?php
  require "shared/sidebar_end.php";


  $jsToAddAfter[] = '<script src="js/healthcareWorker/healthcareWorker.js"></script>';
  require 'shared/footer.php';
?>
