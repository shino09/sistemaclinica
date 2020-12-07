$(function(){

/*if (typeof jQuery != 'undefined') {  
    // jQuery is loaded => print the version
    alert(jQuery.fn.jquery);
}*/
var url_base = "/pruebapilot/";
alert('js funciona');
    $("#form").validationEngine('attach', {
        promptPosition:'topLeft',
        validationEventTrigger:false,
        showOneMessage:true,
        onValidationComplete: function(form, status){
            if(status) {

                noty({
                    text: 'Por favor, espere un momento.',
                    layout: 'topCenter',
                    type: 'alert',
                    closeWith: [],
                    killer:true,
                    template: '<div class="noty_message"><img src="/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
                    fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
                });

                var URL = url_base+'enviar/';

                if($('#codigo').length  > 0){
                    URL = URL + $('#codigo').val();
                }

                $.ajax({
                    url: URL,
                    type: 'post',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function(json){
                        if(json.result){
                            noty({
                                text: json.msj,
                                layout: 'topCenter',
                                type: 'success',
                                killer: true
                            });

                            setTimeout(function(){
                                window.location.href = url_base;
                            }, 1000);
                        }
                        else
                        {
                            noty({
                                text: json.msj,
                                layout: 'topCenter',
                                type: 'error',
                                timeout: 3000,
                                killer: true
                            });
                        }
                    }
                });
            }
       }
    });

   

});
