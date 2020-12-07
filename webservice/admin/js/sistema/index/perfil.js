$(function(){
	
	$("#form-perfil").validationEngine('attach', {
        promptPosition:'topLeft',
		validationEventTrigger:false,
        showOneMessage:true,
	    onValidationComplete: function(form, status){
		if(status) {
			noty({
				text: 'Actualizando sus datos. Por favor, espere un momento.',
				layout: 'topCenter',
				type: 'alert',
				closeWith: [],
				killer:true,
				template: '<div class="noty_message"><img src="/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
				fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
			});
			
			$.ajax({
				url: '/perfil/',
				type: 'post',
				dataType: 'json',
				data: $("#form-perfil").serialize(),
				success: function(json){
					if(json.result){
						noty({
							text: "Sus datos han sido actualizados con éxito.",
							layout: 'topCenter',
							type: 'success',
							killer: true
						});

						setTimeout(function(){
							window.location.reload();
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
	
	$("#ver-contrasena").change(function(){
		if ($(this).is(':checked'))
			$('#contrasena').attr('type', 'text');
		else
			$('#contrasena').attr('type', 'password');
	});
	
	
	/* cambiar contraseña */
	$("#cambiar-contrasena").click(function(e){
		e.preventDefault();
		$("#cont-cambiar").hide();
		$("#cont-contrasena").show();
	});
	
	$("#cancelar-contrasena").click(function(e){
		e.preventDefault();
		$("#contrasena").val('');
		$("#re-contrasena").val('');
		$("#cont-contrasena").hide();
		$("#cont-cambiar").show();
		$("#ver-contrasena").attr('checked',false);
	});

});