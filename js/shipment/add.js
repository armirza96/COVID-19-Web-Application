function add() {
    $('.modal').modal('toggle')
    let dataToSend = {PAGE: 'shipments/add'};
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
