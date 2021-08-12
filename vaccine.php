<?php

require "shared/header.php";
require "shared/navbar2.php";

require "shared/sidebar_begin.php";

//get patient info
$id = $_GET["ID"] ?? -1;

require_once("php/getter.php");

$data = getData("php/vaccines/get/getVaccine.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]])[0];
$statuses = getData("php/vaccines/get/getVaccineStatuses.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]]);
?>
<br />
<div style="display: flex; justify-content: space-between;">

  <h2 >
  Edit Vaccine: <?="{$data['NAME']} ({$data['STATUS']})";?>
  </h2>
  <button onclick="deleteVaccine(<?=$id?>)" class="btn btn-sm btn-danger" style="height: fit-content;">Delete Vaccine</button>

</div>

<form id="formVaccine">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" placeholder="Name" name="NAME" value="<?=$data["NAME"]?>">
    </div>
    <div class="form-group col-md-6">
      <label for="type">Type</label>
      <input type="text" class="form-control" id="type" placeholder="Type: mRNA, etc" name="TYPE" value="<?=$data["TYPE"]?>">
    </div>
    <div class="form-group col-md-6">
      <label for="type">Doses Needed</label>
      <input type="number" class="form-control" id="doses" placeholder="1, 2, 3" name="DOSES" value="<?=$data["DOSES"]?>">
    </div>
  </div>

</form>
<button class="btn btn-primary float-right" onclick="edit(<?=$id?>);">Save</button>

<hr />
<br />

<div style="display: flex; justify-content: space-between;">

  <h3>Vaccine's Statuses</h3>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusModal"  >
    Add Status
  </button>

</div>
<br />
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Approval Date</th>
      <th scope="col">Suspension Date</th>
      <th scope="col">&nbsp</th>
    </tr>
  </thead>
  <tbody id="tableBody">
    <?php foreach($statuses as $status): ?>
      <tr>
        <td scope="row"><?= $status["DATE_OF_APPROVAL"]; ?></td>
        <td scope="row"><?= $status["DATE_OF_SUSPENSION"]; ?></td>
        <?php if(!(!empty($status["DATE_OF_APPROVAL"]) && !empty($status["DATE_OF_SUSPENSION"]))) : ?>
                    <td scope="row"><button class="btn btn-warning float-right"data-toggle="modal" data-target="#editStatusModal">Edit</button></td>
        <?php endif; ?>

      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="modal" tabindex="-1" role="dialog" id="processModal" tabindex="1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Vaccine: <?="{$data['NAME']}";?></h5>
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

<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <form id="formStatus">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="dob">Date of Approval</label>
              <input type="date" class="form-control" id="doi" placeholder="Date of infection" name="DATE_OF_APPROVAL">
            </div>
            <div class="form-group col-md-6">
              <label for="dob">Date of Suspension</label>
              <input type="date" class="form-control" id="doc" placeholder="Date of cure" name="DATE_OF_SUSPENSION">
            </div>

          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addStatus(<?=$id?>)">Add Status</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
        <form id="formEditStatus">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="dob">Date of Suspension</label>
              <input type="date" class="form-control" id="doc" placeholder="Date of cure" name="DATE_OF_SUSPENSION">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="editStatus(<?=$id?>);">Save Status</button>
      </div>
    </div>
  </div>
</div>

<?php
  require "shared/sidebar_end.php";

  $jsToAddAfter[] = '<script src="js/vaccine/vaccine.js"></script>';

  require 'shared/footer.php';
?>
