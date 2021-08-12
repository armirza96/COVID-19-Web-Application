<?php

require "shared/header.php";
require "shared/navbar2.php";

require "shared/sidebar_begin.php";

//get patient info
$id = $_GET["ID"] ?? -1;

require_once("php/getter.php");

$data = getData("php/facility/get/getFacility.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]])[0];
$provinces = getData("php/provinces/get/get.txt");
$managers = getData("php/healthcareWorker/get/getHealthcareWorkerEmploymentRecords.txt");

?>
<br />
<div style="display: flex; justify-content: space-between;">

  <h2 >
  Edit Facility: <?="{$data['ID']}";?>
  </h2>
  <button onclick="deleteFacility(<?=$id?>)" class="btn btn-sm btn-danger" style="height: fit-content;">Delete Facility</button>

</div>

<form>
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" placeholder="Facility Name" name="NAME" value="<?=$data["name"]?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputState">Manager</label>
        <select id="inputState" class="form-control" name="MANAGERS_EMPLOYEE_RECORD_ID" value="<?=$data["managerEmployeeRecordID"]?>">
          <?php foreach($managers as $r): ?>
            <option value="<?=$r["ID"]?>"><?=$r["firstName"]?></option>
          <?php endforeach; ?>
        </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="type">Type</label>
      <select id="inputState" class="form-control" name="TYPE" value="<?=$data["type"]?>">
          <option value="Clinic">Clinic</option>
          <option value="Hospital">Hospital</option>
          <option value="Special installment">Special installment</option>
        </select>
    </div>
    <div class="form-group col-md-4">
      <label for="webAddress">Web Address</label>
      <input type="text" class="form-control" id="webAddress" placeholder="place.com" name="WEB_ADDRESS" value="<?=$data["webAddress"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="Telephone">Telephone</label>
      <input type="telephone" class="form-control" id="Telephone" placeholder="123 123 1233" name="PHONE" value="<?=$data["telephone"]?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="ADDRESS" value="<?=$data["address"]?>">
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity" name="CITY" value="<?=$data["city"]?>">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Province</label>
      <select id="inputState" class="form-control" name="PROVINCE" value="<?=$data["province"]?>">

        <?php foreach($provinces as $pr): ?>
          <option value="<?=$pr["ID"]?>"><?=$pr["NAME"]?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Postal Code</label>
      <input type="text" class="form-control" id="inputZip" name="POSTAL_CODE" value="<?=$data["postal_code"]?>">
    </div>
  </div>
</form>
<button class="btn btn-primary float-right" onclick="edit(<?=$id?>);">Save</button>

<hr />
<br />

<div class="modal" tabindex="-1" role="dialog" id="processModal" tabindex="1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Variant: <?="{$data['ID']}";?></h5>
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

  $jsToAddAfter[] = '<script>
  function edit(id) {
        $(".alert").hide();
        $("#processModal").modal("toggle");
        let dataToSend = {PAGE: "facility/update"};
        $("form :input").each(function(){
            const name = $(this).attr("name");
            const value = $(this).val();
            dataToSend[name] = value;
        });
        dataToSend["ID"] = id;
        console.log(dataToSend);
        doAjaxCall(dataToSend, {callback: "showEditAlert", parentEl: ".modal-body", type: "UI_UPDATE"}, "POST");
    }

    function showEditAlert(parentEl, data) {
      if(data.RESULT == 1) {
        $(".alert-success").text(data.MESSAGE + " Dismissing in 3 seconds");
        $(".alert-success").show();

        setTimeout(function(){
          $("#processModal").modal("toggle");
        }, 3000);

      } else {
        $(".alert-danger").text(data.MESSAGE);
        $(".alert-danger").show()
      }
    }

    function deleteFacility(id) {
      $(".alert").hide();
      $("#processModal").modal("toggle");
      doAjaxCall({PAGE: "facility/delete", "ID": id}, {callback: "showDeletedAlert", parentEl: ".modal-body", type: "UI_UPDATE"}, "POST");
    }

    function showDeletedAlert(parentEl, data) {
      if(data.RESULT == 1) {
        $(".alert-success").text(data.MESSAGE+ " Dismissing in 3 seconds");
        $(".alert-success").show();
        setTimeout(function(){
          //$("#processModal").modal("toggle");
          window.location.href = `facility.php`;
        }, 3000);

      } else {
        $(".alert-danger").text(data.MESSAGE);
        $(".alert-danger").show();
      }
    }


    </script>';

  require 'shared/footer.php';
?>
