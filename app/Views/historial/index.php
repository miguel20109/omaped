<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Historial de Expedientes
<?= $this->endSection('title'); ?>

<?= $this->section('content');?>

<div class="card">
    <div class="card-header">
        <h4>Historial de Expedientes</h4>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped nowrap" id="tblHistorial" style="width:100%">
                <thead>
                    <tr>
                        <th>Nicho</th>
						<th>Inhumacion</th>
						<th>Fecha</th>
						<th>Solicitante</th>
						<th>Celular</th>
						<th>Difunta(o)</th>
						<th>Fecha fallec.</th>
						<th>Cementerio</th>
						<th>Recibo nicho</th>
						<th>Recibo inhumacion</th>
						<th>Fecha pago</th>
						<th>Importe</th>
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
<script src="<?php echo base_url('assets/js/pages/historial.js'); ?>"></script>
<?= $this->endSection('js'); ?>