<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <title>JBB-APP</title>
	<link rel="icon" type="image/png" href="<?php echo base_url("images/favicon.ico"); ?>" />

    <!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url("assets/bootstrap/vendor/bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url("assets/bootstrap/vendor/metisMenu/metisMenu.min.css"); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("assets/bootstrap/dist/css/sb-admin-2.css"); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url("assets/bootstrap/vendor/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css">
	
    <!-- jQuery -->
    <script src="<?php echo base_url("assets/bootstrap/vendor/jquery/jquery.min.js"); ?>"></script>
	<!-- jQuery validate-->
	<script type="text/javascript" src="<?php echo base_url("assets/js/general/general.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/general/jquery.validate.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("assets/js/validate/login_candidato.js"); ?>"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body onpaste="return false">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Autenticación Candidato</h3>
                    </div>
                    <div class="panel-body">
						<?php if(isset($msj)){?>
								<div class="alert alert-danger"><span class="glyphicon glyphicon-remove">&nbsp;</span>
									<?php echo $msj;//mensaje de error ?>
								</div>
						<?php } ?>
						<form  name="form" id="form" role="form" method="post" action="<?php echo base_url("login/validateCandidato"); ?>" >

                            <fieldset>
                                <div class="form-group">
									<input type="number" id="inputLogin" name="inputLogin" class="form-control" placeholder="Numeró de Identificación" value="" required autofocus >
                                </div>

								<button type="submit" class="btn btn-lg btn-success btn-block" id='btnSubmit' name='btnSubmit'>Ingresar </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>