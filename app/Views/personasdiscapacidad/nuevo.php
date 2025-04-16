<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Declara Fallecimiento
<?= $this->endSection('title'); ?>
<?= $this->section('content'); ?>

<form action="<?php echo base_url('personasdiscapacidad'); ?>" method="post" autocomplete="off">
	<?php echo csrf_field(); ?>
	<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrfcode">
<div class="card">
    <div class="card-header">
        <h4>DATOS PERSONALES</h4>
    </div>
    <div class="card-body">
            <div class="row">
                <div class="col-sm-10">
                    <input hidden="" type="text" name="foto" id="foto" value="">
					<input type="text" name="id_discapacidad" id="id_discapacidad" value="<?php echo set_value('id', $persona['id']); ?>">
                    <div class="row">
						<div class="form-group col-md-4">
							<label>Tipo de documento</label>
							<select name="cbtipodocumento" class="form-control form-select" disabled>
								<option value="0">Seleccionar</option>
								<?php foreach ($tipodocumento as $row) { ?>
                                    <option value="<?php echo $row['ID']; ?>" <?= set_select('cbtipodocumento', $row['ID'], ($persona['IDtipo_documento'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
								<?php } ?>
							</select>
							<?php if (isset($validacion)) { ?>
								<span class="text-danger"><?php echo $validacion->getError('cbtipodocumento'); ?></span>
							<?php } ?>
						</div>
                        <div class="form-group col-sm-3">
                            <label>N° Documento de Identidad</label>
                            <input type="text" value="<?php echo set_value('DNI', $persona['DNI']); ?>" placeholder="DNI" maxlength="8" id="dni" name="dni" onkeyup="" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nombres</label>
                            <input type="text" value="<?php echo set_value('nombres', $persona['nombres']); ?>" placeholder="Nombres" id="nombre" name="nombre" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Apellido paterno</label>
                            <input type="text" value="<?php echo set_value('apaterno', $persona['apaterno']); ?>" placeholder="Apellido paterno" id="apellido_pat" name="apellido_pat" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Apellido materno</label>
                            <input type="text" value="<?php echo set_value('amaterno', $persona['amaterno']); ?>" placeholder="Apellido materno" id="apellido_mat" name="apellido_mat" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Estado civil</label>
                            <input type="text" value="<?php echo set_value('estado_civil', $persona['estado_civil']); ?>" placeholder="Estado civil" id="estado_civil" name="estado_civil" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Sexo</label>
                            <select name="cbsexo" class="form-control form-select" disabled>
                                <option value="">Seleccionar</option>
                                <?php foreach ($sexo as $row) { ?>
                                    <option value="<?php echo $row['ID']; ?>" <?= set_select('cbsexo', $row['ID'], ($persona['IDsexo'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Fecha de Nacimiento</label>
                            <input type="date" id="fechanacimiento" name="fechanacimiento" class="form-control" value="<?php echo set_value('fecha_nacimiento', $persona['fecha_nacimiento']); ?>" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Edad</label>
                            <input type="text" id="edad" name="edad" class="form-control" value="<?php echo set_value('edad', $persona['edad']); ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-2">
                    <img id="imgElem" style="width: 100%;border: solid 2px #ddd;border-radius: 5px;" src="<?php echo base_url(); ?>img_dni/anonymous.png">
                </div>
            <div class="text-end"  style="padding-right: 180px;">
                <a href="<?php echo base_url('personas'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4>VIVIENDA</h4>
    </div>
    <div class="card-body">
            <div class="row">
                <div class="col-sm-10">
                    <div class="row">
                        <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" value="<?php echo set_value('direccion', $persona['direccion']); ?>" placeholder="" id="direccion" name="direccion" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label>La vivienda es:</label>
                            <select name="cbvivienda" class="form-control form-select" >
                                <option value="">Seleccionar</option>
                                <?php foreach ($cbvivienda as $row) { ?>
                                    <option value="<?php echo $row['ID']; ?>" <?= set_select('cbvivienda', $row['ID'], ($persona['idvivienda'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Vive en Forma:</label>
                            <select name="cbvivenforma" class="form-control form-select" >
                                <option value="">Seleccionar</option>
                                <?php foreach ($cbvivenforma as $row) { ?>
                                    <option value="<?php echo $row['ID']; ?>" <?= set_select('cbvivenforma', $row['ID'], ($persona['idviven'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Construccion:</label>
                            <select name="cbconstruccion" class="form-control form-select" >
                                <option value="">Seleccionar</option>
                                <?php foreach ($cbconstruccion as $row) { ?>
                                    <option value="<?php echo $row['ID']; ?>" <?= set_select('cbconstruccion', $row['ID'], ($persona['idconstruccion'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Servicios:</label>
                            <select name="cbservicios" class="form-control form-select" >
                                <option value="">Seleccionar</option>
                                <?php foreach ($cbservicios as $row) { ?>
                                    <option value="<?php echo $row['ID']; ?>" <?= set_select('cbservicios', $row['ID'], ($persona['idservicios'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4>DATOS FAMILIARES</h4>
    </div>
    <div class="card-body">
            <div class="row">
                <div class="col-sm-10">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Es padre o madre de familia:</label>
                            <select name="cbespadre" class="form-control form-select" >
								<option value="0">Seleccionar</option>
                                <?php foreach ($cbsino as $row) { ?>
                                    <option value="<?php echo $row['value']; ?>" <?= set_select('cbsino', $row['value'], ($persona['espadre'] == $row['value'] || $row == $row['value'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
					    <div class="form-group col-sm-4">
                            <label>Cuantos hijos tiene</label>
                            <input type="text" value="<?php echo set_value('numerohijos', $persona['numerohijos']); ?>" placeholder="Hijos" maxlength="9" id="numero_hijos" name="numero_hijos" class="form-control">
                        </div>
                        <div class="form-group col-md-8">
                            <label>Nombre de un familiar o vecino que se pueda contactar</label>
                            <input type="text" value="<?php echo set_value('contacto', $persona['contacto']); ?>" placeholder="Nombre completo" id="contacto" name="contacto" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Telefono</label>
                            <input type="text" value="<?php echo set_value('telefono', $persona['telefono']); ?>" placeholder="Celular" id="telefono" name="telefono" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4>ESTUDIOS Y CAPACITACIONES</h4>
    </div>
    <div class="card-body">
            <div class="row">
                <div class="col-sm-10">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Grado de instrucción:</label>
                            <select name="cbinstruccion" class="form-control form-select" >
                                <option value="">Seleccionar</option>
                                <?php foreach ($cbinstruccion as $row) { ?>
                                    <option value="<?php echo $row['ID']; ?>" <?= set_select('cbinstruccion', $row['ID'], ($persona['idinstruccion'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
					    <div class="form-group col-sm-9">
                            <label>Cuenta con título profecional / oficio / capacitación</label>
                            <input type="text" value="<?php echo set_value('oficio', $persona['oficio']); ?>" placeholder="" maxlength="100" id="oficio" name="oficio" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Concluyó sus estudios:</label>
                            <select name="cbestudios" class="form-control form-select" >
                                <option value="">Seleccionar</option>
                                <?php foreach ($cbestudios as $row) { ?>
                                    <option value="<?php echo $row['ID']; ?>" <?= set_select('cbestudios', $row['ID'], ($persona['idestudios'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
					    <div class="form-group col-sm-9">
                            <label>Porque no estudia</label>
                            <input type="text" value="<?php echo set_value('noestudia', $persona['noestudia']); ?>" placeholder="" maxlength="100" id="noestudia" name="noestudia" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label>En que le gustaria capacitarse</label>
                            <input type="text" value="<?php echo set_value('gustaria_capacitarse', $persona['gustaria_capacitarse']); ?>" placeholder="" id="gustaria_capacitarse" name="gustaria_capacitarse" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Como su enfermedad o lesión limita su capacidad de trabajo o estudio</label>
                            <input type="text" value="<?php echo set_value('limita_capacidad', $persona['limita_capacidad']); ?>" placeholder="" id="limita_capacidad" name="limita_capacidad" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4>SITUACIÓN LABORAL</h4>
    </div>
    <div class="card-body">
            <div class="row">
                <div class="col-sm-10">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Trabaja actualmente:</label>
                            <select name="cbtrabaja" class="form-control form-select" >
								<option value="0">Seleccionar</option>
                                <?php foreach ($cbsino as $row) { ?>
                                    <option value="<?php echo $row['value']; ?>" <?= set_select('cbsino', $row['value'], ($persona['trabaja'] == $row['value'] || $row == $row['value'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
						
					    <div class="form-group col-sm-9">
                            <label>En que trabaja</label>
                            <input type="text" value="<?php echo set_value('trabajaen', $persona['trabajaen']); ?>" placeholder="" maxlength="9" id="trabajaen" name="trabajaen" class="form-control">
                        </div>
					    <div class="form-group col-sm-4">
                            <label>Ingreso mensual</label>
                            <input type="text" value="<?php echo set_value('ingreso_mensual', $persona['ingreso_mensual']); ?>" placeholder="" maxlength="9" id="ingreso_mensual" name="ingreso_mensual" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Condicion laboral:</label>
                            <select name="cbcondicion_laboral" class="form-control form-select" >
                                <option value="">Seleccionar</option>
                                <?php foreach ($cbcondicion_laboral as $row) { ?>
                                    <option value="<?php echo $row['ID']; ?>" <?= set_select('cbcondicion_laboral', $row['ID'], ($persona['idcondicion_laboral'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Trabajo anteriormente:</label>
                            <select name="cbtrabajo_anteriormente" class="form-control form-select" >
								<option value="0">Seleccionar</option>
                                <?php foreach ($cbsino as $row) { ?>
                                    <option value="<?php echo $row['value']; ?>" <?= set_select('cbsino', $row['value'], ($persona['trabajo_antes'] == $row['value'] || $row == $row['value'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4>SALUD DEFICIENCIAS EN:</h4>
    </div>
    <div class="card-body">
            <div class="row">
                <div class="col-sm-10">
                    <div class="row">
						<div class="section-title">Comunicación</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Hablar</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Escuchar</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Ver</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>

						<div class="section-title">Conducta</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Aprender</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Atender</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Retencion de conocimientos</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Relacionarse</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Tiene conocimiento del yo</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Se ubica en el espacio y tiempo</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Tiene seguridad personal</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>
						<div class="section-title">Locomoción</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Caminar</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Correr</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Movilizarse por si mismo</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>
						
						<div class="section-title">Disposición corporal</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Arrodillarse</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Realizar tareas del hogar</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>
						<div class="form-group col-md-3">
						  <label class="form-label">Mantener el equilibrio</label>
						  <div class="selectgroup w-100">
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="1" class="selectgroup-input-radio" checked>
							  <span class="selectgroup-button">Si</span>
							</label>
							<label class="selectgroup-item">
							  <input type="radio" name="radio1" value="2" class="selectgroup-input-radio">
							  <span class="selectgroup-button">No</span>
							</label>
						  </div>
						</div>
                    </div>
                </div>
            </div>
    </div>
</div>
</form>

<?= $this->endSection('content'); ?>
<?= $this->section('js'); ?>
<script src="<?php echo base_url('assets/js/pages/personas-fallecidas-edit.js'); ?>"></script>
<?= $this->endSection('js'); ?>