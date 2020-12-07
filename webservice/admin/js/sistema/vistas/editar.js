$(function(){
    
    var base_url = $("#base_url").val();
    
	 $("#form-editar-vista").validationEngine('attach', {
        promptPosition:'topLeft',
		validationEventTrigger:false,
        showOneMessage:true,
	    onValidationComplete: function(form, status){
		if(status) {
			noty({
				text: 'Actualizando Vista. Por favor, espere un momento.',
				layout: 'topCenter',
				type: 'alert',
				closeWith: [],
				killer:true,
				template: '<div class="noty_message"><img src="'+base_url+'/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
				fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
			});
			
			$.ajax({
				url: base_url+'/vista/editar/'+$("#codigo").val()+'/',
				type: 'post',
				dataType: 'json',
				data: $("#form-editar-vista").serialize(),
				success: function(json){
					if(json.result){
						noty({
							text: "Vista actualizada con éxito.",
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
    
    
    $("#form-agregar-tablas").validationEngine('attach', {
        promptPosition:'topLeft',
		validationEventTrigger:false,
        showOneMessage:true,
	    onValidationComplete: function(form, status){
		if(status) {
			noty({
				text: 'Guardando Tablas. Por favor, espere un momento.',
				layout: 'topCenter',
				type: 'alert',
				closeWith: [],
				killer:true,
				template: '<div class="noty_message"><img src="'+base_url+'/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
				fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
			});
			
			$.ajax({
				url: base_url+'/vistas/crear_sql/',
				type: 'post',
				dataType: 'json',
				data: $("#form-agregar-tablas").serialize(),
				success: function(json){
					if(json.result){
						noty({
							text: "Tablas guardadas con éxito.",
							layout: 'topCenter',
							type: 'success',
							killer: true
						});
                        
                        history.pushState('estado', 'Adminitración', base_url+'/vistas/editar/'+json.codigo+'/#tablas');
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
    
    
    /* mostrar campos para relaciones */
    $(".tablas").click(function(){
        $(this).parent().siblings('.cont-campos').find('input[type="checkbox"]').attr('checked',false);
        $(this).parent().siblings('.cont-campos').find('select').val('');
        $(this).parent().siblings('.cont-campos').find('select').selectpicker('refresh');
        $(this).parent().siblings('.cont-campos').toggle('slow');
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
                 
    });
  
});