<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Crear Resoluciones
<?= $this->endSection('title'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-header">
        <h4>Crear Resoluciones</h4>
    </div>
    <div class="card-body">
        <form action="<?php echo base_url('resoluciones'); ?>" method="post" autocomplete="off">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="form-group col-lg-4">
                    <label>Resolución inicio</label>
                    <input type="text" name="inicio_numero" class="form-control" value="<?php echo set_value('numero'); ?>" placeholder="0001" >
                    <?php if (isset($validacion)) { ?>
                        <span class="text-danger"><?php echo $validacion->getError('Numero'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Resolución fin</label>
                    <input type="text" name="fin_numero" class="form-control" value="<?php echo set_value('numero'); ?>" placeholder="0050" >
                    <?php if (isset($validacion)) { ?>
                        <span class="text-danger"><?php echo $validacion->getError('Numero'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Anio</label>
                    <select name="cbanio" class="form-control">
                        <option value="">Seleccionar</option>
                        <?php foreach ($anios as $row) { ?>
                            <option value="<?php echo $row['ID']; ?>" <?= set_select('cbanio') ?>>
                                <?php echo $row['ID']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php if (isset($validacion)) { ?>
                        <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Siglas (Ejemplo: SGPV-GMDSPS/MDC)</label>
                    <input type="text" name="siglas" class="form-control" value="<?php echo set_value('siglas'); ?>" placeholder="">
                </div>
                <?php if (isset($validacion)) { ?>
                    <span class="text-danger"><?php echo $validacion->getError('Siglas'); ?></span>
                <?php } ?>
            </div>

            <div class="text-end">
                <a href="<?php echo base_url('resoluciones'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection('content'); ?>