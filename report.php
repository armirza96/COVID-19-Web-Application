<?php

  require "shared/header.php";
  require "shared/navbar2.php";

  require "shared/sidebar_begin.php";

  $id = $_GET["ID"] ?? -1;

  switch($id) {
    case "Q12":
    require_once("php/reports/q12/q.php");
    break;
    case "Q13":
    require_once("php/reports/q13/q.php");
    break;
    case "Q14":
    require_once("php/reports/q14/q.php");
    break;
    case "Q15":
    require_once("php/reports/q15/q.php");
    break;
    case "Q16":
    require_once("php/reports/q16/q.php");
    break;
    case "Q17":
    require_once("php/reports/q17/q.php");
    break;
    case "Q18":
    require_once("php/reports/q18/q.php");
    break;
    case "Q19":
    require_once("php/reports/q19/q.php");
    break;
    case "Q20":
    require_once("php/reports/q20/q.php");
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

  $jsToAddAfter = [];

  require 'shared/footer.php';
?>
