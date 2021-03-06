function add() {
    $('.modal').modal('toggle')
    let dataToSend = {PAGE: 'provinces/add'};
    $('form :input').each(function(){
        const name = $(this).attr('name');
        const value = $(this).val();
        dataToSend[name] = value;
    });
      dataToSend['AGE_GROUP'] = $('#ageGroup').val();
    console.log(dataToSend);
    doAjaxCall(dataToSend, {callback: 'showAddedAlert', parentEl: 'body', type: 'UI_UPDATE'}, 'POST');
}

function showAddedAlert(parentEl, data) {
  if(data.RESULT == 1) {
    $('.alert-success').text(data.MESSAGE + '. ' + 'Redirecting in 3 seconds');
    $('.alert-success').show();

    setTimeout(function(){
      window.location.href = `province.php?ID=${data.ID}`;
    }, 3000);
  } else {
    $('.alert-danger').text(data.MESSAGE);
    $('.alert-success').show()
  }
}
