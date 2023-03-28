$( document ).ready( function () {

	var valor;
	var estudio;

	$( "#fechaInicioPr").datepicker({
		changeMonth: true,
		changeYear: true,
		maxDate: 'now',
		dateFormat: 'yy-mm-dd'
	});

	$( "#fechaFinalPr").datepicker({
		changeMonth: true,
		changeYear: true,
		maxDate: 'now',
		dateFormat: 'yy-mm-dd'
	});

	$( "#fechaInicioPu").datepicker({
		changeMonth: true,
		changeYear: true,
		maxDate: 'now',
		dateFormat: 'yy-mm-dd'
	});

	$( "#fechaFinalPu").datepicker({
		changeMonth: true,
		changeYear: true,
		maxDate: 'now',
		dateFormat: 'yy-mm-dd'
	});

	if($('#hddcbox1').val() != "" && $('#hddcbox2').val() != "" && $('#hddcbox3').val() != "" && $('#hddcbox4').val() != "") {
		valor = parseInt($('#criterioEtnias').val());
	} else {
		valor = 0;
	}

	if ($('#hddcbox5').val() != "" && $('#hddcbox6').val() != "" && $('#hddcbox7').val() != "" && $('#hddcbox8').val() != "" && $('#hddcbox9').val() != "" && $('#hddcbox10').val() != "" && $('#hddcbox11').val() != "" && $('#hddcbox12').val() != "") {
		estudio = parseFloat($('#puntajeEstudiosAdicionales').val());
	} else {
		estudio = 0;
	}

	$('#cbox1').click(function(){
		if ($('#cbox1').is(':checked') || $('#cbox2').is(':checked') || $('#cbox3').is(':checked')){
	    	document.getElementById('cbox4').disabled = true;
		} else {
	    	document.getElementById('cbox4').disabled = false;
		}
		if ($('#cbox1').is(':checked')){
			valor = valor + 3;
	    	$('#criterioEtnias').val(valor);
		} else {
			valor = valor - 3;
	    	$('#criterioEtnias').val(valor);
		}
	});

	$('#cbox2').click(function(){
		if ($('#cbox1').is(':checked') || $('#cbox2').is(':checked') || $('#cbox3').is(':checked')){
	    	document.getElementById('cbox4').disabled = true;
		} else {
	    	document.getElementById('cbox4').disabled = false;
		}
		if ($('#cbox2').is(':checked')){
			valor = valor + 3;
	    	$('#criterioEtnias').val(valor);
		} else {
			valor = valor - 3;
	    	$('#criterioEtnias').val(valor);
		}
	});

	$('#cbox3').click(function(){
		if ($('#cbox1').is(':checked') || $('#cbox2').is(':checked') || $('#cbox3').is(':checked')){
	    	document.getElementById('cbox4').disabled = true;
		} else {
	    	document.getElementById('cbox4').disabled = false;
		}
		if ($('#cbox3').is(':checked')){
			valor = valor + 3;
	    	$('#criterioEtnias').val(valor);
	    	$('#hddCriterio').val(valor);
		} else {
			valor = valor - 3;
	    	$('#criterioEtnias').val(valor);
	    	$('#hddCriterio').val(valor);
		}
	});

	$('#cbox4').click(function(){
		if ($('#cbox4').is(':checked')){
			valor = valor + 1;
	    	$('#criterioEtnias').val(valor);
	    	document.getElementById('cbox1').disabled = true;
	    	document.getElementById('cbox2').disabled = true;
	    	document.getElementById('cbox3').disabled = true;
		} else {
			valor = valor - 1;
	    	$('#criterioEtnias').val(valor);
			document.getElementById('cbox1').disabled = false;
			document.getElementById('cbox2').disabled = false;
			document.getElementById('cbox3').disabled = false;
		}
	});

	$('#cbox5').click(function(){
		if ($('#cbox5').is(':checked')){
			estudio = estudio + 0.5;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		} else {
			estudio = estudio - 0.5;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		}
	});

	$('#cbox6').click(function(){
		if ($('#cbox6').is(':checked')){
			estudio = estudio + 0.5;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		} else {
			estudio = estudio - 0.5;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		}
	});

	$('#cbox7').click(function(){
		if ($('#cbox7').is(':checked')){
			estudio = estudio + 0.5;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		} else {
			estudio = estudio - 0.5;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		}
	});

	$('#cbox8').click(function(){
		if ($('#cbox8').is(':checked')){
			estudio = estudio + 0.5;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		} else {
			estudio = estudio - 0.5;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		}
	});

	$('#cbox9').click(function(){
		if ($('#cbox9').is(':checked')){
			estudio = estudio + 1;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		} else {
			estudio = estudio - 1;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		}
	});

	$('#cbox10').click(function(){
		if ($('#cbox10').is(':checked')){
			estudio = estudio + 1.5;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		} else {
			estudio = estudio - 1.5;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		}
	});

	$('#cbox11').click(function(){
		if ($('#cbox11').is(':checked')){
			estudio = estudio + 2.5;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		} else {
			estudio = estudio - 2.5;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		}
	});

	$('#cbox12').click(function(){
		if ($('#cbox12').is(':checked')){
			estudio = estudio + 3;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		} else {
			estudio = estudio - 3;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		}
	});
	
	$( "#formPr" ).validate( {
		rules: {
			entidadPr: 			{ required: true, minlength: 2, maxlength:100 },
			fechaInicioPr: 		{ required: true },
			fechaFinalPr: 		{ required: true }
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );
			error.insertAfter( element );
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (formPr) {
			return true;
		}
	});

	$("#btnPrivado").click(function(){
		if ($("#formPr").valid() == true){
			//Activa icono guardando
			$('#btnPrivado').attr('disabled','-1');
			$("#div_error").css("display", "none");
			$("#div_load").css("display", "inline");
			$.ajax({
				type: "POST",
				url: base_url + "dashboard/save_privado",
				data: $("#formPr").serialize(),
				dataType: "json",
				contentType: "application/x-www-form-urlencoded;charset=UTF-8",
				cache: false,
				success: function(data){
					if( data.result == "error" )
					{
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$("#span_msj").html(data.mensaje);
						$('#btnPrivado').removeAttr('disabled');							
						return false;
					} 
					if( data.result )//true
					{
						console.log("id candidato " + data.idCandidato);
						$("#div_load").css("display", "none");
						$('#btnPrivado').removeAttr('disabled');
						if (data.idPuntaje == 'x') {
							cargarModalCandidato(data.idCandidato)
						} else {
							cargarModalPuntaje(data.idPuntaje)
						}
					}
					else
					{
						alert('Error. Reload the web page.');
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$('#btnPrivado').removeAttr('disabled');
					}	
				},
				error: function(result) {
					alert('Error. Reload the web page.');
					$("#div_load").css("display", "none");
					$("#div_error").css("display", "inline");
					$('#btnPrivado').removeAttr('disabled');
				}
			});
		}
	});

	$( "#formPu" ).validate( {
		rules: {
			entidadPu: 			{ required: true, minlength: 2, maxlength:100 },
			fechaInicioPu: 		{ required: true },
			fechaFinalPu: 		{ required: true }
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );
			error.insertAfter( element );
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (formPu) {
			return true;
		}
	});

	$("#btnPublico").click(function(){
		if ($("#formPu").valid() == true){
			//Activa icono guardando
			$('#btnPublico').attr('disabled','-1');
			$("#div_error").css("display", "none");
			$("#div_load").css("display", "inline");
			$.ajax({
				type: "POST",
				url: base_url + "dashboard/save_publico",
				data: $("#formPu").serialize(),
				dataType: "json",
				contentType: "application/x-www-form-urlencoded;charset=UTF-8",
				cache: false,
				success: function(data){
					if( data.result == "error" )
					{
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$("#span_msj").html(data.mensaje);
						$('#btnPublico').removeAttr('disabled');							
						return false;
					} 
					if( data.result )//true
					{
						$("#div_load").css("display", "none");
						$('#btnPublico').removeAttr('disabled');
						if (data.idPuntaje == 'x') {
							cargarModalCandidato(data.idCandidato)
						} else {
							cargarModalPuntaje(data.idPuntaje)
						}
					}
					else
					{
						alert('Error. Reload the web page.');
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$('#btnPublico').removeAttr('disabled');
					}	
				},
				error: function(result) {
					alert('Error. Reload the web page.');
					$("#div_load").css("display", "none");
					$("#div_error").css("display", "inline");
					$('#btnPublico').removeAttr('disabled');
				}
			});
		}
	});

	$(".btn-danger").click(function () {
		var oID = $(this).attr("id");
		var idCandidato = $('#hddIdCandidato').val();
		var idPuntaje = $('#hddIdPuntaje').val();
		//Activa icono guardando
		if(window.confirm('Confirma que desea eliminar el registro?'))
		{
			$(".btn-danger").attr('disabled','-1');
			$.ajax ({
				type: 'POST',
				url: base_url + 'dashboard/eliminar_registro',
				data: {'identificador': oID, 'idCandidato': idCandidato, 'idPuntaje': idPuntaje },
				cache: false,
				success: function(data){
					if( data.result == "error" )
					{
						alert(data.mensaje);
						$(".btn-danger").removeAttr('disabled');							
						return false;
					} 
					if( data.result )//true
					{	                                                        
						$(".btn-danger").removeAttr('disabled');
						if (data.idPuntaje == 'x') {
							cargarModalCandidato(data.idCandidato)
						} else {
							cargarModalPuntaje(data.idPuntaje)
						}
					}
					else
					{
						alert('Error. Reload the web page.');
						$(".btn-danger").removeAttr('disabled');
					}	
				},
				error: function(result) {
					alert('Error. Reload the web page.');
					$(".btn-danger").removeAttr('disabled');
				}
			});
		}
	});

	$( "#form" ).validate( {
		rules: {
			puntajeExperiencia: 			{ minlength: 1, maxlength:4 },
			puntajeEstudiosAdicionales: 	{ minlength: 1, maxlength:4 },
			reultadoEntrevista: 			{ minlength: 1, maxlength:2 },
			criterioEtnias: 				{ minlength: 1, maxlength:2 },
			criterioDesarrollo: 			{ minlength: 1, maxlength:2 }
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );
			error.insertAfter( element );
		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-6" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (form) {
			return true;
		}
	});
	
	$("#btnSubmit").click(function(){
		if ($("#form").valid() == true){
			if($('input.estudios[type=checkbox]:checked').length == 0) {
        		alert('Error : Asigne por lo menos una opci\u00F3n en Puntaje Estudios Adicionales.');
        	} else if($('input.criterio[type=checkbox]:checked').length == 0) {
        		alert('Error : Asigne por lo menos una opci\u00F3n en Criterio Diferencial / Inclusión.');
        	}
			else {
				//Activa icono guardando
				$('#btnSubmit').attr('disabled','-1');
				$("#div_error").css("display", "none");
				$("#div_load").css("display", "inline");
				$.ajax({
					type: "POST",
					url: base_url + "dashboard/save_puntajes",	
					data: $("#form").serialize(),
					dataType: "json",
					contentType: "application/x-www-form-urlencoded;charset=UTF-8",
					cache: false,
					success: function(data){
						if( data.result == "error" )
						{
							$("#div_load").css("display", "none");
							$("#div_error").css("display", "inline");
							$("#span_msj").html(data.mensaje);
							$('#btnSubmit').removeAttr('disabled');							
							return false;
						} 
						if( data.result )//true
						{	                                                        
							$("#div_load").css("display", "none");
							$('#btnSubmit').removeAttr('disabled');
							var url = base_url + "dashboard/detalle/" + data.idProceso;
							$(location).attr("href", url);
						}
						else
						{
							alert('Error. Reload the web page.');
							$("#div_load").css("display", "none");
							$("#div_error").css("display", "inline");
							$('#btnSubmit').removeAttr('disabled');
						}	
					},
					error: function(result) {
						alert('Error. Reload the web page.');
						$("#div_load").css("display", "none");
						$("#div_error").css("display", "inline");
						$('#btnSubmit').removeAttr('disabled');
					}
				});
			}
		}
	});
});

function cargarModalCandidato(idCandidato){
    var oID = idCandidato;
    $.ajax ({
        type: 'POST',
        url: base_url + 'dashboard/cargarModalPuntajes',
        data: {'idCandidato': oID, 'idPuntaje': 'x'},
        cache: false,
        success: function (data) {
            $('#tablaDatos').html(data);
        }
    });
}

function cargarModalPuntaje(idPuntaje){
    var oID = idPuntaje;
    $.ajax ({
        type: 'POST',
        url: base_url + 'dashboard/cargarModalPuntajes',
        data: {'idCandidato': '', 'idPuntaje': oID},
        cache: false,
        success: function (data) {
            $('#tablaDatos').html(data);
        }
    });
}