<?php

  require "shared/header.php";
  require "shared/navbar2.php";

  require "shared/sidebar_begin.php";

?>
<br />
<h2 class="float-left">Facilities</h2>
<a href="facilityAdd.php" class="btn btn-sm btn-info float-right">Add a facility</a>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Address</th>
      <th scope="col">City</th>
      <th scope="col">Province</th>
      <th scope="col">Postal Code</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Web Address</th>
      <th scope="col">Type</th>
      <th scope="col">Number of Vaccines Available</th>
      <th scope="col" class="w-10">&nbsp</th>
    </tr>
  </thead>
  <tbody id="tableBody">

  </tbody>
</table>


<?php
  require "shared/sidebar_end.php";

  $jsToAddAfter[] = '<script>

                  doAjaxCall({PAGE: "facility/get"}, {callback: "addDataToUI", parentEl: "#tableBody", type: "ADD_TO_UI"});

                  function addDataToUI(parentEl, data) {
                    parentEl.append(`<tr>
                        <th scope="row">${data.ID}</th>
                        <td>${data.name}</td>
                        <td>${data.address}</td>
                        <td>${data.city}</td>
                        <td>${data.provinceID}</td>
                        <td>${data.postal_code}</td>
                        <td>${data.telephone}</td>
                        <td>${data.webAddress}</td>
                        <td>${data.type}</td>
                        <td>${data.inventory ?? 0}</td>
                        <td ><a href="facility.php?ID=${data.ID}" class="btn btn-sm btn-info">Edit</a></td>
                      </tr>`);
                  }

                </script>';

  require 'shared/footer.php';
?>
