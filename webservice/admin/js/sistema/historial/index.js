$(document).ready(function() {
	
    var base_url = $("#base_url").val();
    
	$(".deshacer").click(function(e){
		
		e.preventDefault();
		var codigo = $(this).attr('rel');

		noty({
		layout: 'topCenter',
		fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>',
		  text: '¿Está seguro que desea deshacer esta acción?',
		  buttons: [
			{addClass: 'btn btn-primary', text: 'Aceptar', onClick: function($noty) {
				$noty.close();
				$(window).unbind('beforeunload');
				
				noty({
					text: 'Procesando petición. Por favor, espere un momento.',
					layout: 'topCenter',
					type: 'alert',
					killer:true,
					closeWith: [],
					template: '<div class="noty_message"><img src="'+base_url+'/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
					fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
				});
				
				$.ajax({
					type: "POST",
					data: "codigo="+codigo,
					dataType: "json",
					url: base_url+"/historial/deshacer/",
					success: function(json){
						if(json.result){
							noty({
								text: "La acción ha sido realizada con éxito.",
								layout: 'topCenter',
								type: 'success',
								killer: true
							});
							setTimeout(function() {
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
		
	});
    
    
    /* cargar detalle de un campo */
    $(".detalle_campo").click(function(e){
        e.preventDefault();
        
        var codigo = $(this).attr('rel');
        var carga = noty({
			text: 'Cargando detalle. Por favor, espere un momento.',
			layout: 'topCenter',
			type: 'alert',
			killer:true,
			closeWith: [],
			template: '<div class="noty_message"><img src="'+base_url+'/imagenes/sitio/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
			fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
		});
		
		$.ajax({
			type: "POST",
			data: "codigo="+codigo,
			dataType: "json",
			url: base_url+"/historial/detalle_campo/",
			success: function(json){
                carga.close();
				$("#DetalleCampo .titulo_campo").html(json.titulo);
				$("#DetalleCampo #contenido_campo").html(json.contenido);
                $('#DetalleCampo').modal('show');
			}
		});
            
    });
	
});