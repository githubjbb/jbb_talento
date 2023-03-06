$( document ).ready( function () {

	var valor;
	var estudio;

	if($('#hddcbox1').val() != "" && $('#hddcbox2').val() != "" && $('#hddcbox3').val() != "" && $('#hddcbox4').val() != "") {
		valor = parseInt($('#criterioEtnias').val());
	} else {
		valor = 0;
	}

	if ($('#hddcbox5').val() != "" && $('#hddcbox6').val() != "" && $('#hddcbox7').val() != "" && $('#hddcbox8').val() != "") {
		estudio = parseInt($('#puntajeEstudiosAdicionales').val());
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
			estudio = estudio + 1;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		} else {
			estudio = estudio - 1;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		}
	});

	$('#cbox6').click(function(){
		if ($('#cbox6').is(':checked')){
			estudio = estudio + 2;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		} else {
			estudio = estudio - 2;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		}
	});

	$('#cbox7').click(function(){
		if ($('#cbox7').is(':checked')){
			estudio = estudio + 3;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		} else {
			estudio = estudio - 3;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		}
	});

	$('#cbox8').click(function(){
		if ($('#cbox8').is(':checked')){
			estudio = estudio + 4;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		} else {
			estudio = estudio - 4;
	    	$('#puntajeEstudiosAdicionales').val(estudio);
		}
	});
	
	$( "#form" ).validate( {
		rules: {
			puntajeExperiencia: 			{ minlength: 1, maxlength:2 },
			puntajeEstudiosAdicionales: 	{ minlength: 1, maxlength:2 },
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
		
		}//if			
	});
});