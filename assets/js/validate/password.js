		$( document ).ready( function () {

			$( "#form" ).validate( {
				rules: {
					inputPassword: 		{ required: true, minlength: 6, maxlength:15 },
					inputConfirm: 		{ required: true, minlength: 6, maxlength:15, equalTo: "#inputPassword" }
				},
				messages: {
					inputConfirm: {
						equalTo: "La confirmación no es igual a la contraseña."
					}
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );
					error.insertAfter( element );

				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
				},
				submitHandler: function (form) {
					return true;
				}
			});
			
			$("#btnSubmit").click(function(){		
				if ($("#form").valid() == true){
					var form = document.getElementById('form');
					form.submit();	
				}else
				{
					//alert('Error.');
				}
			});

		});