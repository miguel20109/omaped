<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Historial de Expedientes
<?= $this->endSection('title'); ?>
<?= $this->section('content');?>

<div class="row">
	<div class="col-12 col-md-6 col-lg-12">
		<div class="card card-primary">
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
					<div class="text-left" style="float:left;">
						<button id="load" class="btn btn-danger">Cargar datos</button> 
						<button id="save" class="btn btn-primary">Guardar datos</button>
					</div>
					<span class="text-danger"></span>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 col-md-6 col-lg-12">
		<div class="card card-primary">
		  <div class="card-header">
			<h4>Excel</h4>
		  </div>
		  <div class="card-body">
			<div id="example1" class="ht-theme-main"></div>
		  </div>
		</div>
	</div>
</div>

<style>
	.colored-toast.swal2-icon-success {
	  background-color: #a5dc86 !important;
	}

	.colored-toast.swal2-icon-error {
	  background-color: #f27474 !important;
	}

	.colored-toast.swal2-icon-warning {
	  background-color: #f8bb86 !important;
	}

	.colored-toast.swal2-icon-info {
	  background-color: #3fc3ee !important;
	}

	.colored-toast.swal2-icon-question {
	  background-color: #87adbd !important;
	}

	.colored-toast .swal2-title {
	  color: white;
	}

	.colored-toast .swal2-close {
	  color: white;
	}

	.colored-toast .swal2-html-container {
	  color: white;
	}
</style>

<?= $this->endSection('content'); ?>
<?= $this->section('js'); ?>
	<script src="<?php echo base_url('assets/js/pages/exceleditor-solicitudes.js'); ?>"></script>
<?= $this->endSection('js'); ?>