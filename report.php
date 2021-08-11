<?php

  require "shared/header.php";
  require "shared/navbar2.php";

  require "shared/sidebar_begin.php";

  $id = $_GET["ID"] ?? -1;

  switch($id) {
    case "Q12":
    require_once("php/reports/q12/q12.php");
    break;
    default:
    break;
  }


?>
<br />

<h2>Report: <?=$id?></h2>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <?php foreach($columnNames as $col): ?>
        <th scope="col"><?=$col ?></th>
      <?php endforeach; ?>

    </tr>
  </thead>
  <tbody id="tableBody">
    <?php foreach($data as $d): ?>
      <?php foreach($columnNames as $col): ?>
        <th scope="col"><?=$d[$col] ?></th>
      <?php endforeach; ?>
    <?php endforeach; ?>

  </tbody>
</table>

<?php
  require "shared/sidebar_end.php";



  require 'shared/footer.php';
?>
