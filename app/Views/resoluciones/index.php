<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Gestionar Resoluciones
<?= $this->endSection('title'); ?>

<?= $this->section('content');

if (verificar('nuevo usuario', $_SESSION['permisos'])) { ?>
    <a href="<?php echo base_url('resoluciones/new'); ?>" class="btn btn-primary mb-2">Nuevo</a>
<?php } ?>
<div class="card">
    <div class="card-header">
        <h4>Gestionar Resoluciones</h4>
    </div>
    <div class="card-body">

        <?php if (!empty(session()->getFlashdata('respuesta'))) { ?>
            <div class="alert alert-<?php echo session()->getFlashdata('respuesta')['type']; ?>">
                <?php echo session()->getFlashdata('respuesta')['msg']; ?>
            </div>
        <?php } ?>

        <div class="table-responsive">
            <table class="table table-striped nowrap" id="tblResoluciones" style="width:100%">
                <thead>
                    <tr>
                        <th>Opciones</th>
                        <th class="text-center">#</th>
                        <th>Numero</th>
                        <th>Año</th>
                        <th>Siglas</th>
                        <th>Vig. desde</th>
                        <th>Vig. hasta</th>
                        <th>Vigente</th>
                        <th>Estado</th>
                        <th>Escaneado</th>
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
<script src="<?php echo base_url('assets/js/pages/resoluciones.js'); ?>"></script>
<?= $this->endSection('js'); ?>