$(function(){
var url_base = "/mantenedores/usuarios/";
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
                
                var formData = new FormData(document.getElementById("form"));
    			var URL = url_base+'process/';

    			if($('#codigo').length  > 0){
    				URL = URL + $('#codigo').val();
    			}

    			$.ajax({
    				url: URL,
    				type: 'post',
    				dataType: 'html',
    				data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
    				success: function(html){
    				    var json = jQuery.parseJSON(html);
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


	$(".eliminar").click(function(e){

		e.preventDefault();
		var codigo = $(this).attr('rel');
		noty({
		layout: 'topCenter',
		fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>',
		  text: '¿Estás seguro que desea eliminar esta registro?',
		  buttons: [
			{addClass: 'btn btn-primary', text: 'Aceptar', onClick: function($noty) {
				$noty.close();
				$(window).unbind('beforeunload');

				noty({
					text: 'El registro está siendo eliminado. Por favor, espere un momento.',
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
    
    
    $(".eliminar_archivo").click(function(e){

		e.preventDefault();
		var codigo = $(this).attr('rel');
        var obj = $(this);
        
		noty({
		layout: 'topCenter',
		fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>',
		  text: '¿Estás seguro que desea eliminar este archivo?',
		  buttons: [
			{addClass: 'btn btn-primary', text: 'Aceptar', onClick: function($noty) {
				$noty.close();
				$(window).unbind('beforeunload');

				noty({
					text: 'El archivo está siendo eliminado. Por favor, espere un momento.',
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
					url: url_base+"eliminar_archivo/",
					success: function(json){
						if(json.result){
							noty({
								text: "El archivo ha sido eliminado con éxito.",
								layout: 'topCenter',
								type: 'success',
								timeout: 3000,
								killer: true
							});
                            obj.parent().parent().remove();
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
    
    //valida rut
    $("#rut").Rut({
        on_error:function(){
            $("#rut").val('');
        }    
    });
    
    //datepicker
    $(".datepicker").datepicker({
       format:'dd/mm/yyyy',
       endDate: '0d' 
    });
    
  
    
    //cambiar contraseña
    $(".cambiar-contrasena").click(function(e){
       e.preventDefault();
       
       $(".cont-cambiar-contrasena").toggle(); 
    });
    
});