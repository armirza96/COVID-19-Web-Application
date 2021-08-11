<?php

require "shared/header.php";
require "shared/navbar2.php";

require "shared/sidebar_begin.php";

require_once("php/getter.php");

$vaccines = getData("php/vaccines/get/get.txt");
$facilities = getData("php/facility/get/getFacilities.txt");

?>
<br />
<div style="display: flex; justify-content: space-between;">

    <h2 >
    Add Shipment
    </h2>


</div>

<form>
  <div class="form-row">

    <div class="form-group col-md-4">
      <label for="vaccineID">Vaccine</label>

        <select id="vaccineID" class="form-control" name="VACCINE_ID">
          <?php foreach($vaccines as $v): ?>
            <option value="<?=$v["ID"]?>"><?=$v["NAME"]?></option>
          <?php endforeach; ?>
        </select>

    </div>

    <div class="form-group col-md-4">
      <label for="DOR">Date of Reception</label>
      <input type="date" class="form-control" id="DOR" placeholder="Date of Reception" name="DOR">
    </div>

    <div class="form-group col-md-4">
      <label for="NumberOV">Number of Vaccines</label>
      <input type="number" class="form-control" id="NumberofVaccines" placeholder="Number of Vaccines" name="NOV">
    </div>

    <div class="form-group col-md-4">
      <label for="facilityID">Facility</label>

        <select id="facilityID" class="form-control" name="FACILITY_ID">
          <?php foreach($facilities as $f): ?>
            <option value="<?=$f["ID"]?>"><?=$f["NAME"]?></option>
          <?php endforeach; ?>
        </select>

    </div>

  </div>

</form>

<button class="btn btn-primary float-right" onclick="addShipment();">Add</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Shipment</h5>
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

  $jsToAddAfter[] = '<script src="js/patient/shipmentAdd.js"></script>';

  require 'shared/footer.php';
?>
