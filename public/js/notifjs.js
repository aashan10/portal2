var AjaxNotifier = function(response, statuscode){
    if(statuscode > 299 && statuscode < 200){
        response = response.responseJSON;
    }
    var alertClass;
    if(response.status === 'success'){
        alertClass = 'alert-success';
    }else if(response.status === 'error'){
        alertClass = 'alert-danger';
    }else{
        alertClass = 'alert-info';
    }
    var alerter = document.createElement('div');
    alerter.setAttribute('role','alert');
    alerter.classList.add('alert', alertClass, 'alert-dismissible', 'fade', 'show');
    var button = document.createElement('button');
    button.setAttribute('type', 'button');
    button.setAttribute('data-dismiss', 'alert');
    button.setAttribute('aria-label', 'Close');
    button.setAttribute('class', 'close');
    var span = document.createElement('span');
    span.setAttribute('aria-hidden','true');
    span.innerText = '×';
    button.appendChild(span);
    alerter.innerText = response.message;
    alerter.appendChild(button);
    $('#notifications').append(alerter);
    var interval = setInterval(function(){
        clearInterval(interval);
        $(alerter).fadeOut(300);
    },10000);
}