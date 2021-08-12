let dataToSend = {PAGE: 'employmentRecord/get', ID: $("#facilityID").val()};
doAjaxCall(dataToSend, {callback: 'addDataToUI', parentEl: "#employeeRecordID", type: 'UI_UPDATE'});

function perform() {
    $('.modal').modal('toggle')
    let dataToSend = {PAGE: 'vaccines/perform'};
    $('form :input').each(function(){
        const name = $(this).attr('name');
        const value = $(this).val();
        dataToSend[name] = value;
    });
    console.log(dataToSend);
    doAjaxCall(dataToSend, {callback: 'showAddedAlert', parentEl: 'body', type: 'UI_UPDATE'}, 'POST');
}

function showAddedAlert(parentEl, data) {
  if(data.RESULT == 1) {
    $('.alert-success').text(data.MESSAGE + '. ' + 'Dismissing in 3 seconds');
    $('.alert-success').show();

    setTimeout(function(){
      $('.modal').modal('toggle')
    }, 3000);
  } else {
    $('.alert-danger').text(data.MESSAGE);
    $('.alert-success').show()
  }
}

$("#facilityID").change(function() {
  let facilityID = $(this).val();
//  console.log(facilityID);

  let dataToSend = {PAGE: 'employmentRecord/get', ID: facilityID};
  //console.log(dataToSend);
  doAjaxCall(dataToSend, {callback: 'addDataToUI', parentEl: "#employeeRecordID", type: 'UI_UPDATE'});
});

function addDataToUI(parentEl, data) {
  $(parentEl).empty();
  console.log(data);
  for (const d of data) { // You can use `let` instead of `const` if you like
    $(parentEl).append(`<option value='${d.ID}'>${d.firstName} ${d.lastName} </option>`)
  }
}
