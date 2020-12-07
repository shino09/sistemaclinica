$(function(){
    
    var base_url = $("#base_url").val();
	 $("#form-editar-usuario").validationEngine('attach', {
        promptPosition:'topLeft',
		validationEventTrigger:false,
        showOneMessage:true,
        prettySelect:true,
        usePrefix:"selectBox_",
	    onValidationComplete: function(form, status){
		if(status) {
            
			noty({
				text: 'Actualizando usuario. Por favor, espere un momento.',
				layout: 'topCenter',
				type: 'alert',
				closeWith: [],
				killer:true,
				template: '<div class="noty_message"><img src="'+base_url+'/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
				fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
			});
			
			$.ajax({
				url: base_url+'/usuarios/editar/'+$("#codigo").val()+'/',
				type: 'post',
				dataType: 'json',
				data: $("#form-editar-usuario").serialize(),
				success: function(json){
					if(json.result){
						noty({
							text: "Usuario actualizado con éxito.",
							layout: 'topCenter',
							type: 'success',
							killer: true
						});

						setTimeout(function(){
							window.location.href = base_url+'/usuarios/';
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

    /* muestra u oculta los campos para cambiar contraseña */
    $("#btn-cambiarC").click(function(e){
        e.preventDefault();
        
        $(this).parent().parent().hide();
        $("#cambiar-contrasena").toggle();
    });
    
    $("#btn-cancelarC").click(function(e){
        e.preventDefault();
        
        $("#btn-cambiarC").parent().parent().show();
        $("#cambiar-contrasena").toggle();
    });
    
    /* habilita los permisos para los campos segun la seleccion de permiso de la tabla */
    $(".permisos_tabla").change(function(){
        if($(this).val() && $(this).val() != 4){
            var codigos = $(this).val().toString().split(',');
            var value = $(this).val();
            $(this).parent().parent().parent().parent().siblings().find('.tablas').prop('checked',true);
            $(this).parent().parent().siblings().find('.campos').attr('disabled',false);
            $(this).parent().parent().siblings().find(".permisos_campo option").each(function(){
                $(this).hide();
                var permiso = $(this).val();
                for(var i = 0; i <= codigos.length; i++){
                    if(codigos[i] == permiso)
                        $(this).show();
                }
            });
            $(this).parent().parent().siblings().find('.campos').prop('checked',true);
            $(this).parent().parent().siblings().find(".permisos_campo").val(value);
        }
        else{
            $(this).parent().parent().parent().parent().siblings().find('.tablas').prop('checked',false);
            $(this).parent().parent().siblings().find('.campos').prop('checked',false);
            $(this).parent().parent().siblings().find('.campos').attr('disabled',true);
            $(this).parent().parent().siblings().find(".permisos_campo").val('');
            $(this).parent().parent().siblings().find(".permisos_campo option").each(function(){
                $(this).hide();
            });
        }
        
        $(this).parent().parent().siblings().find('.permisos_campo').selectpicker('refresh');  
    });
    
    $(".permisos_campo").change(function(){
        if($(this).val())
            $(this).parent().siblings().find('.campos').prop('checked',true);
        else
            $(this).parent().siblings().find('.campos').prop('checked',false);
        
    });
    
    $(".campos").change(function(){
        $(this).parent().parent().siblings().find('.permisos_campo').val('');
        $(this).parent().parent().siblings().find('.permisos_campo').selectpicker('refresh');
    });
});