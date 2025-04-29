<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Editar Resolución
<?= $this->endSection('title'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-header">
        <h4>Editar Resolución</h4>
    </div>
    <div class="card-body">
        <form action="<?php echo base_url('resoluciones/' . $resolucion['ID']); ?>" method="post" autocomplete="off">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id_idresolucion" value="<?php echo $resolucion['ID']; ?>">
            <div class="row">
                <div class="form-group col-lg-4">
                    <label>Numero</label>
                    <input type="text" name="numero" class="form-control" value="<?php echo set_value('numero', $resolucion['Numero']); ?>" placeholder="0001" readonly>
                    <?php if (isset($validacion)) { ?>
                        <span class="text-danger"><?php echo $validacion->getError('Numero'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Anio</label>
                    <select name="cbanio" class="form-control">
                        <option value="">Seleccionar</option>
                        <?php foreach ($anios as $row) { ?>
                            <option value="<?php echo $row['ID']; ?>" <?= set_select('cbanio', $row['ID'], ($resolucion['Anio'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                <?php echo $row['ID']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php if (isset($validacion)) { ?>
                        <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                    <?php } ?>
                </div>
                <div class="form-group col-lg-4">
                    <label>Siglas</label>
                    <input type="text" name="siglas" class="form-control" value="<?php echo set_value('siglas', $resolucion['Siglas']); ?>" placeholder="SGPV-GMDSPS/MDC" readonly>
                </div>
                <?php if (isset($validacion)) { ?>
                    <span class="text-danger"><?php echo $validacion->getError('Siglas'); ?></span>
                <?php } ?>
                <div class="form-group col-lg-3">
                    <label>Fecha emisión</label>
                    <input type="date" id="fechaemision" name="fechaemision" class="form-control" value="<?php echo $resolucion['FechaEmision']; ?>">
                </div>
                <div class="form-group col-lg-3">
                    <label>Inicio vigencia</label>
                    <input type="date" id="desdefecha" name="desdefecha" class="form-control" value="<?php echo $resolucion['InicioVigencia']; ?>">
                </div>
                <div class="form-group col-lg-3">
                    <label>Fin vigencia</label>
                    <input type="date" id="hastafecha" name="hastafecha" class="form-control" value="<?php echo $resolucion['FinVigencia']; ?>">
                </div>
                <div class="form-group col-lg-3">
                    <label>Estado</label>
                    <select name="cbestado" class="form-control selected">
                        <option value="">Seleccionar</option>
                        <?php foreach ($estadores as $row) { ?>
                            <option value="<?php echo $row['ID']; ?>" <?= set_select('cbestado', $row['ID'], ($resolucion['Estado'] == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                <?php echo $row['Descripcion']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php if (isset($validacion)) { ?>
                        <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                    <?php } ?>
                </div>
            </div>

            <div class="text-end">
                <a href="<?php echo base_url('resoluciones'); ?>" class="btn btn-danger">Ir a organizacion</a>
                <a href="<?php echo base_url('resoluciones'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection('content'); ?>