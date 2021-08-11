
function doAjaxCall(dataToSend, uiParams,type = "GET"){
  if(type == "GET") {
    return $.get("php/base.php", dataToSend)
    .done(function( data ) {
      ajaxDone(data, uiParams);
    });
  } else {
    return $.post("php/base.php", dataToSend)
    .done(function( data ) {
      ajaxDone(data, uiParams);
    });
  }
}

function ajaxDone(data, uiParams) {
  console.log(data);
  if(uiParams !== undefined && window[uiParams.callback] !== null) {

    if(data.length > 0) {
      data = JSON.parse(data);
      const callback = window[uiParams.callback];
      const p = $(uiParams.parentEl);


      if(uiParams.type == "UI_UPDATE") {
        callback(p, data);
      } else if(uiParams.type == "ADD_TO_UI"){
        p.empty();
        for(const d of data) {
          console.log(d);
          callback(p, d);
        }
      }
    }
  }
}

function isArray(obj) {
    return Object.prototype.toString.call(obj) === '[object Array]';
}

$('.modal').on('hidden.bs.modal', function (e) {
  $(".alert").hide();
})
