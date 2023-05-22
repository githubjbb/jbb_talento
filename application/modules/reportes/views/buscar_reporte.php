<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
$(document).ready(function () {
	$(function() {
        $("#fecha_desde").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            maxDate: 'now'
        });
    });
    $(function() {
        $("#fecha_hasta").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            maxDate: 'now'
        });
    });
});
</script>

<div id="page-wrapper">
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="list-group-item-heading">
						<i class="fa fa-list-alt fa-fw"></i> Buscar Reporte X Fechas
					</h4>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<form  name="form" id="form" class="form-horizontal" method="post" action="<?php echo base_url("reportes/descargarReporteGeneral"); ?>" >
						<div class="row">
							<div class="col-sm-3"></div>
                            <div class="col-sm-3">
                                <p class="text-left"><strong>Desde:</strong></p>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" id="fecha_desde" name="fecha_desde" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <p class="text-left"><strong>Hasta:</strong></p>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" id="fecha_hasta" name="fecha_hasta" class="form-control" required />
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="form-group">
							<div class="row" align="center">
								<div style="width:50%;" align="center">
									<button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary" >
										Buscar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
									</button> 
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>