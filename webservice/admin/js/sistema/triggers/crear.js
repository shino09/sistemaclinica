$(function(){
    
    var base_url = $("#base_url").val();
    var guardar_general = false;
    var guardar_instrucciones = false;
    var enviar_formulario = false;

	 $("#form-agregar-trigger").validationEngine('attach', {
        promptPosition:'topLeft',
		validationEventTrigger:false,
        showOneMessage:true,
        prettySelect:true,
        usePrefix:"selectBox_",
	    onValidationComplete: function(form, status){
		if(status) {
            if(guardar_general){
                $(".tab-instrucciones-disabled").hide();
                $(".tab-instrucciones").show();
                $("#link-instrucciones").trigger('click');
            }
            
            if(enviar_formulario){
    			noty({
    				text: 'Creando Trigger. Por favor, espere un momento.',
    				layout: 'topCenter',
    				type: 'alert',
    				closeWith: [],
    				killer:true,
    				template: '<div class="noty_message"><img src="'+base_url+'/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
    				fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
    			});
    			
    			$.ajax({
    				url: base_url+'/triggers/crear/',
    				type: 'post',
    				dataType: 'json',
    				data: $("#form-agregar-trigger").serialize(),
    				success: function(json){
    					if(json.result){
    						noty({
    							text: "Trigger creado con éxito.",
    							layout: 'topCenter',
    							type: 'success',
    							killer: true
    						});
    
    						setTimeout(function(){
    							window.location.href = base_url+'/triggers/ver/'+json.codigo+'/';
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
            
            guardar_general = guardar_instrucciones = enviar_formulario = false;
		}
	  }
	});
    
    
    /* mostrar tab de instrucciones */
    $("#guardar-general").click(function(){
        guardar_general = true;
    });
    
    /* enviar el formulario */
    $("#enviar-form").click(function(){
        enviar_formulario = true;
    });
    
    /* bloquea tab tablas y condiciones al volver a general */
    $("#link-general").click(function(){
        $(".tab-instrucciones").hide();
        $(".tab-instrucciones-disabled").show();
        
        $("#instrucciones input").val('');
        $("#instrucciones select").val('');
        $("#instrucciones select").selectpicker('refresh');
        
        $("#cont-valores").hide();
        $("#cont-condiciones").hide();
        
        $("#tabla_campos_valores").html('');
        $("#tabla_campos_condiciones").html('');
        
        $("#cargando_valores").hide();
        $("#cargando_condiciones").hide();
    });
    
    /* carga los campos de la tabla principal para relacionar */
    $("#tabla_principal").change(function(){
       
       var tabla_principal = $(this).val();
        
        /* quita la tabla ya seleccionada como principal */
        $("#tabla_secundaria option").each(function(){
            if(tabla_principal == $(this).attr('value'))
                $(this).hide();
        });
        $("#tabla_secundaria").selectpicker('refresh');
                 
    });
    
    
    
    /* muesta las condiciones y valores */
    $("#accion_secundaria").change(function(){

        var tabla_principal = $("#tabla_principal").val();
        var tipo_principal = $("#tipo_principal").val();
        var accion_principal = $("#accion_principal").val();
        
        var tabla_secundaria = $("#tabla_secundaria").val();
        var accion_secundaria = $("#accion_secundaria").val();
        
        $("#cont-valores").hide();
        $("#cont-condiciones").hide();
        
        $("#cargando_valores").show();
        $("#cargando_condiciones").show();
        $.ajax({
			type: "POST",
			data: "tabla_principal="+tabla_principal+"&tabla_secundaria="+tabla_secundaria+"&accion_secundaria="+accion_secundaria+"&accion_principal="+accion_principal+"&tipo_principal="+tipo_principal,
			dataType: "json",
			url: base_url+"/triggers/listar_valores_condiciones/",
			success: function(json){
                if(accion_secundaria == 1 || accion_secundaria == 2){
                    $("#cont-valores").show();
                    $("#tabla_campos_valores").html(json.valores);
                }
                if(accion_secundaria == 2 || accion_secundaria == 3){
                    $("#cont-condiciones").show();
                    $("#tabla_campos_condiciones").html(json.condiciones);
                }
                $("#cargando_valores").hide();
                $("#cargando_condiciones").hide();
			}
		});
    });
});