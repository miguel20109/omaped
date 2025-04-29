<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Declara Fallecimiento
<?= $this->endSection('title'); ?>
<?= $this->section('content'); ?>

<form action="<?php echo base_url('personasfallecidas/' . $persona['DNI']); ?>" method="post" autocomplete="off">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrfcode">
    <div class="card card-primary">
        <div class="card-header">
            <h4>DATOS DEL DIFUNTO</h4>
        </div>
        <div class="card-body">
            <input type="hidden" name="_method" value="PUT">
            <div class="row">
                <div class="col-sm-10">
                    <input hidden="" type="text" name="foto" id="foto" value="">
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label>N° Documento del Difunto</label>
                            <input type="text" value="<?php echo set_value('DNI', $persona['DNI']); ?>" placeholder="DNI" maxlength="8" id="dni" name="dni" onkeyup="" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-9">
                            <label>Nombres del Difunto</label>
                            <input type="text" value="<?php echo set_value('nombres', $persona['apaterno'] . ' ' . $persona['amaterno'] . ' ' . $persona['nombres']); ?>" placeholder="Nombres" id="nombre" name="nombre" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Fecha de Fallecimiento</label>
                            <input type="date" id="fechafallecimiento" name="fechafallecimiento" class="form-control" value="<?php echo set_value('fecha_fallecimiento', $persona['fecha_fallecimiento']); ?>" readonly>
                        </div>
                        <div class="form-group col-md-9">
                            <label>Dirección</label>
                            <input type="text" value="<?php echo set_value('direccion', $persona['direccion']); ?>" placeholder="" id="direccion" name="direccion" class="form-control" readonly>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>N° Documento del Declarante</label>
                            <input type="text" value="<?php echo set_value('dni_declarante', $fallecidos['IDdeclarante']); ?>" placeholder="DNI" maxlength="8" id="dni_declarante" name="dni_declarante" onkeyup="" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-7">
                            <label>Nombres del Declarante</label>
                            <input type="text" value="<?php echo set_value('declarante_nombres', $fallecidos['declarante']); ?>" placeholder="Nombres" id="declarante_nombres" name="declarante_nombres" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Telefono</label>
                            <input type="text" value="<?php echo set_value('telefono', $fallecidos['telefono']); ?>" placeholder="Telefono" id="telefono" name="telefono" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cementerio</label>
                            <select name="cbcementerio" id="cbcementerio" class="form-control form-select is-invalid">
                                <option value="0">Seleccionar</option>
                                <?php foreach ($cementerios as $row) { ?>
                                    <option value="<?php echo $row['ID']; ?>" <?= set_select('cbcementerio', $row['ID'], ($fallecidos['IDcementerio'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Lugar de fallecimiento</label>
                            <select name="cblugar" id="cblugar" class="form-control form-select is-invalid">
                                <option value="0">Seleccionar</option>
                                <?php foreach ($lugar as $row) { ?>
                                    <option value="<?php echo $row['ID']; ?>" <?= set_select('cblugar', $row['ID'], ($fallecidos['IDlugar'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Procedencia del cadáver</label>
                            <input type="text" value="<?php echo set_value('procedencia', $fallecidos['procedencia']); ?>" placeholder="Procedencia" id="procedencia" name="procedencia" class="form-control is-invalid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-danger">
        <div class="card-header">
            <h4>UBICACION DEL DIFUNTO</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-10">
					<div class="form-group col-md-8">
						<label>Croquis suscrito por el encargado del cementerio</label>
						<select name="cbusuarios" id="cbusuarios" class="form-control form-select is-invalid">
							<option value="0">Seleccionar</option>
							<?php foreach ($usuarios as $row) { ?>
								<option value="<?php echo $row['id']; ?>" <?= set_select('cbusuarios', $row['id'], ($ubicacion['IDencargado'] == $row['id'] || $row == $row['id'] ? true : false)) ?>>
									<?php echo $row['nombre'].' '.$row['apellido']; ?>
								</option>
							<?php } ?>
						</select>
						<?php if (isset($validacion)) { ?>
							<span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
						<?php } ?>
					</div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <b>Punto de referencia</b>
                        </div>
                        <div class="form-group col-md-4">
                            <b>Pabellón</b>
                        </div>
                        <div class="form-group col-md-4">
                            <b>Nicho</b>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Subiendo</label>
                            <input type="text" value="<?php echo set_value('subiendo', $ubicacion['subiendo']); ?>" placeholder="Subiendo" id="subiendo" name="subiendo" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Columna</label>
                            <input type="text" value="<?php echo set_value('columna', $ubicacion['columna']); ?>" placeholder="Columna" id="columna" name="columna" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Largo</label>
                            <input type="text" value="<?php echo set_value('largo', $ubicacion['largo']); ?>" placeholder="Largo" id="largo" name="largo" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Izquierda</label>
                            <input type="text" value="<?php echo set_value('izquierda', $ubicacion['izquierda']); ?>" placeholder="Izquierda" id="izquierda" name="izquierda" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Nivel</label>
                            <input type="text" value="<?php echo set_value('nivel', $ubicacion['nivel']); ?>" placeholder="Nivel" id="nivel" name="nivel" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Ancho</label>
                            <input type="text" value="<?php echo set_value('ancho', $ubicacion['ancho']); ?>" placeholder="Ancho" id="ancho" name="ancho" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Derecha</label>
                            <input type="text" value="<?php echo set_value('derecha', $ubicacion['derecha']); ?>" placeholder="Derecha" id="derecha" name="derecha" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Lugar de sepultura</label>
                            <select name="cbsepultura" class="form-control form-select is-invalid">
                                <option value="0">Seleccionar</option>
                                <?php foreach ($sepultura as $row) { ?>
                                    <option value="<?php echo $row['ID']; ?>" <?= set_select('cbsepultura', $row['ID'], ($ubicacion['IDsepultura'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Alto</label>
                            <input type="text" value="<?php echo set_value('alto', $ubicacion['alto']); ?>" placeholder="Alto" id="alto" name="alto" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-left" style="float:left;">
                <a href="javascript:void(0);" onclick="GenerarOrden();" class="btn btn-dark">Generar orden de inhumación</a>
            </div>
            <div class="text-end" style="padding-right: 180px;">
                <a href="<?php echo base_url('personasfallecidas'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
</form>
</div>
</div>
</form>

<div class="col-12 col-sm-6 col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>Documentos</h4>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills" id="myTab2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab2" data-bs-toggle="tab" href="#home2" role="tab"
                        aria-controls="home" aria-selected="true">Croquis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab2" data-bs-toggle="tab" href="#profile2" role="tab"
                        aria-controls="profile" aria-selected="false">Ordenes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab2" data-bs-toggle="tab" href="#contact2" role="tab"
                        aria-controls="contact" aria-selected="false">Solicitudes</a>
                </li>
            </ul>
            <div class="tab-content" id="myTab3Content">
                <div class="tab-pane fade" id="home2" role="tabpanel" aria-labelledby="home-tab2">

                    <div class="card-header">
                        <h4>Generar croquis de ubicación para:</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('personasfallecidas/generacroquis'); ?>" method="post" autocomplete="off">
                            <?php echo csrf_field(); ?>

                            <input type="hidden" id="dni_difunto" name="dni_difunto" value="<?php echo $persona['DNI']; ?>">
                            <input type="hidden" id="dni_solicitante" name="dni_solicitante" value="<?php echo $fallecidos['IDdeclarante']; ?>">
                            <input type="hidden" id="id_cementerio" name="id_cementerio" value="<?php echo $fallecidos['IDcementerio']; ?>">
                            <div class="row">
                                <div class="form-group col-lg-8">
                                    <select id="cbtramite_croquis" name="cbtramite_croquis" class="form-control form-select">
                                        <option value="0">Seleccionar el tramite</option>
                                        <?php foreach ($tramite as $row) { ?>
                                            <option value="<?php echo $row['ID']; ?>" <?= set_select('cbtramite_croquis', $row['ID']) ?>>
                                                <?php echo $row['Descripcion']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php if (isset($validacion)) { ?>
                                        <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-lg-2">
                                    <button type="submit" class="btn btn-success">Generar croquis</button>
                                </div>
                                <?php //if (isset($validacion)) { 
                                ?>
                                <span class="text-danger"><?php //echo $validacion->getError('Siglas'); 
                                                            ?></span>
                                <?php //} 
                                ?>
                            </div>
                        </form>
                    </div>

                    <div class="card-header">
                        <h4>Listado de croquis</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty(session()->getFlashdata('respuesta'))) { ?>
                            <div class="alert alert-<?php echo session()->getFlashdata('respuesta')['type']; ?>">
                                <?php echo session()->getFlashdata('respuesta')['msg']; ?>
                            </div>
                        <?php } ?>
                        <div class="table-responsive">
                            <table class="table table-striped nowrap table-bordered" id="tblTramite" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Numero</th>
                                        <th>Solicitante</th>
                                        <th>Tramite</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade show active" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">

                    <div class="card-header">
                        <h4>Listado de ordenes</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty(session()->getFlashdata('respuesta'))) { ?>
                            <div class="alert alert-<?php echo session()->getFlashdata('respuesta')['type']; ?>">
                                <?php echo session()->getFlashdata('respuesta')['msg']; ?>
                            </div>
                        <?php } ?>
                        <div class="table-responsive">
                            <table class="table table-striped nowrap table-bordered" id="tblOrdenes" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Numero</th>
                                        <th>Declarante</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
                <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact-tab2">

                    <div class="card-header">
                        <h4>Generar solicitud:</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('personasfallecidas/generasolicitud'); ?>" onsubmit="return validaTipoTramite()" method="post" autocomplete="off">
                            <?php echo csrf_field(); ?>

                            <input type="hidden" id="dni_difunto" name="dni_difunto" value="<?php echo $persona['DNI']; ?>">
                            <input type="hidden" id="dni_solicitante" name="dni_solicitante" value="<?php echo $fallecidos['IDdeclarante']; ?>">
                            <input type="hidden" id="id_cementerio" name="id_cementerio" value="<?php echo $fallecidos['IDcementerio']; ?>">
                            <input type="hidden" id="id_sepultura" name="id_sepultura" value="<?php echo $ubicacion['IDsepultura']; ?>">
                            <div class="row">
                                <div class="form-group col-lg-8">
                                    <select id="cbtramite" name="cbtramite" class="form-control form-select is-invalid">
                                        <option value="0">Seleccionar el tramite</option>
                                        <?php foreach ($tramite as $row) { ?>
                                            <option value="<?php echo $row['ID']; ?>" <?= set_select('cbtramite', $row['ID']) ?>>
                                                <?php echo $row['Descripcion']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <?php if (isset($validacion)) { ?>
                                        <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-lg-2">
                                    <button type="submit" class="btn btn-success">Generar solicitud</button>
                                </div>
                                <?php //if (isset($validacion)) { 
                                ?>
                                <span class="text-danger"><?php //echo $validacion->getError('Siglas'); 
                                                            ?></span>
                                <?php //} 
                                ?>
                            </div>
                        </form>
                    </div>

                    <div class="card-header">
                        <h4>Listado de solicitudes</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty(session()->getFlashdata('respuesta'))) { ?>
                            <div class="alert alert-<?php echo session()->getFlashdata('respuesta')['type']; ?>">
                                <?php echo session()->getFlashdata('respuesta')['msg']; ?>
                            </div>
                        <?php } ?>
                        <div class="table-responsive">
                            <table class="table table-striped nowrap table-bordered" id="tblSolicitudes" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Numero</th>
                                        <th>Solicitante</th>
                                        <th>Tramite</th>
                                        <th>#</th>
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
    </div>
</div>

</div>
<?= $this->endSection('content'); ?>
<?= $this->section('js'); ?>
<script src="<?php echo base_url('assets/js/pages/personas-fallecidas-edit.js'); ?>"></script>
<?= $this->endSection('js'); ?>