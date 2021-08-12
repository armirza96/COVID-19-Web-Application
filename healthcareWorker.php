<?php

require "shared/header.php";
require "shared/navbar2.php";

require "shared/sidebar_begin.php";


//get patient info
$empID = $_GET["EMPLOYEE_ID"] ?? -1;

?>
<br />
<div style="display: flex; justify-content: space-between;">
  <?php if($empID > 0) : ?>
    <h2 >
    Edit Employee
    </h2>
    <button onclick="deleteHealthcareWorker(<?=$id?>)" class="btn btn-sm btn-danger" style="height: fit-content;">Delete Employee</button>
  <?php else : ?>
    <h2 >
    Add Employee
    </h2>
  <?php endif; ?>

</div>

<form>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="firstName">First Name</label>
      <input type="text" class="form-control" id="firstName" placeholder="First Name">
    </div>
    <div class="form-group col-md-4">
      <label for="lastName">Last Name</label>
      <input type="text" class="form-control" id="lastName" placeholder="lastName">
    </div>
    <div class="form-group col-md-4">
      <label for="ssn">SSN</label>
      <input type="text" class="form-control" id="ssn" placeholder="123-123-123">
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

  <button class="btn btn-primary float-right" onclick="edit(<?=$id?>);">Save</button>
</form>
<br />
<br />


<h3>Employment Record</h3>
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
  function edit(id) {
        $(".alert").hide();
        $("#processModal").modal("toggle");
        let dataToSend = {PAGE: "healthcareWorker/update"};
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

    function deleteHealthcareWorker(id) {
      $(".alert").hide();
      $("#processModal").modal("toggle");
      doAjaxCall({PAGE: "healthcareWorker/delete", "ID": id}, {callback: "showDeletedAlert", parentEl: ".modal-body", type: "UI_UPDATE"}, "POST");
    }

    function showDeletedAlert(parentEl, data) {
      if(data.RESULT == 1) {
        $(".alert-success").text(data.MESSAGE+ " Dismissing in 3 seconds");
        $(".alert-success").show();
        setTimeout(function(){
          //$("#processModal").modal("toggle");
          window.location.href = `variants.php`;
        }, 3000);

      } else {
        $(".alert-danger").text(data.MESSAGE);
        $(".alert-danger").show();
      }
    }
    </script>';

  require 'shared/footer.php';
?>
