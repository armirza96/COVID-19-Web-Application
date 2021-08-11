<?php

  require "shared/header.php";
  require "shared/navbar2.php";

  require "shared/sidebar_begin.php";
?>
<br />
<h2 class="float-left">Age Groups</h2>
<a href="ageGroupAdd.php" class="btn btn-sm btn-info float-right">Add an Age Group</a>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Lower Age Bound</th>
      <th scope="col">Upper Age Bound</th>
      <th scope="col" class="w-10">&nbsp</th>
    </tr>
  </thead>
  <tbody id="tableBody">

  </tbody>
</table>


<?php
  require "shared/sidebar_end.php";

  $jsToAddAfter[] = '<script>

                  doAjaxCall({PAGE: "ageGroups/get"}, {callback: "addDataToUI", parentEl: "#tableBody", type: "ADD_TO_UI"});

                  function addDataToUI(parentEl, data) {
                    parentEl.append(`<tr>
                        <th scope="row">${data.ID}</th>
                        <td>${data.lowerAgeBound}</td>
                        <td>${data.upperAgeBound}</td>
                        <td ><a href="ageGroup.php?ID=${data.ID}" class="btn btn-sm btn-info">Edit</a></td>
                      </tr>`);
                  }

                </script>';

  require 'shared/footer.php';
?>
