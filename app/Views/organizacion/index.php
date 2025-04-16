<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Gestionar Organización Social
<?= $this->endSection('title'); ?>

<?= $this->section('content');

if (verificar('nuevo usuario', $_SESSION['permisos'])) { ?>
    <a href="<?php echo base_url('organizacion/new'); ?>" class="btn btn-primary mb-2">Nuevo</a>
<?php } ?>
<div class="card">
    <div class="card-header">
        <h4>Gestionar Organización Social</h4>
    </div>
    <div class="card-body">
        <?php if (!empty(session()->getFlashdata('respuesta'))) { ?>
            <div class="alert alert-<?php echo session()->getFlashdata('respuesta')['type']; ?>">
                <?php echo session()->getFlashdata('respuesta')['msg']; ?>
            </div>
        <?php } ?>
        <div class="table-responsive">
            <table class="table table-striped nowrap" id="tblOrganizacion" style="width:100%">
                <thead>
                    <tr>
                        <th>Opciones</th>
                        <th class="text-center">Codigo</th>
                        <th>Nombre de Organización</th>
                        <th>Directiva</th>
                        <th>Zonal</th>
                        <th>SIOP/Mankachay</th>
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
<script src="<?php echo base_url('assets/js/pages/organizacion.js'); ?>"></script>
<?= $this->endSection('js'); ?>