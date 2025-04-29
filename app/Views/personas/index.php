<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Gestion clientes
<?= $this->endSection('title'); ?>

<?= $this->section('content');

if (verificar('nuevo personas', $_SESSION['permisos'])) { ?>
    <a href="<?php echo base_url('personas/new'); ?>" class="btn btn-danger mb-2">Nuevo</a>
<?php } ?>

<div class="card">
    <div class="card-header">
        <h4>Gestion personas</h4>
    </div>
    <div class="card-body">
        <?php if (!empty(session()->getFlashdata('respuesta'))) { ?>
            <div class="alert alert-<?php echo session()->getFlashdata('respuesta')['type']; ?>">
                <?php echo session()->getFlashdata('respuesta')['msg']; ?>
            </div>
        <?php } ?>
        <div class="table-responsive">
            <table class="table table-striped nowrap" id="tblPersonas" style="width:100%">
                <thead>
                    <tr>
                        <th>Acciones</th>
                        <th class="text-center">DNI</th>
                        <th>Apellidos y nombres</th>
						<th>Direccion</th>
                        <th>Telefono</th>
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
<script src="<?php echo base_url('assets/js/pages/personas.js'); ?>"></script>
<?= $this->endSection('js'); ?>