$(window).load(function () {
    $('#nombre_campo').focus();
});

$(function(){
    
    var base_url = $("#base_url").val();
    
	 $("#form-editar-tabla").validationEngine('attach', {
        promptPosition:'topLeft',
		validationEventTrigger:false,
        showOneMessage:true,
	    onValidationComplete: function(form, status){
		if(status) {
			noty({
				text: 'Actualizando Tabla. Por favor, espere un momento.',
				layout: 'topCenter',
				type: 'alert',
				closeWith: [],
				killer:true,
				template: '<div class="noty_message"><img src="'+base_url+'/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
				fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
			});
			
			$.ajax({
				url: base_url+'/tablas/editar/'+$("#codigo").val()+'/',
				type: 'post',
				dataType: 'json',
				data: $("#form-editar-tabla").serialize(),
				success: function(json){
					if(json.result){
						noty({
							text: "Tabla actualizada con éxito.",
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
    
    
    $("#form-agregar-campo").validationEngine('attach', {
        promptPosition:'topLeft',
		validationEventTrigger:false,
        showOneMessage:true,
	    onValidationComplete: function(form, status){
		if(status) {
			noty({
				text: 'Guardando Campo. Por favor, espere un momento.',
				layout: 'topCenter',
				type: 'alert',
				closeWith: [],
				killer:true,
				template: '<div class="noty_message"><img src="'+base_url+'/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
				fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
			});
			
			$.ajax({
				url: base_url+'/tablas/crear_campo/',
				type: 'post',
				dataType: 'json',
				data: $("#form-agregar-campo").serialize(),
				success: function(json){
					if(json.result){
						noty({
							text: "Campo guardado con éxito.",
							layout: 'topCenter',
							type: 'success',
							killer: true
						});
                        
                        history.pushState('estado', 'Adminitración', base_url+'/tablas/editar/'+json.codigo+'/#campos');
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
    
    /* cargar el campo en el formulario para editar */
    $(".editar_campo").click(function(){
        var codigo = $(this).attr('rel');
        
        /* agrega el nombre al formulario */
        $(".nombre_campo").each(function(){
            if(codigo == $(this).attr('rel'))
                $("#nombre_campo").val($(this).val());
        });
        
        /* agrega si es clave primaria al formulario */
        $(".campo_primaria").each(function(){
            if(codigo == $(this).attr('rel')){
                var clave_primaria = $(this).val();
                $("#clave_primaria option").each(function(){
                    if($(this).attr('value') == clave_primaria){
                        $(this).attr('selected',true);
                    }
                });
            }
        });
        $("#clave_primaria").selectpicker("refresh");
        
        
        /* agrega si es nulo al formulario */
        $(".campo_nulo").each(function(){
            if(codigo == $(this).attr('rel')){
                var nulo = $(this).val();
                $("#nulo option").each(function(){
                    if($(this).attr('value') == nulo){
                        $(this).attr('selected',true);
                    }
                });
            }
        });
        $("#nulo").selectpicker("refresh");
        
        /* agrega la longitud al formulario */
        $(".campo_longitud").each(function(){
            if(codigo == $(this).attr('rel'))
                $("#longitud").val($(this).val());
        });
        
        /* agrega el valor predeterminado al formulario */
        $(".campo_predeterminado").each(function(){
            if(codigo == $(this).attr('rel'))
                $("#valor_predeterminado").val($(this).val());
        });
        
        /* agrega el tipo de campo al formulario */
        $(".tipo_campo").each(function(){
            if(codigo == $(this).attr('rel')){
                var tipo_campo = $(this).val();
                $("#tipo_campo option").each(function(){
                    if($(this).attr('value') == tipo_campo){
                        $(this).attr('selected',true);
                    }
                        
                });
            }
        });
        $("#tipo_campo").selectpicker("refresh");
        
        var campo_relacionado = false;
        $(".relacion").each(function(){
            if(codigo == $(this).attr('rel')){
                if($(this).val() != "")
                    campo_relacionado = true;
            }
        });
        
        /* si el campo es de tipo relacion */
        if(campo_relacionado){
            
            $(".relaciones_si").show();
            
            /* se indica que es un campo relacionado*/
            $("#campo_relacionado").val(1);
            $("#campo_relacionado").selectpicker("refresh");
            
            /* se agrega la tabla relacionada */
            $(".relacion").each(function(){
                if(codigo == $(this).attr('rel')){
                    var relacion = $(this).val();
                    $("#relacion option").each(function(){
                        if($(this).attr('value') == relacion){
                            $(this).attr('selected',true);
                            tabla = $(this).attr('value');
                        }
                    });
                }
            });
            $("#relacion").selectpicker("refresh");
            
            
            /* se agrega el campo relacionado */
            var campo_relacion = '';
            $(".campo_relacion").each(function(){
                if(codigo == $(this).attr('rel')){
                    campo_relacion = $(this).val();
                }
            });
            $.ajax({
            	type: "POST",
            	data: "tabla="+tabla+"&campo_relacion="+campo_relacion,
            	dataType: "json",
            	url: base_url+"/tablas/listar_campos_tabla/",
            	success: function(json){
            	     $("#campo_relacion").html(json);
                     $("#campo_relacion").selectpicker('refresh');
            	}
            });
            
            /* se agregar el tipo de relacion */
            $(".tipo_relacion").each(function(){
                if(codigo == $(this).attr('rel')){
                    var tipo_relacion = $(this).val();
                    $("#tipo_relacion option").each(function(){
                        if($(this).attr('value') == tipo_relacion){
                            $(this).attr('selected',true);
                        }
                            
                    });
                }
            });
            $("#tipo_relacion").selectpicker("refresh");
            
        }
        else{
            
            /* se indica que no es un campo relacionado*/
            $("#campo_relacionado").val(0);
            $("#campo_relacionado").selectpicker("refresh");
            
        }
        
        /* agrega el comentario al formulario */
        $(".comentario_campo").each(function(){
            if(codigo == $(this).attr('rel'))
                $("#comentario_campo").val($(this).val());
        });
        
        /* agrega el codigo del campo */
        $("#codigo_campo").val(codigo);
        
        /* cambia el titulo del formulario para editar */
        $("#form-agregar-campo").find('h3').text('Editar Campo');
        $("#cancelar-editar").show();
        
        $('html,body').animate({
            scrollTop: $("#campos").offset().top
        }, 1000);
        
    });
    
    /* cancelar edicion */
    $("#cancelar-editar").click(function(e){
        e.preventDefault();
        window.location.reload();
    });
    
    /* eliminar campos */
    $(".eliminar_campo").click(function(e){
		
		e.preventDefault();
		var codigo = $(this).attr('rel');

		noty({
		layout: 'topCenter',
		fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>',
		  text: '¿Está seguro que desea eliminar esta registro?',
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
					template: '<div class="noty_message"><img src="'+base_url+'/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
					fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
				});
				
				$.ajax({
					type: "POST",
					data: "codigo="+codigo+"&tabla="+$("#codigo").val(),
					dataType: "json",
					url: base_url+"/tablas/eliminar_campo/",
					success: function(json){
						if(json.result){
							noty({
								text: "El registro ha sido eliminado con éxito.",
								layout: 'topCenter',
								type: 'success',
								killer: true
							});
							history.pushState('estado', 'Adminitración', base_url+'/tablas/editar/'+json.codigo+'/#campos');
    						setTimeout(function(){
    							window.location.reload();
    						}, 1000);
						} 
						else
						{
						  
                            if(json.confirmar){
                                noty({
                            		layout: 'topCenter',
                                    killer: true,
                            		fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>',
                            		  text: json.msg,
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
                            					template: '<div class="noty_message"><img src="'+base_url+'/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
                            					fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
                            				});
                            				
                            				$.ajax({
                            					type: "POST",
                            					data: "codigo="+codigo+"&tabla="+$("#codigo").val()+"&confirmado=1",
                            					dataType: "json",
                            					url: base_url+"/tablas/eliminar_campo/",
                            					success: function(json){
                            						if(json.result){
                            							noty({
                            								text: "El registro ha sido eliminado con éxito.",
                            								layout: 'topCenter',
                            								type: 'success',
                            								killer: true
                            							});
                            							history.pushState('estado', 'Adminitración', base_url+'/tablas/editar/'+json.codigo+'/#campos');
                                						setTimeout(function(){
                                							window.location.reload();
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
                            }
                            else{
    							var error = noty({
    								text: json.msg,
    								layout: 'topCenter',
    								type: 'error',
    								timeout: 2000
    							});
                            }
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
    
    
    /* mostrar campos para relaciones */
    $(".relaciones").click(function(){
       var codigo = $(this).val();
       var obj = $(this);
        $(".cont-relaciones").each(function(){
            if($(this).attr('rel') == codigo){
                $(this).find('input').val('');
                $(this).find('select option').attr('selected',false);
                $(this).find('select').selectpicker("refresh");
                $(this).toggle('slow');
            }
        });
    });
	
    /* mostrar opciones para campos relacionados */
    $("#campo_relacionado").change(function(){
        $(".relaciones").find('select').val('');
        $(".relaciones").find('select').selectpicker('refresh');
        $(".relaciones").find('input').val('');
        $(".relaciones").toggle();
    });
    
    
    /* carga los campos de la tabla seleccionada para relacionar */
    $("#relacion").change(function(){
       
       $("#campo_relacion").html("<option value=''>Cargando...</option>");
       $("#campo_relacion").selectpicker('refresh');
                 
       var tabla = $(this).val();
       $.ajax({
			type: "POST",
			data: "tabla="+tabla,
			dataType: "json",
			url: base_url+"/tablas/listar_campos_tabla/",
			success: function(json){
			     $("#campo_relacion").html(json);
                 $("#campo_relacion").selectpicker('refresh');
			}
		});
                 
    });
    
    /* muestra la opcion galeria para las imagenes y archivos */
    $(".galerias").change(function(){
       if($(this).val() == 1){
            if($(this).is(':checked')){
                $("#cont-archivos").hide('slow');
                $("#cont-imagenes").show('slow'); 
            }
            else{
                $("#cont-archivos").hide('slow');
                $("#cont-imagenes").hide('slow'); 
            }
       }
       else{
            if($(this).is(':checked')){
                $("#cont-imagenes").hide('slow');
                $("#cont-archivos").show('slow');
            }
            else{
                $("#cont-imagenes").hide('slow');
                $("#cont-archivos").hide('slow');
            }
       }
    });
    
    /* guardar galerias */
    $("#form-agregar-galerias").validationEngine('attach', {
        promptPosition:'topLeft',
		validationEventTrigger:false,
        showOneMessage:true,
	    onValidationComplete: function(form, status){
		if(status) {
			noty({
				text: 'Guardando Galerías. Por favor, espere un momento.',
				layout: 'topCenter',
				type: 'alert',
				closeWith: [],
				killer:true,
				template: '<div class="noty_message"><img src="'+base_url+'/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
				fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
			});
			
			$.ajax({
				url: base_url+'/tablas/crear_galerias/',
				type: 'post',
				dataType: 'json',
				data: $("#form-agregar-galerias").serialize(),
				success: function(json){
					if(json.result){
						noty({
							text: "Galerías guardadas con éxito.",
							layout: 'topCenter',
							type: 'success',
							killer: true
						});
                        
                        history.pushState('estado', 'Adminitración', base_url+'/tablas/editar/'+json.codigo+'/#galerias');
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
});