
function doAjaxCall(dataToSend, uiParams,type = "GET"){
  if(type == "GET") {
    return $.get("php/getter.php", dataToSend)
    .done(function( data ) {
      data = JSON.parse(data);
      ajaxDone(data, uiParams);
    });
  } else {
    return $.post("php/getter.php", postData)
    .done(function( data ) {
      ajaxDone(data, uiParams);
    });
  }
}

function ajaxDone(data, uiParams) {
  console.log(data);
  if( uiParams !== undefined && window[uiParams.callback] !== null) {
    if(data.length > 0) {
      const callback = window[uiParams.callback];
      const p = $(uiParams.parentEl);
      p.empty();

      for(const d of data) {
        console.log(d);
        callback(p, d);
      }
    }
  }
}

function isArray(obj) {
    return Object.prototype.toString.call(obj) === '[object Array]';
}
