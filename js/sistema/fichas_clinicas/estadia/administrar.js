$(function(){

var url_base = "/fichas_clinicas/estadia/";

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
                    template: '<div class="noty_message"><img src="/imagenes/icons/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
                    fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
                });

                var URL = url_base+'process/';

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


    
    $("#form-filtro").validationEngine('attach', {
    
    promptPosition:'topLeft',
    validationEventTrigger:false,
    showOneMessage:true,
    
        onValidationComplete: function(form, status){
        if(status) {
          
          
     

        var fecha= $('input:text[name=fecha]').val();

  
         if(fecha == ""){
            fecha= "all";
        }

    

        //alert(fecha_desde);
        //alert(fecha_hasta);


        
                      var codigo_ficha = $("#codigo_ficha").val();

//alert (codigo_ficha);
//var ruta_con_id = window.location.pathname+'/';
       var url_busqueda = url_base+codigo_ficha+'/';
             // var url_busqueda = ruta_con_id;


                     if(fecha != "all" ){

        
            var arr = fecha.split("/");
            //fecha= arr[2]+'-'+arr[0]+'-'+arr[1];
            fecha= arr[2]+'-'+arr[1]+'-'+arr[0];


         
}
               

           
            

               if(fecha){
                //fecha_desde =  fecha_desde.replace('/', '-');   
                //fecha_desde =  fecha_desde.replace('/', '-');   
                url_busqueda = url_busqueda + 'fecha/'+fecha+'/';
                }

        

                

  


                
           var urll =  url_busqueda.replace(' ', '_');   
                    
                
        window.location.href = urll;
          
        
    }
}
});



    
    $("#form-excel").validationEngine('attach', {
    
    promptPosition:'topLeft',
    validationEventTrigger:false,
    showOneMessage:true,
    
        onValidationComplete: function(form, status){
        if(status) {
          
          
     

        var fecha= $('input:text[name=fecha]').val();

  
         if(fecha == ""){
            fecha= "all";
        }

    

        //alert(fecha_desde);
        //alert(fecha_hasta);


        
                      var codigo_ficha = $("#codigo_ficha").val();


       var url_busqueda = url_base+codigo_ficha +'/exportar_estadia/';
             // var url_busqueda = ruta_con_id;


                     if(fecha != "all" ){

        
            var arr = fecha.split("/");
            //fecha= arr[2]+'-'+arr[0]+'-'+arr[1];
            fecha= arr[2]+'-'+arr[1]+'-'+arr[0];


         
}
               

           
            

               if(fecha){
                //fecha_desde =  fecha_desde.replace('/', '-');   
                //fecha_desde =  fecha_desde.replace('/', '-');   
                url_busqueda = url_busqueda + 'fecha/'+fecha+'/';
                }

        

                

  
                

                
           var urll =  url_busqueda.replace(' ', '_');   
                    
                
        window.location.href = urll;
          
        
    }
}
});



    $(".eliminar").click(function(e){

        e.preventDefault();
        var codigo = $(this).attr('rel');
        noty({
        layout: 'topCenter',
        fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>',
          text: '¿Est&aacute;s seguro que desea eliminar esta registro?',
          buttons: [
            {addClass: 'btn btn-primary', text: 'Aceptar', onClick: function($noty) {
                $noty.close();
                $(window).unbind('beforeunload');

                noty({
                    text: 'El registro est&aacute; siendo eliminado. Por favor, espere un momento.',
                    layout: 'topCenter',
                    type: 'alert',
                    killer:true,
                    closeWith: [],
                    template: '<div class="noty_message"><img src="/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
                    fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
                });

                $.ajax({
                    type: "POST",
                    data: "codigo="+codigo,
                    dataType: "json",
                    url: url_base+"eliminar/",
                    success: function(json){
                        if(json.result){
                            noty({
                                text: "El registro ha sido eliminado con &eacute;xito.",
                                layout: 'topCenter',
                                type: 'success',
                                timeout: 3000,
                                killer: true
                            });
                            setTimeout(function() {
                                    $("#eliminar-"+codigo).remove();
                            }, 1000);
                        }
                        else
                        {
                            var error = noty({
                                text: json.msg,
                                layout: 'topCenter',
                                type: 'error',
                                timeout: 2000
                            });
                        }
                    }
                });
              }
            },
            {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function($noty) {
                $noty.close();
              }
            }
          ]
        });

    });


});
