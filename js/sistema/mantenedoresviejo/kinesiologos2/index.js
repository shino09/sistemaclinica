$(function(){

var url_base = "/mantenedores/kinesiologos2/";

//alert(url_base);

	$("#filtrar").click(function(){
		var url_busqueda = url_base;
		var estado = $("#estado").val();
		var buscar = $("#buscar").val();


		if(estado!=""){
			
			url_busqueda = url_busqueda + "estado/" + estado + "/";
		}


		if(buscar!=""){
			
			url_busqueda = url_busqueda + "buscar/" + buscar + "/";
		}

		window.location.href =url_busqueda;
});


		$("#filtrar").click(function(){
		var url_busqueda = url_base;
		var estado = $("#estado").val();
		var buscar = $("#buscar").val();


		if(estado!=""){
			
			url_busqueda = url_busqueda + "estado/" + estado + "/";
		}


		if(buscar!=""){
			
			url_busqueda = url_busqueda + "buscar/" + buscar + "/";
		}

		



		
		window.location.href =url_busqueda;
});


	
});
