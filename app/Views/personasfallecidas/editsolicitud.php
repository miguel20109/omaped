<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Declara Fallecimiento
<?= $this->endSection('title'); ?>
<?= $this->section('content'); ?>

<form action="<?php echo base_url('personasfallecidas/' . $solicitud['ID'] . '/updatesolicitud'); ?>" method="post" autocomplete="off">
	<?php echo csrf_field(); ?>
	<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" id="csrfcode">
	<div class="card">
		<div class="card-header">
			<h4>Solicitud N° <?php echo $solicitud['numero']; ?></h4>
			<div class="badge-outline col-indigo"><?php echo $tramite['Descripcion']; ?></div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="form-group col-lg-4">
					<label>Documento de identidad</label>
						<input type="text" id="dni" name="dni" value="<?php echo set_value('IDsolicitante', $solicitud['IDsolicitante']); ?>" class="form-control" readonly>
				</div>
				<div class="form-group col-lg-8">
					<label>Nombre de solicitante</label>
						<input type="text" id="nombre" name="nombre" value="<?php echo set_value('nombre', $persona['apaterno'].' '.$persona['amaterno'].' '.$persona['nombres']); ?>" class="form-control" readonly>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-md-6 col-lg-6">
			<div class="card">
				<div class="card-header">
					<h4>Datos del expediente</h4>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label>Numero</label>
						<input type="text" id="numero" name="numero" value="<?php echo set_value('numero', $solicitud['expediente']); ?>" class="form-control" maxlength="15">
					</div>
					<div class="form-group">
						<label>Fecha</label>
						<input type="date" id="fecha_exp" name="fecha_exp" value="<?php echo set_value('fecha_exp', $solicitud['fecha_expediente']); ?>" class="form-control">
					</div>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-primary">Guardar</button>
					<a href="<?php echo base_url('personasfallecidas/solicitudes'); ?>" class="btn btn-danger">Cancelar</a>
					
					<a href="<?php echo base_url('personasfallecidas/' . ($solicitud['ID']-1) .'/editsolicitud'); ?>" class="btn btn-danger">Anterior</a>
					<a href="<?php echo base_url('personasfallecidas/' . ($solicitud['ID']+1) .'/editsolicitud'); ?>" class="btn btn-danger">Siguiente</a>
				</div>
			</div>
		</div>

		<div class="col-12 col-md-6 col-lg-6">
			<div class="card">
				<div class="card-header">
					<h4>Datos del pago</h4>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label>Fecha</label>
						<input type="date" id="fecha_pago" name="fecha_pago" value="<?php echo set_value('fecha_pago', $solicitud['fecha_pago']); ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>N° Recibo</label>
						<input type="text" id="recibo" name="recibo" value="<?php echo set_value('recibo', $solicitud['recibo']); ?>" class="form-control" maxlength="12">
					</div>
					<div class="form-group">
						<label>N° Recibos para la autorización de nicho</label>
						<input type="text" id="recibos" name="recibos" value="<?php echo set_value('recibos', $solicitud['recibos']); ?>" class="form-control" maxlength="25">
					</div>
				</div>
			</div>
		</div>
	</div>

</form>

<?= $this->endSection('content'); ?>
<?= $this->section('js'); ?>
<script src="<?php echo base_url('assets/js/pages/personas-fallecidas-edit.js'); ?>"></script>
<?= $this->endSection('js'); ?>