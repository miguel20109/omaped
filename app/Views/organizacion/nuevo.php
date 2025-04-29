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
        <form action="<?php echo base_url('organizacion'); ?>" method="post" autocomplete="off">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Nombre de la organización social</label>
                    <input type="text" value="<?php echo set_value('nom_org'); ?>" id="nom_org" name="nom_org" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label>Tipo de organización social</label>
                    <select id="cbtipoorganizacion" name="cbtipoorganizacion" class="form-control form-select">
                        <option value="">Seleccionar</option>
                        <?php foreach ($tipoorganizacion as $row) { ?>
                            <option value="<?php echo $row['ID']; ?>" <?= set_select('cbtipoorganizacion', $row['ID'], (!empty($row) && $row == $row['ID'] ? true : false)) ?>>
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
                            <option value="<?php echo $row['ID']; ?>" <?= set_select('cbdenomina', $row['ID'], (!empty($row) && $row == $row['ID'] ? true : false)) ?>>
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
                            <option value="<?php echo $row['ID']; ?>" <?= set_select('cbzonal', $row['ID'], (!empty($row) && $row == $row['ID'] ? true : false)) ?>>
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
                    <input type="text" value="<?php echo set_value('siop_org'); ?>" id="siop_org" name="siop_org" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Fecha de constitución</label>
                    <input type="date" value="<?php echo set_value('fecha_cons'); ?>" id="fecha_cons" name="fecha_cons" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Número de miembros</label>
                    <input type="number" value="<?php echo set_value('num_miem'); ?>" id="num_miem" name="num_miem" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label>Dirección del local de la organización social</label>
                    <input type="text" value="<?php echo set_value('domicilio_org'); ?>" id="domicilio_org" name="domicilio_org" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label>Fines de la organización social</label>
                    <textarea class="form-control form-input" id="fines" name="fines"><?php echo set_value('fines'); ?></textarea>
                </div>
            </div>
            <div class="text-end">
                <a href="<?php echo base_url('organizacion'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<script src="<?php echo base_url('assets/js/pages/organizacion_res.js'); ?>"></script>
<?= $this->endSection('js'); ?>
