$(function(){
    
    var base_url = $("#base_url").val();
    var guardar_general = false;
    var guardar_tablas = false;
    var enviar_formulario = false;

	 $("#form-agregar-vista").validationEngine('attach', {
        promptPosition:'topLeft',
		validationEventTrigger:false,
        showOneMessage:true,
        prettySelect:true,
        usePrefix:"selectBox_",
	    onValidationComplete: function(form, status){
		if(status) {
            if(guardar_general){
                $(".tab-tablas-disabled").hide();
                $(".tab-tablas").show();
                $("#link-tablas").trigger('click');
            }
            
            if(guardar_tablas){
                $(".tab-condiciones-disabled").hide();
                $(".tab-condiciones").show();
                $("#link-condiciones").trigger('click');
            }
            
            if(enviar_formulario){
    			noty({
    				text: 'Creando Vista. Por favor, espere un momento.',
    				layout: 'topCenter',
    				type: 'alert',
    				closeWith: [],
    				killer:true,
    				template: '<div class="noty_message"><img src="'+base_url+'/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
    				fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
    			});
    			
    			$.ajax({
    				url: base_url+'/vistas/crear/',
    				type: 'post',
    				dataType: 'json',
    				data: $("#form-agregar-vista").serialize(),
    				success: function(json){
    					if(json.result){
    						noty({
    							text: "Vista creada con éxito.",
    							layout: 'topCenter',
    							type: 'success',
    							killer: true
    						});
    
    						setTimeout(function(){
    							window.location.href = base_url+'/vistas/ver/'+json.codigo+'/';
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
            
            guardar_general = guardar_tablas = enviar_formulario = false;
		}
	  }
	});
    
    
    /* mostrar tab de tablas */
    $("#guardar-general").click(function(){
        guardar_general = true;
    });
    
    /* mostrar tab de condiciones */
    $("#guardar-tablas").click(function(){
        guardar_tablas = true;
    });
    
    /* enviar el formulario */
    $("#enviar-form").click(function(){
        enviar_formulario = true;
    });
    
    /* bloquea tab tablas y condiciones al volver a general */
    $("#link-general").click(function(){
        $(".tab-tablas").hide();
        $(".tab-tablas-disabled").show();
        
        $(".tab-condiciones").hide();
        $(".tab-condiciones-disabled").show();
    });
    
    /* bloquea tab condiciones al volver a tablas */
    $("#link-tablas").click(function(){
        $(".tab-condiciones").hide();
        $(".tab-condiciones-disabled").show();
    });
    
    /* mostrar campos para relaciones */
    $(".tablas").click(function(){
        var tabla = $(this).val();
        var obj = $(this);
        $(this).parent().siblings('.cont-campos').find('input[type="checkbox"]').attr('checked',false);
        $(this).parent().siblings('.cont-campos').find('select').val('');
        $(this).parent().siblings('.cont-campos').find('select').selectpicker('refresh');
        $(this).parent().siblings('.cont-campos').toggle('slow');
        
        /* muestra las tablas para las condiciones */
        $("#tablas_condiciones option").each(function(){
            if($(this).attr('value') == tabla)
                if(obj.is(':checked'))
                    $(this).show();
                else
                    $(this).hide();
        });
        $("#tablas_condiciones").selectpicker('refresh');
    });
    
    /* carga los campos de la tabla principal para relacionar */
    $("#tabla_principal").change(function(){
       
       $("#campos_tabla_principal").html("<option value=''>Cargando...</option>");
       $("#campos_tabla_principal").selectpicker('refresh');
                 
       var tabla = $(this).val();
       $.ajax({
			type: "POST",
			data: "tabla="+tabla,
			dataType: "json",
			url: base_url+"/vistas/listar_campos_tabla/",
			success: function(json){
			     $("#campos_tabla_principal").html(json);
                 $("#campos_tabla_principal").selectpicker('refresh');
                 $(".cont-tablas").show('slow');
                 $(".tablas").each(function(){
                    if($(this).val() == tabla){
                        $(this).attr('checked',false);
                        $(this).parent().siblings('.cont-campos').find('input[type="checkbox"]').attr('checked',false);
                        $(this).parent().siblings('.cont-campos').find('select').val('');
                        $(this).parent().siblings('.cont-campos').find('select').selectpicker('refresh');
                        $(this).parent().siblings('.cont-campos').hide('slow');
                        $(this).parent().parent().hide('slow');
                    }
                 });
			}
		});
        
        /* quita todas las tablas que no se esten checkeadas antes de agregar la seleccionada */
        $("#tablas_condiciones option").each(function(){
            var t = $(this);
            var mantener = false;
            $(".tablas").each(function(){
                if($(this).is(':checked')){
                    if($(this).attr('value') == t.val())
                        mantener = true;
                }
            });
            if(!mantener)
                t.hide();
        });

        /* muestra las tablas para las condiciones */
        $("#tablas_condiciones option").each(function(){
            if($(this).attr('value') == tabla)
                $(this).show();
        });
        $("#tablas_condiciones").selectpicker('refresh');
                 
    });
    
    /* indica que campos debo mostrar al agregar condiciones */
    $("#campos_tabla_principal").change(function(){
        $("#campos_tabla_principal option").each(function(){
           var campo = $(this).attr('value');
           $("#campos_permitidos input").each(function(){
                if($(this).val() == campo)
                    $(this).remove();
           });
        });
            
        if($(this).val() != ""){
            var campos = $(this).val().toString().split(',');
            for(var i=0; i < campos.length; i++){
                campo = campos[i];
                var agregar = true;
                $("#campos_permitidos input").each(function(){
                    if($(this).val() == campo)
                        agregar = false;
                });
                
                if(agregar){
                    $("#campos_permitidos").append('<input type="hidden" class="campos_permitidos" name="campos_permitidos[]" value="'+campo+'" />');
                }
            }
        }
    });
    
    /* indica que campos debo mostrar al agregar condiciones */
    $(".campos_tablas").change(function(){
        if($(this).is(':checked')){
            var campo = $(this).val();
            var agregar = true;
            $("#campos_permitidos input").each(function(){
                if($(this).val() == campo)
                    agregar = false;
            });
            
            if(agregar){
                $("#campos_permitidos").append('<input type="hidden" class="campos_permitidos" name="campos_permitidos[]" value="'+campo+'" />');
            }
        }
        else{
            var campo = $(this).val();
            $("#campos_permitidos input").each(function(){
                if($(this).val() == campo)
                    $(this).remove();
            });
        }
    });
    
    
    /* trae los campos para las condiciones */
    $("#tablas_condiciones").change(function(){

        var tabla = $(this).val();
        var campos = [],campos_condiciones = [],condiciones = [],valores_condiciones = [];
        $("#campos_permitidos input").each(function(i){
            campos[i] = $(this).val();
        });
        
        var i = 0,j = 0, k = 0;
        $("#campos_condiciones input").each(function(){
            if($(this).attr('class') == tabla){
                if($(this).attr('name') == "campos_condiciones[]"){
                    campos_condiciones[i] = $(this).val();
                    i++;
                }
                else if($(this).attr('name') == "condiciones[]"){
                    condiciones[j] = $(this).val();
                    j++;
                }
                else if($(this).attr('name') == "valores_condiciones[]"){
                    valores_condiciones[k] = $(this).val();
                    k++;
                }
            }
        });
        
        $("#cargando_condiciones").show();
        $.ajax({
			type: "POST",
			data: "tabla="+tabla+"&campos="+campos+"&campos_condiciones="+campos_condiciones+"&condiciones="+condiciones+"&valores_condiciones="+valores_condiciones,
			dataType: "json",
			url: base_url+"/vistas/listar_campos_condiciones/",
			success: function(json){
                $("#tabla_campos_condiciones").html(json);
                $("#cargando_condiciones").hide();
			}
		});
    });
    
    /* guarda las condiciones */
    $("#condiciones").on('click','#guardar-condiciones',function(){
        var tabla = $("#tablas_condiciones").val();
        
        /* elimina las condiciones de la tabla antes de volver a agregarlas */
        $("#campos_condiciones input").each(function(){
            if($(this).attr('class') == tabla){
                $(this).remove();
            }
        });
        
        $(".valores_condiciones").each(function(i){
            var agregar = false;
            var valor = $(this).val();
            var condicion = $(this).parent().parent().find(".condiciones").val();
            /* si el campo valor no es vacio o si la condicion no acepta valor */
            if($(this).val() != "")
                agregar = true;
            else{
                /* revisa si es que la condicion no acepta un valor */
                $(".condiciones_general").each(function(){
                    if($(this).val() == condicion)
                        if($(this).attr('rel') == 0){
                            agregar = true;
                            valor = "";
                        }
                });
            }
            
            if(agregar){
                var campo = $(this).parent().parent().find(".campos_condiciones").val();
                $("#campos_condiciones .campos").each(function(){
                if($(this).val() == campo)
                    $(this).remove();
                });
                
                $("#campos_condiciones .condiciones").each(function(){
                    if($(this).attr('rel') == campo)
                        $(this).remove();
                });
                
                $("#campos_condiciones .valores").each(function(){
                    if($(this).attr('rel') == campo)
                        $(this).remove();
                });
                
                $("#campos_condiciones").append('<input type="hidden" class="'+tabla+'" name="campos_condiciones[]" value="'+campo+'" />');
                $("#campos_condiciones").append('<input type="hidden" class="'+tabla+'" name="condiciones[]" rel="'+campo+'" value="'+condicion+'" />');
                $("#campos_condiciones").append('<input type="hidden" class="'+tabla+'" name="valores_condiciones[]" rel="'+campo+'" value="'+valor+'" />');
            }
        });
        
        noty({
    		text: "Condiciones guardadas con éxito.",
    		layout: 'topCenter',
    		type: 'success',
            timeout: 1000,
    		killer: true
    	});
        
        $("#tabla_campos_condiciones").html("");
        $("#tablas_condiciones").val('');
        $("#tablas_condiciones").selectpicker('refresh');
        
    });
});