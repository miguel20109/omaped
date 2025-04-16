<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
Datos de la empresa
<?= $this->endSection('title'); ?>
<?= $this->section('content'); ?>

<div class="row ">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Fallecidos</h5>
                                <h2 class="mb-3 font-18"><?php echo $fallecidos; ?></h2>
                                <!--<p class="mb-0"><span class="col-green">10%</span> 2025</p>-->
								<p class="mb-0"><span class="col-green">2025</span></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                                <img src="https://www.einfosoft.com/templates/admin/otika/source/light/assets/img/banner/1.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">19 de Julio</h5>
                                <h2 class="mb-3 font-18"><?php echo $cementerio1; ?></h2>
                                <p class="mb-0"><span class="col-orange"><?php echo $porcen1; ?>%</span> Porciento</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                                <img src="https://www.einfosoft.com/templates/admin/otika/source/light/assets/img/banner/2.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Luz Eterna</h5>
                                <h2 class="mb-3 font-18"><?php echo $cementerio2; ?></h2>
                                <p class="mb-0"><span class="col-orange"><?php echo $porcen2; ?>%</span> Porciento</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                                <img src="https://www.einfosoft.com/templates/admin/otika/source/light/assets/img/banner/3.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row ">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <h5 class="font-15">Paz Libertad</h5>
                                <h2 class="mb-3 font-18"><?php echo $cementerio3; ?></h2>
                                <p class="mb-0"><span class="col-orange"><?php echo $porcen3; ?>%</span> Porciento</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="banner-img">
                                <img src="https://www.einfosoft.com/templates/admin/otika/source/light/assets/img/banner/4.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty(session()->getFlashdata('respuesta'))) { ?>
    <div class="alert alert-<?php echo session()->getFlashdata('respuesta')['type']; ?>">
        <?php echo session()->getFlashdata('respuesta')['msg']; ?>
    </div>
<?php } ?>
<!--
        <div class="row ">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Usuarios</h5>
                                        <h2 class="mb-3 font-18"><?php echo $usuarios; ?></h2>
                                        <a class="mb-0" href="<?php echo base_url('usuarios'); ?>">VER DETALLE</a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="<?php echo base_url('assets/img/admin/usuario.png'); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Clientes</h5>
                                        <h2 class="mb-3 font-18"><?php echo $clientes; ?></h2>
                                        <a class="mb-0" href="<?php echo base_url('clientes'); ?>">VER DETALLE</a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="<?php echo base_url('assets/img/admin/cliente.png'); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Prestamos</h5>
                                        <h2 class="mb-3 font-18"><?php echo $prestamos; ?></h2>
                                        <a class="mb-0" href="<?php echo base_url('prestamos/historial'); ?>">VER DETALLE</a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="<?php echo base_url('assets/img/admin/prestamo.png'); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Saldo</h5>
                                        <h2 class="mb-3 font-18"><?php echo $cajas['decimales']['saldo']; ?></h2>
                                        <a class="mb-0" href="<?php echo base_url('cajas'); ?>">VER DETALLE</a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="<?php echo base_url('assets/img/admin/saldo.png'); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->
<div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <h4>Reporte</h4>
                    <select class="form-select" id="year">
                        <?php $anio = date('Y');
                        for ($i = 2025; $i <= $anio; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php echo ($anio == $i) ? 'selected' : ''; ?>>
                                <?php echo $i; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div id="prestamos" class="chartsh"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <h4>Reportexxxxx</h4>
                    <select class="form-select" id="year">
                        <?php $anio = date('Y');
                        for ($i = 2025; $i <= $anio; $i++) { ?>
                            <option value="<?php echo $i; ?>" <?php echo ($anio == $i) ? 'selected' : ''; ?>>
                                <?php echo $i; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div id="cementerios" class="chartsh"></div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<script src="<?php echo base_url('assets/bundles/apexcharts/apexcharts.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/pages/home.js'); ?>"></script>
<?= $this->endSection('js'); ?>