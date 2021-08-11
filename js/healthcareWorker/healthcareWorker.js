function editPatient(patientID) {
    $('.alert').hide();
    $('#processModal').modal('toggle');
    let dataToSend = {PAGE: 'updatePatient'};
    $('#formPatient :input').each(function(){
        const name = $(this).attr('name');
        const value = $(this).val();
        dataToSend[name] = value;
    });
    dataToSend['IS_CITIZEN'] = $('#inputCitizen').val();
    dataToSend['AGE_GROUP'] = $('#ageGroup').val();
    dataToSend['PATIENT_ID'] = patientID;
    console.log(dataToSend);
    doAjaxCall(dataToSend, {callback: 'showEditPatientAlert', parentEl: '.modal-body', type: 'UI_UPDATE'}, 'POST');
}

function showEditPatientAlert(parentEl, data) {
  if(data.RESULT == 1) {
    $('.alert-success').text(data.MESSAGE+ '. ' + 'Dismissing in 3 seconds');
    $('.alert-success').show();

    setTimeout(function(){
      $('#processModal').modal('toggle');
    }, 3000);

  } else {
    $('.alert-danger').text(data.MESSAGE);
    $('.alert-danger').show()
  }
}

function deletePatient(patientID) {
  $('.alert').hide();
  $('#processModal').modal('toggle');
  doAjaxCall({PAGE: 'deletePatient', 'PATIENT_ID': patientID}, {callback: 'showDeletedPatientAlert', parentEl: '.modal-body', type: 'UI_UPDATE'}, 'POST');
}

function showDeletedPatientAlert(parentEl, data) {
  if(data.RESULT == 1) {
    $('.alert-success').text(data.MESSAGE+ ' Dismissing in 3 seconds');
    $('.alert-success').show();
    setTimeout(function(){
      //$('#processModal').modal('toggle');
      window.location.href = `patients.php`;
    }, 3000);

  } else {
    $('.alert-danger').text(data.MESSAGE);
    $('.alert-danger').show();
  }
}

function addInfection(patientID) {
  //  $('#processModal').modal('toggle');
    let dataToSend = {PAGE: 'addInfection'};
    $('#formInfection :input').each(function(){
        const name = $(this).attr('name');
        const value = $(this).val();
        dataToSend[name] = value;
    });
    dataToSend['PATIENT_ID'] = patientID;
    console.log(dataToSend);
    doAjaxCall(dataToSend, {callback: 'showAddedInfectionAlert', parentEl: 'body', type: 'UI_UPDATE'}, 'POST');
}

function showAddedInfectionAlert(parentEl, data) {
  if(data.RESULT == 1) {
    $('.alert-success').text(data.MESSAGE + '. ' + 'Redirecting in 3 seconds');
    $('.alert-success').show();
    setTimeout(function(){
      //$('#processModal').modal('toggle');
      window.location.href = `patient.php?PATIENT_ID=${data.ID}`;
    }, 3000);

  } else {
    $('.alert-danger').text(data.MESSAGE);
    $('.alert-success').show()
  }
}


function deleteInfection(infectionID) {
  $('.alert').hide();
  $('#processModal').modal('toggle');
  doAjaxCall({PAGE: 'deleteInfection', 'INFECTION_ID': infectionID}, {callback: 'showDeletedInfectionAlert', parentEl: '.modal-body', type: 'UI_UPDATE'}, 'POST');
}

function showDeletedInfectionAlert(parentEl, data) {
  if(data.RESULT == 1) {
    $('.alert-success').text(data.MESSAGE+ ' Dismissing in 3 seconds');
    $('.alert-success').show();
    setTimeout(function(){
      //$('#processModal').modal('toggle');
      location.reload();
    }, 3000);

  } else {
    $('.alert-danger').text(data.MESSAGE);
    $('.alert-danger').show();
  }
}
