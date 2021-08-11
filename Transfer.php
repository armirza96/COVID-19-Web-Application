<?php

require "shared/header.php";
require "shared/navbar2.php";

require "shared/sidebar_begin.php";

?>
<br />
<div style="display: flex; justify-content: space-between;">

    <h2 >
    Transfer
    </h2>


</div>

<form>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="FromFacilityID">From Facility ID</label>
      <input type="text" class="form-control" id="FromFacilityID" placeholder=" From Facility ID" name="FROMFACILITY_ID">
    </div>
	
	<div class="form-group col-md-4">
      <label for="ToFacilityID">To Facility ID</label>
      <input type="text" class="form-control" id="ToFacilityID" placeholder="To Facility ID" name="ToFACILITY_ID">
    </div>
	
    <div class="form-group col-md-4">
      <label for="DOR">Date of Transfer</label>
      <input type="date" class="form-control" id="DOT" placeholder="Date of Transfer" name="DOT">
    </div>
	
    <div class="form-group col-md-4">
      <label for="NumberOVT">Number of Vaccines Transfered</label>
      <input type="number" class="form-control" id="NumberofVaccinesTransfered" placeholder="Number of Vaccines Transfered" name="NOVT">
    </div>
	
  </div>

</form>

<button class="btn btn-primary float-right" onclick="transfer();">Transfer</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Transfer</h5>
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

  $jsToAddAfter[] = '<script src="js/patient/transfer.js"></script>';;

  require 'shared/footer.php';
?>