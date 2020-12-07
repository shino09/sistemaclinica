$(function(){

var url_base = "/fichas_clinicas/control_operativo/";
var url_redirigir = "/fichas_clinicas/fichas_clinicas/";

//alert('sdfsdfsdfsdfsdfdsfsdfsdfsdfsdfsfd');
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

    			//var URL = url_base+'process/';
                                var URL = url_base+'process2/';


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
    							//window.location.href = url_base;
                                    window.location.href = url_redirigir;

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
		  
		  
		var busqueda = $("#busqueda").val();
		var estado = $("#estado").val();
                var centro_medico = $("#centro_medico").val();

                     //   var centros = $("#centros").val();


       	var url_busqueda = url_base;
        
		if(busqueda)
			url_busqueda = url_busqueda + 'busqueda/'+busqueda+'/';
			if(estado)
				url_busqueda = url_busqueda + 'estado/'+estado+'/';
            if(centro_medico)
                url_busqueda = url_busqueda + 'centro_medico/'+centro_medico+'/';

            //if(centros)
              //  url_busqueda = url_busqueda + 'centro/'+centros+'/';
              
              //alert (centro_medico);
                            //alert (busqueda);

                
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



 $("#area").change(function(e){

   var consulta = $(this).val();

   $.ajax({
     url: '/fichas_clinicas/control_operativo/listar_areas/',
     type: 'post',
     dataType: 'json',
     data: "codigotipoarea="+consulta,
     success: function(json){

       $("#tipoarea").html(json.tipoarea);
       //$("#selectsubTipo").html(json.principal);
     }

      });
   });




 $("#con_via_aerea").change(function(e){

   var consulta = $(this).val();

   $.ajax({
     url: '/fichas_clinicas/control_operativo/listar_areas/',
     type: 'post',
     dataType: 'json',
     data: "codigotipoarea="+consulta,
     success: function(json){

       $("#con_tipo_via_aerea").html(json.tipoarea);
       //$("#selectsubTipo").html(json.principal);
     }

      });
   });


 

 /*$(document).ready(function(){
    $("#con_tipos_de_control").change(function(){
        alert("pruebaaaaaaa.");
    });
});*/

 $(document).ready(function(){
 // $("#con_tipos_de_control").change(function(){
      $("#con_tipos_de_control2").click(function(){

        //alert("pruebaaaaaaa222222222222222.");
        var consulta = $(this).val();
        var codigoficha = $('#con_ficha_clinica').val();


   $.ajax({
     url: '/fichas_clinicas/control_operativo/listar_conexiones/',
     type: 'post',
     dataType: 'json',
     //data: "codigoficha="+consulta,
          data: {codigotipo:consulta , codigoficha:codigoficha},

     success: function(json){

       $("#con_tipos_de_control").html(json.tipos_de_control);
       //$("#selectsubTipo").html(json.principal);
     }
    });
   });
});
  /*$("#con_tipos_de_control").change(function(e){

   var consulta = $(this).val();

   $.ajax({
     url: '/fichas_clinicas/control_operativo/listar_conexiones/',
     type: 'post',
     dataType: 'json',
     data: "codigoficha="+consulta,
     success: function(json){

       $("#con_tipos_de_control").html(json.tipos_de_control);
       //$("#selectsubTipo").html(json.principal);
     }

      });
   });*/
           

});
