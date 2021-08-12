<?php

  require "shared/header.php";
  require "shared/navbar2.php";

  require "shared/sidebar_begin.php";
?>
<br />
<h2 class="float-left">Employees</h2>
<a href="healthcareWorkerAdd.php" class="btn btn-sm btn-info float-right">Add an Employee</a>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col" class="w-10">&nbsp</th>
    </tr>
  </thead>
  <tbody id="tableBody">

  </tbody>
</table>


<?php
  require "shared/sidebar_end.php";

  $jsToAddAfter[] = '<script>

                  doAjaxCall({PAGE: "healthcareWorker/get"}, {callback: "addDataToUI", parentEl: "#tableBody", type: "ADD_TO_UI"});

                  function addDataToUI(parentEl, data) {
                    parentEl.append(`<tr>
                        <th scope="row">${data.ID}</th>
                        <td>${data.FIRST_NAME}</td>
                        <td>${data.LAST_NAME}</td>
                        <td ><a href="healthcareWorker.php?ID=${data.ID}" class="btn btn-sm btn-info">Edit</a></td>
                      </tr>`);
                  }

                </script>';

  require 'shared/footer.php';
?>
