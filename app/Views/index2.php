<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />


  <!-- Core CSS -->
<!--
  <link rel="stylesheet" href="https://chapatucuy.pe/app/public/panel/assets/vendor/css/pages/login.css">
  <link rel="stylesheet" href="https://chapatucuy.pe/app/public/panel/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
-->
  <!-- Page CSS -->
  <!-- Page -->
<!--
  <link rel="stylesheet" href="https://chapatucuy.pe/app/public/panel/assets/vendor/css/pages/page-auth.css" />
-->
  <!-- Core CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/login/login.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/login/core.css'); ?>" class="template-customizer-core-css" />

  <!-- Page CSS -->
  <!-- Page -->
  <link rel="stylesheet" href="<?php echo base_url('assets/login/page-auth.css'); ?>" />


</head>

<body>
  <!-- Content -->
  <div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row container-login">
      <!-- /Left Text -->
      <div class="d-none d-lg-flex col-lg-7 p-0 container-presentacion">
        <div class="auth-cover-bg background_blue d-flex justify-content-center align-items-center">
          <img src="<?php echo base_url('assets/img/logo_ruos.png'); ?>" alt="auth-login-cover" class="img-fluid  auth-illustration" />
        </div>
      </div>
      <!-- /Left Text -->

      <!-- Login -->
      <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
        <div class="w-px-400 mx-auto">
          <!-- Logo -->
          <div class="app-brand mb-1">
            <img style="width: 70px; height: 70px;" src="<?php echo base_url('assets/img/logo_ruos2.png'); ?>" alt="">
          </div>
          <!-- /Logo -->
          <h5 class="title-welcome">
            Bienvenido! 👋
          </h5>
          <p class="subtitle-welcome">Por favor Ingrese sus credenciales para ingresar al sistema</p>
          <div id="alertaErroresValidacion" class="alert alert-danger alert-dismissible d-flex align-items-baseline d-none" role="alert">
            <span class="alert-icon alert-icon-lg text-danger me-2">
              <i class="ti ti-alert-circle ti-sm"></i>
            </span>
            <div class="d-flex flex-column ps-1">
              <h5 class="alert-heading mb-2">¡Errores de validación!</h5>
              <ul class="my-0">
              </ul>
              <button id="btnOcultarAlertaErroresValidacion" type="button" class="btn-close" aria-label="Close">
              </button>
            </div>
          </div>
          <?php if (!empty(session()->getFlashdata('respuesta'))) { ?>
            <div class="alert alert-<?php echo session()->getFlashdata('respuesta')['type']; ?>">
              <?php echo session()->getFlashdata('respuesta')['msg']; ?>
            </div>
          <?php } ?>
          <!--<form onsubmit="return false;" class="mb-3" id="frmLogin">-->
          <form method="POST" action="<?= base_url('login'); ?>" autocomplete="off">
            <?= csrf_field() ?>

            <div class="mb-4">
              <!--
              <label for="usuario" class=" label-login">Usuario</label>
              <input name="usuario" maxlength="250" type="email" class="form-control input-height" id="usuario" placeholder="usuario@correo.com" autofocus />
-->
              <label for="email">Usuario</label>
              <input id="email" type="text" class="form-control input-height" name="email" value="<?= set_value('email'); ?>" placeholder="usuario@correo.com" tabindex="1" autofocus>
              <?php if (isset($validator)) { ?>
                <span class="text-danger"><?php echo $validator->getError('email'); ?></span>
              <?php } ?>
            </div>

            <div class="mb-3 form-password-toggle">
              <!--
              <label for="clave" class="label-login">Clave</label>
              <div class="input-group input-group-merge">
                <input type="password" id="clave" name="clave" maxlength="250" class="form-control input-height" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="clave" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
              -->

              <div class="d-block">
                <label for="password" class="control-label">Clave</label>
              </div>
              <input id="password" type="password" class="form-control input-height" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" tabindex="2">
              <?php if (isset($validator)) { ?>
                <span class="text-danger"><?php echo $validator->getError('password'); ?></span>
              <?php } ?>
              <span class="text-danger"><?= session()->getFlashdata('error') ?></span>
            </div>
            <!--
            <div class="mb-3">
              <div class="form-check">
                <input name="recuerdame" class="form-check-input" type="checkbox" id="remember-me" />
                <label class="form-check-label" for="remember-me"> Recuerdame </label>
              </div>
            </div>
              -->
            <!--
            <button id="btnSubmitFormLogin" type="submit" class="btn-login w-100">
              Iniciar Sesión
            </button>
            <button id="btnLoaderFormLogin" class="btn-login w-100 waves-effect waves-light d-none" type="button" disabled="">
              <span class="spinner-border" role="status" aria-hidden="true"></span>
              Procesando...
            </button>
              -->
            <button id="btnSubmitFormLogin" type="submit" class="btn-login w-100" tabindex="4">
              Iniciar Sesión
            </button>
            <button id="btnLoaderFormLogin" class="btn-login w-100 waves-effect waves-light d-none" type="button" disabled="">
              <span class="spinner-border" role="status" aria-hidden="true"></span>
              Procesando...
            </button>
          </form>

        </div>
      </div>
      <!-- /Login -->
    </div>
  </div>

  <!-- / Content -->

</body>

</html>