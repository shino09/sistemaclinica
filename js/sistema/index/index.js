 $(function(){
    /* formatear valor */
    $(".valor").change(function(){
		$(this).val(format($(this).val()));
	});
    
    //solicitar perfil
    $("#form-solicitar-perfil").validationEngine('attach', {
	    onValidationComplete: function(form, status){
            if(status) {
    			noty({
    				text: 'Solicitando perfil. Por favor, espere un momento.',
    				layout: 'topCenter',
    				closeWith: [],
    				type: 'alert',
    				killer:true,
    				template: '<div class="noty_message"><img src="/imagenes/icons/ajax-loader.gif">&nbsp;&nbsp;<span class="noty_text"></span><div class="noty_close"></div></div>',
    				fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>'
    			});

    			$.ajax({
    				url: '/inicio/solicitar_perfil/',
    				type: 'post',
    				dataType: 'json',
    				data: form.serialize(),
    				success: function(json){
    					if(json.result){
    						noty({
    							text: "Solicitud de perfil realizada con éxito",
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
    						noty({
    							text: json.msg,
    							layout: 'topCenter',
    							type: 'error',
    							killer: true
    						});
    					}
    				}
    			});
            }
        }
	});
    
    
    //aprobar perfil
    $("#aprobar_perfil").click(function(e){

		e.preventDefault();
		var codigo = $(this).attr('rel');
		
        noty({
		layout: 'topCenter',
		fondo: '<div id="fondo" style=" position: fixed; top:0; height: 100%; width:100%; background-color: rgba(60, 56, 56, 0.38); display:block;z-index: 9999;"></div>',
		  text: '¿Est&aacute;s seguro que desea eliminar esta registro?',
		  buttons: [
			{addClass: 'btn btn-primary', text: 'Aceptar', onClick: function($noty) {
				$noty.close();
				$(window).unbind('beforeunload');

				noty({
					text: 'Aprobando perfil. Por favor, espere un momento.',
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
					url: '/inicio/aprobar_perfil/',
					success: function(json){
						if(json.result){
							noty({
								text: "Solicitud de perfil aprobada con éxito",
								layout: 'topCenter',
								type: 'success',
								timeout: 3000,
								killer: true
							});
                            
							setTimeout(function() {
    							window.location.href = "/escritorio/";
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
    
});

function format(input)
{
    var partes = input.toString().split('.');
    input = partes[0];
	var num = input.toString().replace(/\./g,'');
    console.log(num);
	//num = input.toString().replace(/\./g,'');
    if(!isNaN(num)){
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        if(typeof partes[1] != 'undefined'){
            num += ','+partes[1];
        }
        return num;
    }
    return '';
}