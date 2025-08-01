<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Nueva Persona
<?= $this->endSection('title'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-header">
        <h4>Nueva Persona</h4>
    </div>
    <div class="card-body">
		<form action="<?php echo base_url('personas'); ?>" method="post" autocomplete="off">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id_organizacion" id="id_organizacion" value="">
            <div class="row">
                <div class="col-sm-10">
                    <input hidden="" type="text" name="foto" id="foto" value="">
                    <div class="row">
						<div class="form-group col-md-4">
							<label>Tipo de documento</label>
							<select id="cbtipodocumento" name="cbtipodocumento" class="form-control form-select">
								<option value="0">Seleccionar</option>
								<?php foreach ($tipodocumento as $row) { ?>
                                    <option value="<?php echo $row['ID']; ?>" <?= set_select('cbtipodocumento', $row['ID'], (!empty($row) && $row == $row['ID'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
								<?php } ?>
							</select>
							<?php if (isset($validacion)) { ?>
								<span class="text-danger"><?php echo $validacion->getError('cbtipodocumento'); ?></span>
							<?php } ?>
						</div>
                        <div class="form-group col-sm-4">
                            <label>N° Documento de Identidad</label>
                            <input type="text" placeholder="DNI" maxlength="8" id="dni" name="dni" value="<?php echo set_value('dni'); ?>" onkeyup="buscarDni()" class="form-control">
							<?php if (isset($validacion)) { ?>
								<span class="text-danger"><?php echo $validacion->getError('dni'); ?></span>
							<?php } ?>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nombres</label>
                            <input type="text" placeholder="Nombres" id="nombre" name="nombre" value="<?php echo set_value('nombre'); ?>" class="form-control">
							<?php if (isset($validacion)) { ?>
								<span class="text-danger"><?php echo $validacion->getError('nombre'); ?></span>
							<?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Apellido paterno</label>
                            <input type="text" placeholder="Apellido paterno" id="apellido_pat" name="apellido_pat" value="<?php echo set_value('apellido_pat'); ?>" class="form-control">
							<?php if (isset($validacion)) { ?>
								<span class="text-danger"><?php echo $validacion->getError('apellido_pat'); ?></span>
							<?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Apellido materno</label>
                            <input type="text" placeholder="Apellido materno" id="apellido_mat" name="apellido_mat" value="<?php echo set_value('apellido_mat'); ?>" class="form-control">
							<?php if (isset($validacion)) { ?>
								<span class="text-danger"><?php echo $validacion->getError('apellido_mat'); ?></span>
							<?php } ?>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Estado civil</label>
                            <input type="text" value="" placeholder="Estado civil" id="estado_civil" name="estado_civil" class="form-control" readonly>
                        </div>
						<div class="form-group col-md-3">
							<label>Sexo</label>
							<select name="cbsexo" class="form-control form-select">
								<option value="">Seleccionar</option>
								<?php foreach ($sexo as $row) { ?>
									<option value="<?php echo $row['ID']; ?>" <?= set_select('cbsexo', $row['ID'], (!empty($row) && $row == $row['ID'] ? true : false)) ?>>
										<?php echo $row['Descripcion']; ?>
									</option>
								<?php } ?>
							</select>
							<?php if (isset($validacion)) { ?>
								<span class="text-danger"><?php echo $validacion->getError('cbsexo'); ?></span>
							<?php } ?>
						</div>
                        <div class="form-group col-md-3">
                            <label>Fecha de Nacimiento</label>
							<input type="date" id="fechanacimiento" name="fechanacimiento" class="form-control" value="">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Edad</label>
							<input type="text" id="edad" name="edad" class="form-control" value="" readonly>
                        </div>
                <div class="form-group col-md-4">
                    <label>Departamento(nacimiento)</label>
                    <select id="cbregion" name="cbregion" class="form-control form-select">
                        <option value="0">Seleccionar</option>
                        <?php foreach ($cbregion as $row) { ?>
                            <option value="<?php echo $row['ID']; ?>" <?= set_select('cbregion', $row['ID'], (!empty($row) && $row == $row['ID'] ? true : false)) ?>>
                                <?php echo $row['region']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php if (isset($validacion)) { ?>
                        <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-md-4">
                    <label>Provincia(nacimiento)</label>
                    <select id="cbprovincia" name="cbprovincia" class="form-control form-select">
                        <option value="0">Seleccionar</option>
                        <?php foreach ($cbprovincia as $row) { ?>
                            <option value="<?php echo $row['ID']; ?>" <?= set_select('cbprovincia', $row['ID'], (!empty($row) && $row == $row['ID'] ? true : false)) ?>>
                                <?php echo $row['provincia']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php if (isset($validacion)) { ?>
                        <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-md-4">
                    <label>Distrito(nacimiento)</label>
                    <select id="cbdistrito" name="cbdistrito" class="form-control form-select">
                        <option value="0">Seleccionar</option>
                        <?php foreach ($cbdistrito as $row) { ?>
                            <option value="<?php echo $row['ID']; ?>" <?= set_select('cbdistrito', $row['ID'], (!empty($row) && $row == $row['ID'] ? true : false)) ?>>
                                <?php echo $row['distrito']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php if (isset($validacion)) { ?>
                        <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                    <?php } ?>
                </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" placeholder="" id="direccion" name="direccion" class="form-control"  value="<?php echo set_value('direccion'); ?>">
                        </div>
                        <div class="form-group">
                            <label>Referencia</label>
                            <input type="text" placeholder="" id="referencia" name="referencia" class="form-control"  value="<?php echo set_value('referencia'); ?>">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Ubigeo</label>
                            <input type="text" value="" placeholder="" id="ubigeo" name="ubigeo" class="form-control" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Restriccion</label>
                            <input type="text" value="" placeholder="" id="restriccion" name="restriccion" class="form-control" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Telefono</label>
                            <input type="text" value="" placeholder="Telefono" maxlength="9" id="telefono" name="telefono" class="form-control">
                        </div>
                        <div class="form-group col-md-8">
                            <label>Correo electronico</label>
                            <input type="text" value="" placeholder="Correo" id="correo" name="correo" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-2">
                    <img id="imgElem" style="width: 100%;border: solid 2px #ddd;border-radius: 5px;" src="<?php echo base_url(); ?>img_dni/anonymous.png">
                </div>
            </div>
            <div class="text-end"  style="padding-right: 180px;">
                <a href="<?php echo base_url('personas'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>

	document.addEventListener('DOMContentLoaded', function () {
		$("#cbtiporegistro").change(function(){
			//alert("The text has been changed.");
			
		});
				
		$('#cbregion').change(function () {

			var cbregion = $('#cbregion').val();
			var url = base_url + 'personas/'+cbregion+'/cbprovincia';

			$.ajax({
				url: url,
				dataType: "json",
				success: function (data) {
					let html = "<option value='0'>Seleccionar</option>";
					if (data.length > 0) {
						$.each(data, function(i, item) {
							html = html + "<option value=" + item.ID + ">" + item.provincia + "</option>";
						});
						$('#cbprovincia').html(html);
					}
				}
			});

		});

		$('#cbprovincia').change(function () {

			var cbprovincia = $('#cbprovincia').val();
			var url = base_url + 'personas/'+cbprovincia+'/cbdistrito';

			$.ajax({
				url: url,
				dataType: "json",
				success: function (data) {
					let html = "<option value='0'>Seleccionar</option>";
					if (data.length > 0) {
						$.each(data, function(i, item) {
							html = html + "<option value=" + item.ID + ">" + item.distrito + "</option>";
						});
						$('#cbdistrito').html(html);
					}
				}
			});

		});
	});

	function buscarDni() {

		var dni = $("#dni").val();
		var cbtipodocumento = $("#cbtipodocumento").val();

		if (dni.length == 8 && cbtipodocumento == '3') {
			BuscarPersonaDNI(dni);
		} else {
			//limpiar_propietario();
			//bloquear_datosPropietario('0');
		}
	}

    function BuscarPersonaDNI(dni) {

        $.ajax({
            url: base_url + 'personas/' + dni + '/consultarpide',
            type: 'GET',
            data: {
                dni: dni
            },
            beforeSend: function(e) {
                //  $('#load').addClass('load');
            },
            success: function(data) {

                var datosPersona = JSON.parse(data);

                //if (c.valor.return.coResultado = '0000') {
                //if (data.DNI != null) {
                // bloquear_datosPropietario('1');
                $('#nombre').val(datosPersona.nombres);
                $('#apellido_pat').val(datosPersona.apaterno);
                $('#apellido_mat').val(datosPersona.amaterno);
                $('#direccion').val(datosPersona.direccion);
                $('#ubigeo').val(datosPersona.ubigeo);
				$('#estado_civil').val(datosPersona.estado_civil);
				$('#restriccion').val(datosPersona.restriccion);
                $('#foto').val(datosPersona.foto);

                var baseStr64 = datosPersona.foto;
                imgElem.setAttribute('src', "data:image/png;base64," + baseStr64);

                $("#apellido_pat").addClass("is-valid");
                $("#apellido_mat").addClass("is-valid");
                $("#cbcargos").addClass("is-invalid");
                $("#cbresoluciones").addClass("is-invalid");
            }
        });
    }
</script>

<?= $this->endSection('content'); ?>