<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Listar solicitudes
<?= $this->endSection('title'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h4>Busqueda:</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-lg-2">
                <select id="cbanio" name="cbanio" class="form-control form-select">
                    <?php foreach ($anios as $row) { ?>
                        <option value="<?php echo $row['ID']; ?>" <?= set_select('cbanio', $row['ID'], ($anio == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                            <?php echo $row['ID']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-lg-2">
                <select id="cbmes" name="cbmes" class="form-control form-select">
                    <?php foreach ($meses as $row) { ?>
                        <option value="<?php echo str_pad($row['ID'], 2, "0", STR_PAD_LEFT); ?>" <?= set_select('cbmes', $row['ID'], ($mes == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                            <?php echo $row['mes']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-lg-6">
                <select id="cbtramite" name="cbtramite" class="form-control form-select">
                    <?php foreach ($tramite as $row) { ?>
                        <option value="<?php echo $row['ID']; ?>" <?= set_select('cbtramite', $row['ID']) ?>>
                            <?php echo $row['Descripcion']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-lg-2">
                <a href="javascript:void(0);" onclick="ListarSolicitudes();" class="btn btn-success">Buscar</a>
            </div>
            <div class="form-group col-lg-2">
                <a href="javascript:void(0);" onclick="ImprimirSolicitudes();" class="btn btn-info">Reporte</a>
            </div>
            <span class="text-danger"></span>
        </div>
    </div>
    <div class="card-header">
        <h4>Listar solicitudes</h4>
    </div>
    <div class="card-body">
        <?php if (!empty(session()->getFlashdata('respuesta'))) { ?>
            <div class="alert alert-<?php echo session()->getFlashdata('respuesta')['type']; ?>">
                <?php echo session()->getFlashdata('respuesta')['msg']; ?>
            </div>
        <?php } ?>
        <div class="table-responsive">
            <table class="table table-striped nowrap" id="tblFallecidos" style="width:100%">
                <thead>
                    <tr>
                        <th>Acciones</th>
                        <th class="text-center">Numero</th>
                        <th>Tramite</th>
                        <th>Solicitante</th>
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
<script src="<?php echo base_url('assets/js/pages/personas-fallecidas-solicitudes.js'); ?>"></script>
<?= $this->endSection('js'); ?>