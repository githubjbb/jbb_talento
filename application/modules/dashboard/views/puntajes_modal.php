<script type="text/javascript" src="<?php echo base_url("assets/js/validate/dashboard/puntajes.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Puntajes del Candidato
	<br><small>Adicionar/Editar Puntajes</small>
	</h4>
</div>

<div class="modal-body">
	<form name="form" id="form" role="form" method="post" >
		<input type="hidden" id="hddIdCandidato" name="hddIdCandidato" value="<?php echo $idCandidato; ?>"/>
		<input type="hidden" id="hddIdPuntaje" name="hddIdPuntaje" value="<?php echo $infoPuntajes?$infoPuntajes[0]['id_puntaje']:""; ?>" />
		<input type="hidden" id="hddcbox1" name="hddcbox1" value="<?php echo $infoPuntajes?$infoPuntajes[0]['etnias']:""; ?>" />
		<input type="hidden" id="hddcbox2" name="hddcbox2" value="<?php echo $infoPuntajes?$infoPuntajes[0]['lgtbi']:""; ?>" />
		<input type="hidden" id="hddcbox3" name="hddcbox3" value="<?php echo $infoPuntajes?$infoPuntajes[0]['discapacidad']:""; ?>" />
		<input type="hidden" id="hddcbox4" name="hddcbox4" value="<?php echo $infoPuntajes?$infoPuntajes[0]['na']:""; ?>" />
		<input type="hidden" id="hddcbox5" name="hddcbox5" value="<?php echo $infoPuntajes?$infoPuntajes[0]['universitario']:""; ?>" />
		<input type="hidden" id="hddcbox6" name="hddcbox6" value="<?php echo $infoPuntajes?$infoPuntajes[0]['especializacion']:""; ?>" />
		<input type="hidden" id="hddcbox7" name="hddcbox7" value="<?php echo $infoPuntajes?$infoPuntajes[0]['maestria']:""; ?>" />
		<input type="hidden" id="hddcbox8" name="hddcbox8" value="<?php echo $infoPuntajes?$infoPuntajes[0]['doctorado']:""; ?>" />
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="puntajeExperiencia">Puntaje Experiencia Profesional: </label>
					<input type="number" max="70" id="puntajeExperiencia" name="puntajeExperiencia" class="form-control" value="<?php echo $infoPuntajes?$infoPuntajes[0]["puntaje_experiencia"]:""; ?>" placeholder="Puntaje Experiencia Profesional" >
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
						<small><br>
							<p class="text-danger text-left">Hasta 70 por la escala máxima establecida.
								<br>Puntaje sobre 20%
							</p>
						</small>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="puntajeEstudiosAdicionales">Puntaje Estudios Adicionales: </label>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox5" name="cbox5" class="estudios" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["universitario"] == 1) { ?> checked <?php } ?>> Universitario</label>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox6" name="cbox6" class="estudios" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["especializacion"] == 1) { ?> checked <?php } ?>> Especialización</label>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox7" name="cbox7" class="estudios" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["maestria"] == 1) { ?> checked <?php } ?>> Maestría</label>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox8" name="cbox8" class="estudios" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["doctorado"] == 1) { ?> checked <?php } ?>> Doctorado</label>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group text-left">
					<input type="number" max="10" id="puntajeEstudiosAdicionales" name="puntajeEstudiosAdicionales" class="form-control" value="<?php echo $infoPuntajes?$infoPuntajes[0]["puntaje_adicionales"]:""; ?>" placeholder="Puntaje Estudios Adicionales" readOnly>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
						<small><br>
							<p class="text-danger text-left">Hasta 10 por la escala máxima establecida.
								<br>Puntaje sobre 10%
							</p>
						</small>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="reultadoEntrevista">Resultado Entrevista: </label>
					<input type="number" max="80" id="reultadoEntrevista" name="reultadoEntrevista" class="form-control" value="<?php echo $infoPuntajes?$infoPuntajes[0]["resultado_entrevista"]:""; ?>" placeholder="Resultado Entrevista" >
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group text-left">
						<small><br>
							<p class="text-danger text-left">Hasta 80 por la escala máxima establecida.
								<br>Puntaje sobre 30%
							</p>
						</small>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="criterioEtnias">Criterio Diferencial / Inclusión: </label>
				</div>
			</div>

			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox1" name="cbox1" class="criterio" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["etnias"] == 1) { ?> checked <?php } ?> <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["na"] == 1) { ?> disabled <?php } ?>> Etnias</label>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox2" name="cbox2" class="criterio" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["lgtbi"] == 1) { ?> checked <?php } ?> <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["na"] == 1) { ?> disabled <?php } ?>> LGTBI</label>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox3" name="cbox3" class="criterio" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["discapacidad"] == 1) { ?> checked <?php } ?> <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["na"] == 1) { ?> disabled <?php } ?>> Discapacidad</label>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox4" name="cbox4" class="criterio" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["na"] == 1) { ?> checked <?php } ?> <?php if(!empty($infoPuntajes) && ($infoPuntajes[0]["etnias"] == 1 || $infoPuntajes[0]["lgtbi"] == 1 || $infoPuntajes[0]["discapacidad"] == 1)) { ?> disabled <?php } ?>> N/A</label>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group text-left">
					<input type="number" max="10" id="criterioEtnias" name="criterioEtnias" class="form-control" value="<?php echo $infoPuntajes?$infoPuntajes[0]["criterio_etnias"]:""; ?>" placeholder="Criterio Diferencial / Inclusión" readOnly>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
						<small>
							<p class="text-danger text-left">Hasta 10 por la escala máxima de afinidad.
								<br>Puntaje sobre 10%
							</p>
						</small>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="criterioDesarrollo">Criterio Dif. Desarrollo Objeto: </label>
					<input type="number" max="10" id="criterioDesarrollo" name="criterioDesarrollo" class="form-control" value="<?php echo $infoPuntajes?$infoPuntajes[0]["criterio_desarrollo"]:""; ?>" placeholder="Criterio Dif. Desarrollo Objeto" >
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
						<small><br>
							<p class="text-danger text-left">Hasta 10 por la escala máxima de afinidad.
								<br>Puntaje sobre 10%
							</p>
						</small>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div id="div_load" style="display:none">		
				<div class="progress progress-striped active">
					<div class="progress-bar" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
						<span class="sr-only">45% completado</span>
					</div>
				</div>
			</div>
			<div id="div_error" style="display:none">			
				<div class="alert alert-danger"><span class="glyphicon glyphicon-remove" id="span_msj">&nbsp;</span></div>
			</div>	
		</div>
		<div class="form-group">
			<div class="row" align="center">
				<div style="width:50%;" align="center">
					<button type="button" id="btnSubmit" name="btnSubmit" class="btn btn-primary" >
						Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
					</button> 
				</div>
			</div>
		</div>
	</form>
</div>