$(function(){
    
    var base_url = $("#base_url").val();
    
	 $("#form-agregar-tabla").validationEngine('attach', {
        promptPosition:'topLeft',
		validationEventTrigger:false,
        showOneMessage:true,
	    onValidationComplete: function(form, status){
		if(status) {
			noty({
				text: 'Creando Tabla. Por favor, espere un momento.',
				layout: 'topCenter',
				type: 'alert',
				closeWith: [],
				killer:true,
				template: '<div class="noty_message"><img src="'+base_url+'/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
				fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
			});
			
			$.ajax({
				url: base_url+'/tablas/crear/',
				type: 'post',
				dataType: 'json',
				data: $("#form-agregar-tabla").serialize(),
				success: function(json){
					if(json.result){
						noty({
							text: "Tabla creada con éxito.",
							layout: 'topCenter',
							type: 'success',
							killer: true
						});

						setTimeout(function(){
							window.location.href = base_url+'/tablas/editar/'+json.codigo+'/';
						}, 1000);
					}
					else
					{
						noty({
							text: json.msg,
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
    
    /* Activar opcion de prefijo aleatorio */
    $("#nombre").change(function(){
       if($(this).val() != "")
           $("#prefijo_aleatorio").attr('disabled',false);
       else
           $("#prefijo_aleatorio").attr('disabled',true); 
    });
    
    /* mostrar prefijo disponible */
    $("#prefijo_aleatorio").click(function(){
        if($(this).is(':checked')){
            
            if($("#nombre").val() == ""){
                noty({
					text: 'Debe ingresar un nombre a la tabla',
					layout: 'topCenter',
					type: 'error',
					timeout: 3000,
					killer: true
				});
                
                return false;
            }
            
            $("#prefijo").prop('placeholder','Cargando...');
            
            $.ajax({
				url: base_url+'/tablas/crear_prefijo',
				type: 'post',
				dataType: 'json',
				data: "tabla="+$("#nombre").val(),
				success: function(json){
					if(json.result){
						$("#prefijo").val(json.prefijo);
                        $("#prefijo").attr('placeholder','');
					}
					else
					{
						noty({
							text: json.msg,
							layout: 'topCenter',
							type: 'error',
							timeout: 3000,
							killer: true
						});
                        $("#prefijo").val('');
					}
				}
			});
        }
        else{
            $("#prefijo").val('');
        }
    });
    
});