function edit(id) {
      $(".alert").hide();
      $("#processModal").modal("toggle");
      let dataToSend = {PAGE: "vaccines/update"};
      $(":formVaccine :input").each(function(){
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

  function addStatus(id) {
     $("#dateOfApprovalInput").show();
      let dataToSend = {PAGE: 'vaccines/status/add'};
      $('#formStatus :input').each(function(){
          const name = $(this).attr('name');
          const value = $(this).val();
          dataToSend[name] = value;
      });
      dataToSend['ID'] = id;
      console.log(dataToSend);
      doAjaxCall(dataToSend, {callback: 'showAddedStatusAlert', parentEl: 'body', type: 'UI_UPDATE'}, 'POST');
  }

  function showAddedStatusAlert(parentEl, data) {
    if(data.RESULT == 1) {
      $('.alert-success').text(data.MESSAGE + '. ' + 'Redirecting in 3 seconds');
      $('.alert-success').show();
      setTimeout(function(){
        //$('#processModal').modal('toggle');
        window.location.href = `vaccine.php?ID=${data.ID}`;
      }, 3000);

    } else {
      $('.alert-danger').text(data.MESSAGE);
      $('.alert-success').show()
    }
  }

  function editStatus(id) {
      $("#dateOfApprovalInput").hide();
      let dataToSend = {PAGE: 'vaccines/status/update'};
      $('#formEditStatus :input').each(function(){
          const name = $(this).attr('name');
          const value = $(this).val();
          dataToSend[name] = value;
      });
      dataToSend['ID'] = id;
      console.log(dataToSend);
      doAjaxCall(dataToSend, {callback: 'showEditStatusAlert', parentEl: 'body', type: 'UI_UPDATE'}, 'POST');
  }

  function showEditStatusAlert(parentEl, data) {
    if(data.RESULT == 1) {
      $('.alert-success').text(data.MESSAGE + '. ' + 'Redirecting in 3 seconds');
      $('.alert-success').show();
      setTimeout(function(){
        //$('#processModal').modal('toggle');
        window.location.href = `vaccine.php?ID=${data.ID}`;
      }, 3000);

    } else {
      $('.alert-danger').text(data.MESSAGE);
      $('.alert-success').show()
    }
  }

  function deleteVaccine(id) {
    $(".alert").hide();
    $("#processModal").modal("toggle");
    doAjaxCall({PAGE: "vaccines/delete", "ID": id}, {callback: "showDeletedAlert", parentEl: ".modal-body", type: "UI_UPDATE"}, "POST");
  }

  function showDeletedAlert(parentEl, data) {
    if(data.RESULT == 1) {
      $(".alert-success").text(data.MESSAGE+ " Dismissing in 3 seconds");
      $(".alert-success").show();
      setTimeout(function(){
        //$("#processModal").modal("toggle");
        window.location.href = `vaccines.php`;
      }, 3000);

    } else {
      $(".alert-danger").text(data.MESSAGE);
      $(".alert-danger").show();
    }
  }
