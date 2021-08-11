<?php

require "shared/header.php";
require "shared/navbar2.php";

require "shared/sidebar_begin.php";

//get patient info
$id = $_GET["ID"] ?? -1;

require_once("php/getter.php");

$data = getData("php/ageGroups/get/getAgeGroup.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]])[0];

?>
<br />
<div style="display: flex; justify-content: space-between;">

  <h2 >
  Edit Age Group: <?="{$data['ID']}";?>
  </h2>
  <button onclick="deleteAgeGroup(<?=$id?>)" class="btn btn-sm btn-danger" style="height: fit-content;">Delete Age Group</button>

</div>

<form>
  <div class="form-row">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="lab">Lower Age Bound</label>
        <input type="number" class="form-control" id="lab" placeholder="Lower Age Bound" name="LOWER_AGE_BOUND" value="<?=$data["LOWER_AGE_BOUND"]?>">
      </div>
      <div class="form-group col-md-6">
        <label for="lab">Upper Age Bound</label>
        <input type="number" class="form-control" id="lab" placeholder="Upper Age Bound" name="UPPER_AGE_BOUND" value="<?=$data["UPPER_AGE_BOUND"]?>">
      </div>
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
        let dataToSend = {PAGE: "ageGroups/update"};
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

    function deleteAgeGroup(id) {
      $(".alert").hide();
      $("#processModal").modal("toggle");
      doAjaxCall({PAGE: "ageGroups/delete", "ID": id}, {callback: "showDeletedAlert", parentEl: ".modal-body", type: "UI_UPDATE"}, "POST");
    }

    function showDeletedAlert(parentEl, data) {
      if(data.RESULT == 1) {
        $(".alert-success").text(data.MESSAGE+ " Dismissing in 3 seconds");
        $(".alert-success").show();
        setTimeout(function(){
          //$("#processModal").modal("toggle");
          window.location.href = `ageGroups.php`;
        }, 3000);

      } else {
        $(".alert-danger").text(data.MESSAGE);
        $(".alert-danger").show();
      }
    }


    </script>';

  require 'shared/footer.php';
?>
