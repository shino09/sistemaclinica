$(function(){
    
    var base_url = $("#base_url").val();
    
	 $("#form-agregar-contenido").validationEngine('attach', {
        promptPosition:'topLeft',
		validationEventTrigger:false,
        showOneMessage:true,
	    onValidationComplete: function(form, status){
		if(status) {
			noty({
				text: 'Guardando. Por favor, espere un momento.',
				layout: 'topCenter',
				type: 'alert',
				closeWith: [],
				killer:true,
				template: '<div class="noty_message"><img src="'+base_url+'/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
				fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
			});
			
            var codigo_tabla = $("#codigo_tabla").val();
			$.ajax({
				url: base_url+'/contenido/insertar/'+codigo_tabla+'/',
				type: 'post',
				dataType: 'json',
				data: $("#form-agregar-contenido").serialize(),
				success: function(json){
					if(json.result){
						noty({
							text: "Contenido insertado con éxito.",
							layout: 'topCenter',
							type: 'success',
							killer: true
						});

						setTimeout(function(){
							window.location.href = base_url+'/contenido/registros/'+codigo_tabla+'/';
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
	
});