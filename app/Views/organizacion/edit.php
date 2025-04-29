<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
ORGANIZACIÓN SOCIAL
<?= $this->endSection('title'); ?>

<?= $this->section('content'); ?>
<div class="card card-primary">
    <div class="card-header">
        <h4>DATOS DE LA ORGANIZACIÓN SOCIAL</h4>
    </div>
    <div class="card-body">
        <form action="<?php echo base_url('organizacion/' . $organizacion['ID']); ?>" method="post" autocomplete="off">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" id="id_organizacion" name="id_organizacion" value="<?php echo $organizacion['ID']; ?>">
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Nombre de la organización social</label>
                    <input type="text" value="<?php echo set_value('nom_org', $organizacion['NOMBRE_ORGANIZACION_SOCIAL']); ?>" id="nom_org" name="nom_org" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>Tipo de organización social</label>
                    <select id="cbtipoorganizacion" name="cbtipoorganizacion" class="form-control form-select">
                        <option value="">Seleccionar</option>
                        <?php foreach ($tipoorganizacion as $row) { ?>
                            <option value="<?php echo $row['ID']; ?>" <?= set_select('cbtipoorganizacion', $row['ID'], ($organizacion['IDtipoorganizacionsocial'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                <?php echo $row['Descripcion']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php if (isset($validacion)) { ?>
                        <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-md-6">
                    <label>Denominación de organización social</label>
                    <select id="cbdenomina" name="cbdenomina" class="form-control form-select">
                        <option value="">Seleccionar</option>
                        <?php foreach ($denominacionorganizacion as $row) { ?>
                            <option value="<?php echo $row['ID']; ?>" <?= set_select('cbdenomina', $row['ID'], ($organizacion['IDdenominacionorganizacionsocial'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                <?php echo $row['Descripcion']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php if (isset($validacion)) { ?>
                        <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-md-4">
                    <label>Zonal</label>
                    <select name="cbzonal" class="form-control form-select">
                        <option value="">Seleccionar</option>
                        <?php foreach ($zonal as $row) { ?>
                            <option value="<?php echo $row['ID']; ?>" <?= set_select('cbzonal', $row['ID'], ($organizacion['Zonal'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                <?php echo $row['ID']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php if (isset($validacion)) { ?>
                        <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-md-4">
                    <label>SIOP</label>
                    <input type="text" value="<?php echo set_value('siop', $organizacion['SIOP']); ?>" id="siop_org" name="siop_org" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Fecha de constitución</label>
                    <input type="date" value="<?php echo set_value('fecha_cons', $organizacion['FechaConstitucion']); ?>" id="fecha_cons" name="fecha_cons" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Número de miembros</label>
                    <input type="number" value="<?php echo set_value('num_miem', $organizacion['NumeroMiembros']); ?>" id="num_miem" name="num_miem" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label>Dirección del local de la organización social</label>
                    <input type="text" value="<?php echo set_value('domicilio_org', $organizacion['DireccionLocal']); ?>" id="domicilio_org" name="domicilio_org" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label>Fines de la organización social</label>
                    <textarea class="form-control form-input" id="fines" name="fines"><?php echo set_value('FinesOrganizacionSocial', $organizacion['FinesOrganizacionSocial']); ?></textarea>
                </div>
            </div>
            <div class="text-end">
                <a href="<?php echo base_url('organizacion/' . $organizacion['ID'] . '/juntadirectiva'); ?>" class="btn btn-warning">Ir a directiva</a>
                <a href="javascript:void(0);" class="btn btn-info" onclick="imprimirFicha();">Ficha RUOS</a>
                <a href="<?php echo base_url('organizacion'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<div class="card card-success">
    <div class="card-header">
        <h4>Agregar resolución</h4>
    </div>
    <div class="card-body">
        <form action="<?php echo base_url('organizacion/agregaresolucion'); ?>" method="post" autocomplete="off">
            <?php echo csrf_field(); ?>

            <input type="hidden" id="id_organizacion" name="id_organizacion" value="<?php echo $organizacion['ID']; ?>">
            <div class="row">
                <div class="form-group col-lg-8">
                    <select id="cbresoluciones" name="cbresoluciones" class="form-control form-select">
                        <option value="">Seleccionar Resolución</option>
                        <?php foreach ($resoluciones as $row) { ?>
                            <option value="<?php echo $row['id']; ?>" <?= set_select('cbresoluciones', $row['id']) ?>>
                                <?php echo $row['numero'] . '-' . $row['anio'] . '-' . $row['siglas']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php if (isset($validacion)) { ?>
                        <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-lg-2">
                    <button type="submit" class="btn btn-success">Agregar</button>
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
</div>

<div class="card card-success">
    <div class="card-header">
        <h4>Resoluciones</h4>
    </div>
    <div class="card-body">
        <?php if (!empty(session()->getFlashdata('respuesta'))) { ?>
            <div class="alert alert-<?php echo session()->getFlashdata('respuesta')['type']; ?>">
                <?php echo session()->getFlashdata('respuesta')['msg']; ?>
            </div>
        <?php } ?>
        <div class="table-responsive">
            <table class="table table-striped nowrap table-bordered" id="tblResoluciones" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Item</th>
                        <th class="text-center">Numero</th>
                        <th>Año</th>
                        <th>Vig. Hasta</th>
                        <th>Vigente</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<script src="<?php echo base_url('assets/js/pages/organizacion_res.js'); ?>"></script>
<?= $this->endSection('js'); ?>