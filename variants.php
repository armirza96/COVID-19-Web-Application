<?php

  require "shared/header.php";
  require "shared/navbar2.php";

  require "shared/sidebar_begin.php";
?>
<br />
<h2 class="float-left">Variants</h2>
<a href="variantAdd.php" class="btn btn-sm btn-info float-right">Add a Variant</a>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Type</th>
      <th scope="col" class="w-10">&nbsp</th>
    </tr>
  </thead>
  <tbody id="tableBody">

  </tbody>
</table>


<?php
  require "shared/sidebar_end.php";

  $jsToAddAfter[] = '<script>

                  doAjaxCall({PAGE: "variants/get"}, {callback: "addDataToUI", parentEl: "#tableBody", type: "ADD_TO_UI"});
                //  ajaxDone([{"NAME": "MARK", "LASTNAME": "JOHN", "ID": 1}], {callback: "addDataToUI", parentEl: "#tableBody"});

                  function addDataToUI(parentEl, data) {
                    parentEl.append(`<tr>
                        <th scope="row">${data.ID}</th>
                        <td>${data.NAME}</td>
                        <td>${data.TYPE}</td>
                        <td ><a href="variant.php?VARIANT_ID=${data.ID}" class="btn btn-sm btn-info">Edit</a></td>
                      </tr>`);
                  }

                </script>';

  require 'shared/footer.php';
?>
