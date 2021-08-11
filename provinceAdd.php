<?php

require "shared/header.php";
require "shared/navbar2.php";

require "shared/sidebar_begin.php";

?>
<br />
<div style="display: flex; justify-content: space-between;">

  <h2 >
  Add Province
  </h2>
</div>

<form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" placeholder="Name" name="NAME">
    </div>
    <div class="form-group col-md-6">
      <label for="code">Code</label>
      <input type="text" class="form-control" id="code" placeholder="Code" name="CODE">
    </div>
  </div>

</form>
<button class="btn btn-primary float-right" onclick="add();">Add province</button>

<hr />
<br />

<div class="modal" tabindex="-1" role="dialog" id="processModal" tabindex="1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Adding Province</h5>
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

  $jsToAddAfter[] = '<script src="js/province/add.js"></script>';;

  require 'shared/footer.php';
?>
