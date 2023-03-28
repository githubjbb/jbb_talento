<script type="text/javascript" src="<?php echo base_url("assets/js/validate/dashboard/puntajes.js"); ?>"></script>

<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="exampleModalLabel">Puntajes del Candidato
	<br><small>Adicionar/Editar Puntajes</small>
	</h4>
</div>

<div class="modal-body">
	<form name="formPr" id="formPr" role="form" method="post">
		<input type="hidden" id="hddIdCandidato" name="hddIdCandidato" value="<?php echo $idCandidato; ?>"/>
		<input type="hidden" id="hddIdPuntaje" name="hddIdPuntaje" value="<?php echo $idPuntaje; ?>"/>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="puntajeEstudiosAdicionales">PUNTAJE EXPERIENCIA PROFESIONAL: </label>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="puntajeEstudiosAdicionales">Experiencia Profesional Relacionada en el Sector Privado</label>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label">Entidad: </label>
					<input type="text" id="entidadPr" name="entidadPr" class="form-control" placeholder="Entidad">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label class="control-label">Fecha Inicio: </label>
					<input type="text" id="fechaInicioPr" name="fechaInicioPr" class="form-control" placeholder="Fecha Inicio" onkeydown="return false">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label class="control-label">Fecha Final: </label>
					<input type="text" id="fechaFinalPr" name="fechaFinalPr" class="form-control" placeholder="Fecha Final" onkeydown="return false">
				</div>
			</div>
			<div class="form-group">
				<div class="row" align="center">
					<div style="width:50%;" align="center">
						<button type="button" id="btnPrivado" name="btnPrivado" class="btn btn-info" <?php if(empty($infoPuntajes)) { ?> disabled <?php } ?> >
							Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
						</button> 
					</div>
				</div>
			</div>
		</div>
		<?php
		$sumaDiasPr = $sumaMesesPr = $sumaAniosPr = $puntajePrivado = 0;
        if (!empty($infoPrivado)) {
			$contador = count($infoPrivado);
		?>
		<table width="100%" class="table table-hover" id="dataTables">
			<thead>
                <tr>
                    <th class='text-center' style="width: 40%;">Entidad</th>
                    <th class='text-center' style="width: 14%;">Fecha Inicio</th>
                    <th class='text-center' style="width: 14%;">Fecha Final</th>
                    <th class='text-center' style="width: 8%;">Años</th>
                    <th class='text-center' style="width: 8%;">Meses</th>
                    <th class='text-center' style="width: 8%;">Días</th>
                    <th class='text-center' style="width: 8%;">Eliminar</th>
                </tr>
            </thead>
            <tbody>
        <?php
        	foreach ($infoPrivado as $lista):
            	$sumaDiasPr += $lista["dias_pr"];
            	$sumaMesesPr += $lista["meses_pr"];
            	$sumaAniosPr += $lista["anios_pr"];
            	echo '<tr>';
                echo '<td class="text-left">' . $lista['entidad_pr'] . '</td>';
                echo '<td class="text-center">' . $lista['fecha_inicio_pr'] . '</td>';
                echo '<td class="text-center">' . $lista['fecha_final_pr'] . '</td>';
                echo '<td class="text-center">' . $lista['anios_pr'] . '</td>';
                echo '<td class="text-center">' . $lista['meses_pr'] . '</td>';
                echo '<td class="text-center">' . $lista['dias_pr'] . '</td>';
                echo "<td class='text-center'>";
        ?>
                <button type="button" id="pr_<?php echo $lista['id_privado']; ?>" class='btn btn-danger btn-xs' title="Delete"><i class="fa fa-trash-o"></i></button>
        <?php
        		echo "</td>";
                echo '</tr>';
			endforeach;
		?>
			</tbody>
		<?php
			$mesesExtraPr = $sumaDiasPr / 30;
			$mesesEnteroPr = intval($mesesExtraPr);
			$sumaMesesPr += $mesesEnteroPr;
			$aniosExtraPr = intval($sumaMesesPr / 12);
			$totalDiasPr = ($mesesExtraPr - $mesesEnteroPr) * 30;
			$totalMesesPr = $sumaMesesPr % 12;
			$totalAniosPr = $sumaAniosPr + $aniosExtraPr;
			$tiempoMesesPr = round(($totalMesesPr * 10) / 12);
			$tiempoTotalPr = floatval($totalAniosPr . '.' . $tiempoMesesPr);
			$puntajePrivado = $tiempoTotalPr * 2;
		?>
			<tfooter>
	    		<tr>
            		<th class="text-right" colspan="3">TOTAL</th>
            		<th class="text-center"><?php echo $totalAniosPr; ?></th>
            		<th class="text-center"><?php echo $totalMesesPr; ?></th>
            		<th class="text-center"><?php echo $totalDiasPr; ?></th>
            	</tr>
			</tfooter>
			<input type="hidden" id="hddContadorPr" name="hddContadorPr" value="<?php echo $contador; ?>" />
			<input type="hidden" id="hddExpPrivado" name="hddExpPrivado" value="<?php echo $puntajePrivado; ?>" />
		</table>
		<?php
		}
		?>
	</form>
	<form name="formPu" id="formPu" role="form" method="post">
		<input type="hidden" id="hddIdCandidato" name="hddIdCandidato" value="<?php echo $idCandidato; ?>"/>
		<input type="hidden" id="hddIdPuntaje" name="hddIdPuntaje" value="<?php echo $idPuntaje; ?>"/>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="puntajeEstudiosAdicionales">Experiencia Profesional Relacionada en el Sector Público</label>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label">Entidad: </label>
					<input type="text" id="entidadPu" name="entidadPu" class="form-control" placeholder="Entidad">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label class="control-label">Fecha Inicio: </label>
					<input type="text" id="fechaInicioPu" name="fechaInicioPu" class="form-control" placeholder="Fecha Inicio" onkeydown="return false">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label class="control-label">Fecha Final: </label>
					<input type="text" id="fechaFinalPu" name="fechaFinalPu" class="form-control" placeholder="Fecha Final" onkeydown="return false">
				</div>
			</div>
			<div class="form-group">
				<div class="row" align="center">
					<div style="width:50%;" align="center">
						<button type="button" id="btnPublico" name="btnPublico" class="btn btn-info" <?php if(empty($infoPuntajes)) { ?> disabled <?php } ?>>
							Guardar <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true">
						</button> 
					</div>
				</div>
			</div>
		</div>
		<?php
		$sumaDiasPu = $sumaMesesPu = $sumaAniosPu = $puntajePublico = 0;
        if (!empty($infoPublico)) {
			$contador = count($infoPublico);
		?>
		<table width="100%" class="table table-hover" id="dataTables">
			<thead>
                <tr>
                    <th class='text-center' style="width: 40%;">Entidad</th>
                    <th class='text-center' style="width: 14%;">Fecha Inicio</th>
                    <th class='text-center' style="width: 14%;">Fecha Final</th>
                    <th class='text-center' style="width: 8%;">Años</th>
                    <th class='text-center' style="width: 8%;">Meses</th>
                    <th class='text-center' style="width: 8%;">Días</th>
                    <th class='text-center' style="width: 8%;">Eliminar</th>
                </tr>
            </thead>
            <tbody>
        <?php
        	foreach ($infoPublico as $lista):
            	$sumaDiasPu += $lista["dias_pu"];
            	$sumaMesesPu += $lista["meses_pu"];
            	$sumaAniosPu += $lista["anios_pu"];
            	echo '<tr>';
                echo '<td class="text-left">' . $lista['entidad_pu'] . '</td>';
                echo '<td class="text-center">' . $lista['fecha_inicio_pu'] . '</td>';
                echo '<td class="text-center">' . $lista['fecha_final_pu'] . '</td>';
                echo '<td class="text-center">' . $lista['anios_pu'] . '</td>';
                echo '<td class="text-center">' . $lista['meses_pu'] . '</td>';
                echo '<td class="text-center">' . $lista['dias_pu'] . '</td>';
                echo "<td class='text-center'>";
        ?>
                <button type="button" id="pu_<?php echo $lista['id_publico']; ?>" class='btn btn-danger btn-xs' title="Delete"><i class="fa fa-trash-o"></i></button>
        <?php
        		echo "</td>";
                echo '</tr>';
			endforeach;
		?>
			</tbody>
		<?php
			$mesesExtraPu = $sumaDiasPu / 30;
			$mesesEnteroPu = intval($mesesExtraPu);
			$sumaMesesPu += $mesesEnteroPu;
			$aniosExtraPu = intval($sumaMesesPu / 12);
			$totalDiasPu = ($mesesExtraPu - $mesesEnteroPu) * 30;
			$totalMesesPu = $sumaMesesPu % 12;
			$totalAniosPu = $sumaAniosPu + $aniosExtraPu;
			$tiempoMesesPu = round(($totalMesesPu * 10) / 12);
			$tiempoTotalPu = floatval($totalAniosPu . '.' . $tiempoMesesPu);
			$puntajePublico = $tiempoTotalPu * 3;
		?>
			<tfooter>
	    		<tr>
            		<th class="text-right" colspan="3">TOTAL</th>
            		<th class="text-center"><?php echo $totalAniosPu; ?></th>
            		<th class="text-center"><?php echo $totalMesesPu; ?></th>
            		<th class="text-center"><?php echo $totalDiasPu; ?></th>
            	</tr>
			</tfooter>
			<input type="hidden" id="hddContadorPu" name="hddContadorPu" value="<?php echo $contador; ?>" />
			<input type="hidden" id="hddExpPublico" name="hddExpPublico" value="<?php echo $puntajePublico; ?>" />
		</table>
		<?php
		}
		?>
	</form>
	<form name="form" id="form" role="form" method="post">
		<input type="hidden" id="hddIdCandidato" name="hddIdCandidato" value="<?php echo $idCandidato; ?>"/>
		<input type="hidden" id="hddIdPuntaje" name="hddIdPuntaje" value="<?php echo $idPuntaje; ?>"/>
		<input type="hidden" id="hddIdPuntaje" name="hddIdPuntaje" value="<?php echo $infoPuntajes?$infoPuntajes[0]['id_puntaje']:""; ?>" />
		<input type="hidden" id="hddcbox1" name="hddcbox1" value="<?php echo $infoPuntajes?$infoPuntajes[0]['etnias']:""; ?>" />
		<input type="hidden" id="hddcbox2" name="hddcbox2" value="<?php echo $infoPuntajes?$infoPuntajes[0]['lgtbi']:""; ?>" />
		<input type="hidden" id="hddcbox3" name="hddcbox3" value="<?php echo $infoPuntajes?$infoPuntajes[0]['discapacidad']:""; ?>" />
		<input type="hidden" id="hddcbox4" name="hddcbox4" value="<?php echo $infoPuntajes?$infoPuntajes[0]['na']:""; ?>" />
		<input type="hidden" id="hddcbox5" name="hddcbox5" value="<?php echo $infoPuntajes?$infoPuntajes[0]['bachiller']:""; ?>" />
		<input type="hidden" id="hddcbox6" name="hddcbox6" value="<?php echo $infoPuntajes?$infoPuntajes[0]['tecnica']:""; ?>" />
		<input type="hidden" id="hddcbox7" name="hddcbox7" value="<?php echo $infoPuntajes?$infoPuntajes[0]['tecnologia']:""; ?>" />
		<input type="hidden" id="hddcbox8" name="hddcbox8" value="<?php echo $infoPuntajes?$infoPuntajes[0]['tecnologia_especializada']:""; ?>" />
		<input type="hidden" id="hddcbox9" name="hddcbox9" value="<?php echo $infoPuntajes?$infoPuntajes[0]['universitaria']:""; ?>" />
		<input type="hidden" id="hddcbox10" name="hddcbox10" value="<?php echo $infoPuntajes?$infoPuntajes[0]['especializacion']:""; ?>" />
		<input type="hidden" id="hddcbox11" name="hddcbox11" value="<?php echo $infoPuntajes?$infoPuntajes[0]['maestria']:""; ?>" />
		<input type="hidden" id="hddcbox12" name="hddcbox12" value="<?php echo $infoPuntajes?$infoPuntajes[0]['doctorado']:""; ?>" />
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<input type="number" max="70" id="puntajeExperiencia" name="puntajeExperiencia" class="form-control" value="<?php
						if (!empty($infoPrivado) || !empty($infoPublico)) {
							$puntaje = $puntajePrivado + $puntajePublico;
							if ($puntaje > 70) {
								$puntaje = 70;
							} else {
								$puntaje = $puntaje;
							}
							echo $puntaje;
						} else {
							echo $infoPuntajes?$infoPuntajes[0]["puntaje_experiencia"]:"";
						}
					?>" placeholder="Puntaje Experiencia Profesional" readOnly>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<small>
						<p class="text-danger text-left">Hasta 70 por la escala máxima establecida.
							<br>Puntaje sobre 20%
						</p>
					</small>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="puntajeEstudiosAdicionales">PUNTAJE ESTUDIOS ADICIONALES: </label>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox5" name="cbox5" class="estudios" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["bachiller"] == 1) { ?> checked <?php } ?>> Bachiller</label>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox6" name="cbox6" class="estudios" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["tecnica"] == 1) { ?> checked <?php } ?>> Técnica</label>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox7" name="cbox7" class="estudios" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["tecnologia"] == 1) { ?> checked <?php } ?>> Tecnología</label>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox8" name="cbox8" class="estudios" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["tecnologia_especializada"] == 1) { ?> checked <?php } ?>> Tecnología Especializada</label>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox9" name="cbox9" class="estudios" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["universitaria"] == 1) { ?> checked <?php } ?>> Universitaria</label>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox10" name="cbox10" class="estudios" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["especializacion"] == 1) { ?> checked <?php } ?>> Especialización</label>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox11" name="cbox11" class="estudios" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["maestria"] == 1) { ?> checked <?php } ?>> Maestría o Magister</label>
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group text-left">
					<label><input type="checkbox" id="cbox12" name="cbox12" class="estudios" <?php if(!empty($infoPuntajes) && $infoPuntajes[0]["doctorado"] == 1) { ?> checked <?php } ?>> Doctorado PHD</label>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<input type="number" max="10" id="puntajeEstudiosAdicionales" name="puntajeEstudiosAdicionales" class="form-control" value="<?php echo $infoPuntajes?$infoPuntajes[0]["puntaje_adicionales"]:""; ?>" placeholder="Puntaje Estudios Adicionales" readOnly>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<small>
						<p class="text-danger text-left">Hasta 10 por la escala máxima establecida.
							<br>Puntaje sobre 10%
						</p>
					</small>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group text-left">
					<label class="control-label" for="reultadoEntrevista">RESULTADO ENTREVISTA: </label>
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
		<hr>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="criterioEtnias">CRITERIO DIFERENCIAL / INCLUSIÓN: </label>
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
		<hr>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group text-left">
					<label class="control-label" for="criterioDesarrollo">CRITERIO DIFERENCIAL DESARROLLO OBJETO: </label>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group text-left">
					Sus conocimientos y experiencia certificados, las habilidades y competencias valoradas; lo hacen compatible con el objeto y actividades a contratar.
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group text-left">
					<input type="number" max="10" id="criterioDesarrollo" name="criterioDesarrollo" class="form-control" value="<?php echo $infoPuntajes?$infoPuntajes[0]["criterio_desarrollo"]:""; ?>" placeholder="Criterio Dif. Desarrollo Objeto" >
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
		<hr>
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