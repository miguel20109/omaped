<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Gestionar Resoluciones
<?= $this->endSection('title'); ?>

<?= $this->section('content');?>

<div class="card">
    <div class="card-header">
        <h4>Listado de RUOS - Excel</h4>
    </div>
    <div class="card-body">

        <?php if (!empty(session()->getFlashdata('respuesta'))) { ?>
            <div class="alert alert-<?php echo session()->getFlashdata('respuesta')['type']; ?>">
                <?php echo session()->getFlashdata('respuesta')['msg']; ?>
            </div>
        <?php } ?>

        <div class="table-responsive">
            <table class="table table-striped nowrap" id="tblRUOS" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre de Organización</th>
                        <th>Resolución</th>
                        <th>Desde</th>
                        <th>Hasta</th>
                        <th>Dirigente</th>
                        <th>DNI</th>
                        <th>Zonal</th>
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
<script src="<?php echo base_url('assets/js/pages/ruos.js'); ?>"></script>
<?= $this->endSection('js'); ?>