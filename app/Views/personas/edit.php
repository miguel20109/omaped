<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Editar Persona
<?= $this->endSection('title'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-header">
        <h4>I. DATOS PERSONALES - Editar Persona</h4>
    </div>
    <div class="card-body">
        <form action="<?php echo base_url('personas/' . $persona['DNI']); ?>" method="post" autocomplete="off">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <div class="row">
                <div class="col-sm-10">
                    <input hidden="" type="text" name="foto" id="foto" value="">
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
                            <input type="text" value="<?php echo set_value('nombres', $persona['nombres']); ?>" placeholder="Nombres" id="nombre" name="nombre" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Apellido paterno</label>
                            <input type="text" value="<?php echo set_value('apaterno', $persona['apaterno']); ?>" placeholder="Apellido paterno" id="apellido_pat" name="apellido_pat" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Apellido materno</label>
                            <input type="text" value="<?php echo set_value('amaterno', $persona['amaterno']); ?>" placeholder="Apellido materno" id="apellido_mat" name="apellido_mat" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Estado civil</label>
                            <input type="text" value="<?php echo set_value('estado_civil', $persona['estado_civil']); ?>" placeholder="Estado civil" id="estado_civil" name="estado_civil" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Sexo</label>
                            <select name="cbsexo" class="form-control form-select">
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
                            <input type="date" id="fechanacimiento" name="fechanacimiento" class="form-control" value="<?php echo set_value('fecha_nacimiento', $persona['fecha_nacimiento']); ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Edad</label>
                            <input type="date" id="fechafallecimiento" name="fechafallecimiento" class="form-control" value="<?php echo set_value('fecha_fallecimiento', $persona['fecha_fallecimiento']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" value="<?php echo set_value('direccion', $persona['direccion']); ?>" placeholder="" id="direccion" name="direccion" class="form-control" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Ubigeo</label>
                            <input type="text" value="<?php echo set_value('ubigeo', $persona['ubigeo']); ?>" placeholder="" id="ubigeo" name="ubigeo" class="form-control" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Restriccion</label>
                            <input type="text" value="<?php echo set_value('restriccion', $persona['restriccion']); ?>" placeholder="" id="restriccion" name="restriccion" class="form-control" readonly>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Telefono</label>
                            <input type="text" value="<?php echo set_value('telefono', $persona['telefono']); ?>" placeholder="Telefono" maxlength="9" id="telefono" name="telefono" class="form-control">
                        </div>
                        <div class="form-group col-md-8">
                            <label>Correo electronico</label>
                            <input type="text" value="<?php echo set_value('correo', $persona['correo']); ?>" placeholder="Correo" id="correo" name="correo" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-2">
                    <img id="imgElem" style="width: 100%;border: solid 2px #ddd;border-radius: 5px;" src="<?php echo base_url(); ?>img_dni/anonymous.png">
                </div>
            </div>
            <!--<div class="text-left" style="float:left;">
                <a href="javascript:void(0);" onclick="DeclararFallecimiento();" class="btn btn-success">Declarar fallecimiento</a>
            </div>-->
            <div class="text-end" style="padding-right: 180px;">
                <a href="<?php echo base_url('personas'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<script>
    async function DeclararFallecimiento() {

        var dni = $('#dni').val();
        var nombre_completo = $('#nombre').val() + ' ' + $('#apellido_pat').val() + ' ' + $('#apellido_mat').val();

        const today = (new Date()).toISOString();
        const inputValue = today.split("T")[0];

        const {
            value: date
        } = await Swal.fire({
            title: "Ingrese la fecha de fallecimiento",
            input: "date",
            inputValue,
            didOpen: () => {
                Swal.getInput().max = inputValue;
            },
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return "Tienes que ingresar la fecha de fallecimiento!";
                }
            },
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#fc544b',
        })

        const {
            value: declarante
        } = await Swal.fire({
            title: "DNI Declarante",
            input: "text",
            inputPlaceholder: "Ingrese el DNI del declarante",
            inputAttributes: {
                maxlength: 8
            },
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return "Tienes que ingresar el DNI del declarante!";
                }
            },
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#fc544b',
        });

        /*		
        		console.log(date);
        		console.log(declarante);
        */
        if (date || declarante) {

            var fecha = date.replace('-', '').replace('-', '');

            Swal.fire({
                title: ``,
                text: `Esta seguro de declara el fallecimiento de ${ nombre_completo }?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#54ca68',
                cancelButtonColor: '#fc544b',
                confirmButtonText: 'Si, declarar fallecimiento'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: base_url + 'personasfallecidas/' + dni + '/' + declarante + '/' + fecha + '/declarar',
                        method: "GET",
                        success: function(data) {
                            console.log(data);
                        }
                    });
                }
            })
        };
    }
</script>

<?= $this->endSection('content'); ?>