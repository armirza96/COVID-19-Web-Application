<?php

  require "shared/header.php";
  require "shared/navbar2.php";

  require "shared/sidebar_begin.php";
?>

<h1>Patients</h1>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody id="tableBody">

  </tbody>
</table>


<?php
  require "shared/sidebar_end.php";

  $jsToAddAfter[] = '<script>



                  //doAjaxCall({}, addPatientsToUI);
                  ajaxDone([{"NAME": "MARK", "LASTNAME": "JOHN", "ID": 1}], {callback: "addPatientsToUI", parentEl: "#tableBody"});

                  function addPatientsToUI(parentEl, data) {
                    parentEl.append(`<tr>
                        <th scope="row">${data.ID}</th>
                        <td>${data.NAME}</td>
                        <td>${data.LASTNAME}</td>
                        <td>@${data.NAME}</td>
                      </tr>`);
                  }

                </script>';

  require "shared/footer.php";
?>
