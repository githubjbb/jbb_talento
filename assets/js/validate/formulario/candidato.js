$( document ).ready( function () {
			
	$("#firstName").bloquearNumeros().maxlength(25);
	$("#lastName").bloquearNumeros().maxlength(25);		
	$("#numeroIdentificacion").bloquearTexto().maxlength(12);
	$("#movilNumber").bloquearTexto().maxlength(12);
	$("#firstName").convertirMayuscula();
	$("#lastName").convertirMayuscula();
	$("#profesion").convertirMayuscula();
	
	$( "#form" ).validate( {
		rules: {
			firstName: 					{ required: true, minlength: 3, maxlength:25 },
			lastName: 					{ required: true, minlength: 3, maxlength:25 },
			numeroIdentificacion: 		{ required: true, minlength: 4, maxlength:12 },
			email: 						{ required: true, email: true },
			movilNumber: 				{ required: true, minlength: 4, maxlength:10 },
			nivelAcademico: 			{ required: true },
			depto:						{ required: true },
			mcpio:						{ required: true },
			profesion: 					{ required: true, minlength: 4, maxlength:50 }
		},
		errorElement: "em",
		errorPlacement: function ( error, element ) {
			// Add the `help-block` class to the error element
			error.addClass( "help-block" );
			error.insertAfter( element );

		},
		highlight: function ( element, errorClass, validClass ) {
			$( element ).parents( ".col-sm-4" ).addClass( "has-error" ).removeClass( "has-success" );
		},
		unhighlight: function (element, errorClass, validClass) {
			$( element ).parents( ".col-sm-4" ).addClass( "has-success" ).removeClass( "has-error" );
		},
		submitHandler: function (form) {
			return true;
		}
	});
						
	$("#btnSubmit").click(function(){		
	
		if ($("#form").valid() == true){
		
				//Activa icono guardando
				$('#btnSubmit').attr('disabled','-1');
				$("#div_load").css("display", "inline");
				$("#div_error").css("display", "none");
			
				$.ajax({
					type: "POST",	
					url: base_url + "formulario/save_candidato",
					data: $("#form").serialize(),
					dataType: "json",
					contentType: "application/x-www-form-urlencoded;charset=UTF-8",
					cache: false,
					
					success: function(data){
                                            
						if( data.result == "error" )
						{
							alert(data.mensaje);
							$("#div_load").css("display", "none");
							$('#btnSubmit').removeAttr('disabled');							
							
							$("#span_msj").html(data.mensaje);
							$("#div_error").css("display", "inline");
							return false;
						} 

						if( data.result )//true
						{	                                                        
							$("#div_load").css("display", "none");
							$('#btnSubmit').removeAttr('disabled');

							var url = base_url + "formulario";
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
		
		}//if			
		else
		{
			alert('Faltan campos por diligenciar.');
			
		}					
	});

});