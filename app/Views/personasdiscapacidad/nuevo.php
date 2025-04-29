<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Declara Fallecimiento
<?= $this->endSection('title'); ?>
<?= $this->section('content'); ?>

<form action="<?php echo base_url('personasdiscapacidad'); ?>" method="post" autocomplete="off">
  <?php echo csrf_field(); ?>
  <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrfcode">
  <div class="card card-primary">
    <div class="card-header">
      <h4>DATOS PERSONALES</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-10">
          <input hidden="" type="text" name="foto" id="foto" value="">
          <input type="hidden" name="id_discapacidad" id="id_discapacidad" value="<?php echo set_value('id', $persona['id']); ?>">
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
            <div class="form-group col-md-5">
              <label>Cuenta con certificado de discapacidad oficial:</label>
              <select name="cbcertificado" class="form-control form-select">
                <option value="0">Seleccionar</option>
                <?php foreach ($cbsino as $row) { ?>
                  <option value="<?php echo $row['value']; ?>" <?= set_select('cbsino', $row['value'], ($persona['certificado'] == $row['value'] || $row == $row['value'] ? true : false)) ?>>
                    <?php echo $row['Descripcion']; ?>
                  </option>
                <?php } ?>
              </select>
              <?php if (isset($validacion)) { ?>
                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
              <?php } ?>
            </div>
            <div class="form-group col-md-7">
              <label>Que institución le otorgo</label>
              <input type="text" value="<?php echo set_value('institucion_otorgo', $persona['institucion_otorgo']); ?>" placeholder="" id="institucion_otorgo" name="institucion_otorgo" class="form-control">
            </div>
            <div class="form-group col-md-5">
              <label>Cuenta con carnet del CONADIS:</label>
              <select name="cbcarnet_conadis" class="form-control form-select">
                <option value="0">Seleccionar</option>
                <?php foreach ($cbsino as $row) { ?>
                  <option value="<?php echo $row['value']; ?>" <?= set_select('cbsino', $row['value'], ($persona['carnet_conadis'] == $row['value'] || $row == $row['value'] ? true : false)) ?>>
                    <?php echo $row['Descripcion']; ?>
                  </option>
                <?php } ?>
              </select>
              <?php if (isset($validacion)) { ?>
                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
              <?php } ?>
            </div>
            <div class="form-group col-md-3">
              <label>Vigente hasta</label>
              <input type="date" id="carnet_vigencia" name="carnet_vigencia" class="form-control" value="<?php echo set_value('carnet_vigencia', $persona['carnet_vigencia']); ?>">
            </div>
            <div class="form-group col-md-4">
              <label>Cuenta con seguro de salud:</label>
              <select name="cbsegurosalud" class="form-control form-select">
                <option value="">Seleccionar</option>
                <?php foreach ($cbsegurosalud as $row) { ?>
                  <option value="<?php echo $row['ID']; ?>" <?= set_select('cbsegurosalud', $row['ID'], ($persona['seguro'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                    <?php echo $row['Descripcion']; ?>
                  </option>
                <?php } ?>
              </select>
              <?php if (isset($validacion)) { ?>
                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
              <?php } ?>
            </div>
            <div class="form-group">
              <label>Padre, Madre o apoderado</label>
              <input type="text" value="<?php echo set_value('apoderado', $persona['apoderado']); ?>" placeholder="" id="apoderado" name="apoderado" class="form-control">
            </div>
          </div>
        </div>
        <div class="form-group col-sm-2">
          <img id="imgElem" style="width: 100%;border: solid 2px #ddd;border-radius: 5px;" src="<?php echo base_url().'img_dni/'.$persona['DNI'].'.png'; ?>">
        </div>
      </div>
    </div>
  </div>

  <div class="card card-primary">
    <div class="card-header">
      <h4>VIVIENDA</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-10">
          <div class="row">
            <div class="form-group col-sm-9">
              <label>Dirección</label>
              <input type="text" value="<?php echo set_value('direccion', $persona['direccion']); ?>" placeholder="" id="direccion" name="direccion" class="form-control" readonly>
            </div>
            <div class="form-group col-sm-3">
              <label>Cuantos viven en la casa</label>
              <input type="text" value="<?php echo set_value('cuantos_viven', $persona['cuantos_viven']); ?>" placeholder="" maxlength="9" id="cuantos_viven" name="cuantos_viven" class="form-control">
            </div>
            <div class="form-group col-md-3">
              <label>La vivienda es:</label>
              <select name="cbvivienda" class="form-control form-select">
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
              <select name="cbvivenforma" class="form-control form-select">
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
              <select name="cbconstruccion" class="form-control form-select">
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
              <select name="cbservicios" class="form-control form-select">
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
  <div class="card card-primary">
    <div class="card-header">
      <h4>DATOS FAMILIARES</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-10">
          <div class="row">
            <div class="form-group col-md-3">
              <label>Es padre o madre de familia:</label>
              <select name="cbespadre" class="form-control form-select">
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
  <div class="card card-primary">
    <div class="card-header">
      <h4>ESTUDIOS Y CAPACITACIONES</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-10">
          <div class="row">
            <div class="form-group col-md-3">
              <label>Grado de instrucción:</label>
              <select name="cbinstruccion" class="form-control form-select">
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
              <select name="cbestudios" class="form-control form-select">
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
              <label>Como su enfermedad o lesión limita su capacidad de estudio</label>
              <input type="text" value="<?php echo set_value('limita_capacidad', $persona['limita_capacidad']); ?>" placeholder="" id="limita_capacidad" name="limita_capacidad" class="form-control">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card card-primary">
    <div class="card-header">
      <h4>SITUACIÓN LABORAL</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-10">
          <div class="row">
            <div class="form-group col-md-3">
              <label>Trabaja actualmente:</label>
              <select name="cbtrabaja" class="form-control form-select">
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
              <select name="cbcondicion_laboral" class="form-control form-select">
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
              <select name="cbtrabajo_anteriormente" class="form-control form-select">
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
			<div class="form-group col-md-12">
              <label>Como su enfermedad o lesión limita su capacidad de trabajo</label>
              <input type="text" value="<?php echo set_value('limita_trabajo', $persona['limita_trabajo']); ?>" placeholder="" id="limita_trabajo" name="limita_trabajo" class="form-control">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card card-primary">
    <div class="card-header">
      <h4>SALUD DEFICIENCIAS EN:</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-10">
          <div class="row">
            <div class="form-group col-md-4">
              <label>Salud deficiencias en:</label>
              <select name="cbsalud" id="cbsalud" class="form-control form-select">
                <option value="0">Seleccionar</option>
                <?php foreach ($cbsalud as $row) { ?>
                  <?php if ($row['value'] == '1') { ?>
                    <optgroup label="<?php echo $row['Descripcion']; ?>">
                    <?php } ?>
                    <?php if ($row['value'] <> '1') { ?>
                      <option value="<?php echo $row['ID']; ?>">
                        <?php echo $row['Descripcion']; ?>
                      </option>
                    <?php } ?>
                  <?php } ?>
              </select>
              <?php if (isset($validacion)) { ?>
                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
              <?php } ?>
            </div>
            <div class="form-group col-md-3">
              <label>Respuesta:</label>
              <select name="cbrespuesta" id="cbrespuesta" class="form-control form-select">
                <option value="0">Seleccionar</option>
                <?php foreach ($cbsino as $row) { ?>
                  <option value="<?php echo $row['value']; ?>">
                    <?php echo $row['Descripcion']; ?>
                  </option>
                <?php } ?>
              </select>
              <?php if (isset($validacion)) { ?>
                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
              <?php } ?>
            </div>
            <div class="form-group col-md-1">
              <label></label>
              <a href="javascript:void(0);" onclick="AgregarDiscapacidad();" class="btn btn-success">Agregar</a>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped nowrap" id="tblsalud" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Item</th>
                  <th>Discapacidad</th>
                  <th>Deficiencias</th>
                  <th>Si-No</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card card-primary">
    <div class="card-header">
      <h4>ORIGEN DE SU DISCAPACIDAD</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-10">
          <div class="row">
            <div class="form-group col-md-3">
              <label>Origen:</label>
              <select name="cborigendiscapacidad" class="form-control form-select">
                <option value="0">Seleccionar</option>
                <?php foreach ($cborigendiscapacidad as $row) { ?>
                  <option value="<?php echo $row['ID']; ?>" <?= set_select('cborigendiscapacidad', $row['ID'], ($persona['idorigendiscapacidad'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                    <?php echo $row['Descripcion']; ?>
                  </option>
                <?php } ?>
              </select>
              <?php if (isset($validacion)) { ?>
                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
              <?php } ?>
            </div>
            <div class="form-group col-sm-5">
              <label>Otro: detallar</label>
              <input type="text" value="<?php echo set_value('discapacidad_otro', $persona['discapacidad_otro']); ?>" placeholder="" maxlength="50" id="discapacidad_otro" name="discapacidad_otro" class="form-control">
            </div>
            <div class="form-group col-sm-4">
              <label>Fecha adq. discapacidad</label>
              <input type="text" value="<?php echo set_value('fecha_discapacidad', $persona['fecha_discapacidad']); ?>" placeholder="" maxlength="50" id="fecha_discapacidad" name="fecha_discapacidad" class="form-control">
            </div>
            <div class="form-group col-md-3">
              <label>Recibe rehabilitación:</label>
              <select name="cbrehabilitacion" class="form-control form-select">
                <option value="0">Seleccionar</option>
                <?php foreach ($cbsino as $row) { ?>
                  <option value="<?php echo $row['value']; ?>" <?= set_select('cbsino', $row['value'], ($persona['idrehabilitacion'] == $row['value'] || $row == $row['value'] ? true : false)) ?>>
                    <?php echo $row['Descripcion']; ?>
                  </option>
                <?php } ?>
              </select>
              <?php if (isset($validacion)) { ?>
                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
              <?php } ?>
            </div>
            <div class="form-group col-sm-9">
              <label>Tipo rehabilitación</label>
              <input type="text" value="<?php echo set_value('tipo_rehabilitacion', $persona['tipo_rehabilitacion']); ?>" placeholder="" maxlength="50" id="tipo_rehabilitacion" name="tipo_rehabilitacion" class="form-control">
            </div>
            <div class="form-group col-sm-12">
              <label>Personas con discapacidad hay en su casa incluyendose a usted</label>
              <input type="text" value="<?php echo set_value('personas_discapacidad', $persona['personas_discapacidad']); ?>" placeholder="" maxlength="50" id="personas_discapacidad" name="personas_discapacidad" class="form-control">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card card-primary">
    <div class="card-header">
      <h4>ACTIVIDADES</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-10">
          <div class="row">
            <div class="form-group col-md-7">
              <label>Actividad:</label>
              <select name="cbactividad_discapacidad" id="cbactividad_discapacidad" class="form-control form-select">
                <option value="0">Seleccionar</option>
                <?php foreach ($cbactividad_discapacidad as $row) { ?>
                  <?php if ($row['value'] == '1') { ?>
                    <optgroup label="<?php echo $row['Descripcion']; ?>">
                    <?php } ?>
                    <?php if ($row['value'] <> '1') { ?>
                      <option value="<?php echo $row['ID']; ?>">
                        <?php echo $row['Descripcion']; ?>
                      </option>
                    <?php } ?>
                  <?php } ?>
              </select>
              <?php if (isset($validacion)) { ?>
                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
              <?php } ?>
            </div>
            <div class="form-group col-md-2">
              <label>Respuesta:</label>
              <select name="cbrespuesta_actividad" id="cbrespuesta_actividad" class="form-control form-select">
                <option value="0">Seleccionar</option>
                <?php foreach ($cbsino as $row) { ?>
                  <option value="<?php echo $row['value']; ?>">
                    <?php echo $row['Descripcion']; ?>
                  </option>
                <?php } ?>
              </select>
              <?php if (isset($validacion)) { ?>
                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
              <?php } ?>
            </div>
            <div class="form-group col-md-1">
              <label></label>
              <a href="javascript:void(0);" onclick="AgregarActividades();" class="btn btn-success">Agregar</a>
            </div>

<div class="form-group col-md-12">
          <div class="table-responsive">
            <table class="table table-striped nowrap" id="tblActividades" style="width:100%">
              <thead>
                <tr>
                  <th class="text-center">Item</th>
                  <th>Discapacidad</th>
                  <th>Deficiencias</th>
                  <th>Si-No</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>

</div>


            <div class="form-group col-sm-12">
              <label>Desea aprender algun deporte, hobby o actividad artistica:</label>
            </div>
            <div class="form-group col-md-3">
              <label>Indicar :</label>
              <select name="cbactividad" class="form-control form-select">
                <option value="0">Seleccionar</option>
                <?php foreach ($cbsino as $row) { ?>
                  <option value="<?php echo $row['value']; ?>" <?= set_select('cbsino', $row['value'], ($persona['idactividad'] == $row['value'] || $row == $row['value'] ? true : false)) ?>>
                    <?php echo $row['Descripcion']; ?>
                  </option>
                <?php } ?>
              </select>
              <?php if (isset($validacion)) { ?>
                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
              <?php } ?>
            </div>
            <div class="form-group col-sm-9">
              <label>Si, cual......... | No, porqué.........</label>
              <input type="text" value="<?php echo set_value('respuesta_actividad', $persona['respuesta_actividad']); ?>" placeholder="" maxlength="50" id="respuesta_actividad" name="respuesta_actividad" class="form-control">
            </div>
            <div class="form-group col-sm-12">
              <label>Pertenece a alguna organización cultural, deportiva, religiosa, u otra:</label>
            </div>
            <div class="form-group col-md-3">
              <label>Indicar :</label>
              <select name="cborganizacion" class="form-control form-select">
                <option value="0">Seleccionar</option>
                <?php foreach ($cbsino as $row) { ?>
                  <option value="<?php echo $row['value']; ?>" <?= set_select('cbsino', $row['value'], ($persona['idorganizacion'] == $row['value'] || $row == $row['value'] ? true : false)) ?>>
                    <?php echo $row['Descripcion']; ?>
                  </option>
                <?php } ?>
              </select>
              <?php if (isset($validacion)) { ?>
                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
              <?php } ?>
            </div>
            <div class="form-group col-sm-9">
              <label>Si, cual......... | No, porqué.........</label>
              <input type="text" value="<?php echo set_value('respuesta_organizacion', $persona['respuesta_organizacion']); ?>" placeholder="" maxlength="50" id="respuesta_organizacion" name="respuesta_organizacion" class="form-control">
            </div>
            <div class="form-group col-sm-12">
              <label>Accesibilidad - Existen barreras en:</label>
            </div>
            <div class="form-group col-md-3">
              <label>Trabajo :</label>
              <select name="cbtrabajo" class="form-control form-select">
                <option value="0">Seleccionar</option>
                <?php foreach ($cbsino as $row) { ?>
                  <option value="<?php echo $row['value']; ?>" <?= set_select('cbsino', $row['value'], ($persona['trabajo'] == $row['value'] || $row == $row['value'] ? true : false)) ?>>
                    <?php echo $row['Descripcion']; ?>
                  </option>
                <?php } ?>
              </select>
              <?php if (isset($validacion)) { ?>
                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
              <?php } ?>
            </div>
            <div class="form-group col-md-3">
              <label>Vivienda :</label>
              <select name="cbvivienda2" class="form-control form-select">
                <option value="0">Seleccionar</option>
                <?php foreach ($cbsino as $row) { ?>
                  <option value="<?php echo $row['value']; ?>" <?= set_select('cbsino', $row['value'], ($persona['vivienda'] == $row['value'] || $row == $row['value'] ? true : false)) ?>>
                    <?php echo $row['Descripcion']; ?>
                  </option>
                <?php } ?>
              </select>
              <?php if (isset($validacion)) { ?>
                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
              <?php } ?>
            </div>
            <div class="form-group col-md-3">
              <label>Transporte :</label>
              <select name="cbtransporte" class="form-control form-select">
                <option value="0">Seleccionar</option>
                <?php foreach ($cbsino as $row) { ?>
                  <option value="<?php echo $row['value']; ?>" <?= set_select('cbsino', $row['value'], ($persona['transporte'] == $row['value'] || $row == $row['value'] ? true : false)) ?>>
                    <?php echo $row['Descripcion']; ?>
                  </option>
                <?php } ?>
              </select>
              <?php if (isset($validacion)) { ?>
                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
              <?php } ?>
            </div>
            <div class="form-group col-md-3">
              <label>Comunidad :</label>
              <select name="cbcomunidad" class="form-control form-select">
                <option value="0">Seleccionar</option>
                <?php foreach ($cbsino as $row) { ?>
                  <option value="<?php echo $row['value']; ?>" <?= set_select('cbsino', $row['value'], ($persona['comunidad'] == $row['value'] || $row == $row['value'] ? true : false)) ?>>
                    <?php echo $row['Descripcion']; ?>
                  </option>
                <?php } ?>
              </select>
              <?php if (isset($validacion)) { ?>
                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
              <?php } ?>
            </div>
            <div class="form-group col-sm-12">
              <label>En caso de donacion de silla de ruedas: Medidas del usuario</label>
            </div>
            <div class="form-group col-sm-4">
              <label>Ancho del asiento:</label>
              <input type="text" value="<?php echo set_value('ancho', $persona['ancho']); ?>" placeholder="" maxlength="50" id="ancho" name="ancho" class="form-control">
            </div>
            <div class="form-group col-sm-4">
              <label>Profundidad del asiento:</label>
              <input type="text" value="<?php echo set_value('profundidad', $persona['profundidad']); ?>" placeholder="" maxlength="50" id="profundidad" name="profundidad" class="form-control">
            </div>
            <div class="form-group col-sm-4">
              <label>Altura de los reposapies</label>
              <input type="text" value="<?php echo set_value('altura', $persona['altura']); ?>" placeholder="" maxlength="50" id="altura" name="altura" class="form-control">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card card-primary">
    <div class="card-header">
      <h4>SITUACION SOCIO ECONOMICA:</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-10">
          <div class="row">
			<div class="form-group col-sm-9">
              <label>Nombres y Apellidos</label>
              <input type="text" value="" placeholder="" maxlength="50" id="nombres_apellidos" name="nombres_apellidos" class="form-control">
            </div>
			<div class="form-group col-sm-3">
              <label>Edad</label>
              <input type="text" value="" placeholder="" maxlength="50" id="edad2" name="edad2" class="form-control">
            </div>
			<div class="form-group col-sm-3">
              <label>Parentesco</label>
              <input type="text" value="" placeholder="" maxlength="50" id="parentesco" name="parentesco" class="form-control">
            </div>
			<div class="form-group col-sm-3">
              <label>Ocupación</label>
              <input type="text" value="" placeholder="" maxlength="50" id="ocupacion" name="ocupacion" class="form-control">
            </div>
			<div class="form-group col-sm-3">
              <label>Instrucción</label>
              <input type="text" value="" placeholder="" maxlength="50" id="instruccion" name="instruccion" class="form-control">
            </div>
            <div class="form-group col-md-1">
              <label></label>
              <a href="javascript:void(0);" onclick="AgregarFamiliar();" class="btn btn-success">Agregar</a>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped nowrap" id="tblfamiliar" style="width:100%">
              <thead>
                <tr>
                  <th>Nombres y Apellidos</th>
                  <th>Edad</th>
                  <th>Parentesco</th>
                  <th>Ocupación</th>
				  <th>Instrucción</th>
				  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
            <div class="form-group col-sm-12">
              <label>Situación de la vivienda</label>
              <textarea class="form-control form-input" id="observacion_vivienda" name="observacion_vivienda"><?php echo set_value('observacion_vivienda', $persona['observacion_vivienda']); ?></textarea>
            </div>
            <div class="form-group col-sm-12">
              <label>Situación de salud</label>
              <textarea class="form-control form-input" id="observacion_salud" name="observacion_salud"><?php echo set_value('observacion_salud', $persona['observacion_salud']); ?></textarea>
            </div>
            <div class="form-group col-sm-12">
              <label>Situación económica</label>
              <textarea class="form-control form-input" id="observacion_economica" name="observacion_economica"><?php echo set_value('observacion_economica', $persona['observacion_economica']); ?></textarea>
            </div>
            <div class="form-group col-sm-12">
              <label>Observaciones</label>
              <textarea class="form-control form-input" id="observacion" name="observacion"><?php echo set_value('observacion', $persona['observacion']); ?></textarea>
            </div>
            <div class="form-group col-sm-12">
              <label>Recomendaciones</label>
              <textarea class="form-control form-input" id="recomendaciones" name="recomendaciones"><?php echo set_value('recomendaciones', $persona['recomendaciones']); ?></textarea>
            </div>
            <div class="form-group col-sm-12">
              <label>Croquis de la casa</label>
              <textarea class="form-control form-input" id="croquis" name="croquis"><?php echo set_value('croquis', $persona['croquis']); ?></textarea>
            </div>
            <div class="form-group col-sm-12">
              <label>Sugerencias</label>
              <textarea class="form-control form-input" id="sugerencias" name="sugerencias"><?php echo set_value('sugerencias', $persona['sugerencias']); ?></textarea>
            </div>
          </div>
			<div class="text-end" style="padding-right: 180px;">
				<div class="text-left" style="float:left;">
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				<a href="javascript:void(0);" class="btn btn-info" onclick="imprimirFichaomaped();">Imprimir</a>
				<a href="<?php echo base_url('personas'); ?>" class="btn btn-danger">Cancelar</a>
			</div>
        </div>
      </div>
    </div>
  </div>
</form>

<style>
	tr.group,
	tr.group:hover {
		background-color: #3abaf4 !important;
	}
	 
	:root.dark tr.group,
	:root.dark tr.group:hover {
		background-color: rgba(0, 0, 0, 0.75) !important;
	}
</style>
<?= $this->endSection('content'); ?>
<?= $this->section('js'); ?>
<script src="<?php echo base_url('assets/js/pages/personas-discapacidad-nuevo.js'); ?>"></script>
<?= $this->endSection('js'); ?>