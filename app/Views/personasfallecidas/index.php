<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Registro de fallecidos
<?= $this->endSection('title'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-header">
        <h4>Registro de fallecidos</h4>
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
                        <th class="text-center">DNI</th>
                        <th>Difunto(a)</th>
                        <th>Declarante</th>
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
<script src="<?php echo base_url('assets/js/pages/personas-fallecidas.js'); ?>"></script>
<?= $this->endSection('js'); ?>