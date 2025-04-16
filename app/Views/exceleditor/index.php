<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Historial de Expedientes
<?= $this->endSection('title'); ?>
<?= $this->section('content');?>

<div class="row">
  <div class="col-12 col-md-6 col-lg-12">
	<div class="card card-primary">
	  <div class="card-header">
		<h4>Botones</h4>
	  </div>
	  <div class="card-body">
			<div class="text-left" style="float:left;">
				<button id="load" class="btn btn-danger">Cargar datos</button> 
				<button id="save" class="btn btn-primary">Guardar datos</button>
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
	<script src="<?php echo base_url('assets/js/pages/exceleditor.js'); ?>"></script>
<?= $this->endSection('js'); ?>