<?= $this->extend('layouts/main'); ?>
<?= $this->section('title'); ?>
ORGANIZACIÓN SOCIAL
<?= $this->endSection('title'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-header">
        <h4><?php echo $organizacion['ID'] . '-' . $organizacion['nombre_organizacion_social']; ?></h4>
    </div>
    <div class="card-body">
        <form action="<?php echo base_url('organizacion/agregardirectiva'); ?>" method="post" autocomplete="off">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id_organizacion" id="id_organizacion" value="<?php echo $organizacion['ID']; ?>">
            <div class="row">
                <div class="col-sm-10">
                    <input hidden="" type="text" name="foto" id="foto" value="">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>DNI</label>
                            <input type="text" value="" placeholder="DNI" maxlength="8" id="dni" name="dni" onkeyup="buscarDni()" class="form-control">
                        </div>
                        <div class="form-group col-md-8">
                            <label>Nombres</label>
                            <input type="text" value="" placeholder="Nombres" id="nombre" name="nombre" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Apellido paterno</label>
                            <input type="text" value="" placeholder="Apellido paterno" id="apellido_pat" name="apellido_pat" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Apellido materno</label>
                            <input type="text" value="" placeholder="Apellido materno" id="apellido_mat" name="apellido_mat" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Ubigeo</label>
                            <input type="text" value="" placeholder="" id="ubigeo" name="ubigeo" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Cargos</label>
                            <select id="cbcargos" name="cbcargos" class="form-control form-select">
                                <option value="">Seleccionar un cargo</option>
                                <?php foreach ($cargos as $row) { ?>
                                    <option value="<?php echo $row['ID']; ?>" <?= set_select('cbcargos', $row['ID']) ?>>
                                        <?php echo $row['Descripcion']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label>Resolución</label>
                            <select id="cbresoluciones" name="cbresoluciones" class="form-control form-select">
                                <option value="0">Seleccionar Resolución</option>
                                <?php foreach ($resoluciones as $row) { ?>
                                    <option value="<?php echo $row['ID']; ?>" <?= set_select('cbresoluciones', $row['ID'], ($idresolucion == $row['ID'] || $row == $row['ID'] ? true : false)) ?>>
                                        <?php echo $row['Numero'] . '-' . $row['Anio'] . '-' . $row['Siglas']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <?php if (isset($validacion)) { ?>
                                <span class="text-danger"><?php echo $validacion->getError('Anio'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-2">
                    <img id="imgElem" style="width: 100%;border: solid 2px #ddd;border-radius: 5px;" src="<?php echo base_url(); ?>img_dni/anonymous.png">
                </div>
            </div>
            <div class="text-end">
                <a href="<?php echo base_url('organizacion'); ?>" class="btn btn-danger">Cancelar</a>
                <a href="javascript:void(0);" class="btn btn-secondary" onclick="marcarEntrega();">Acta de entrega</a>
                <a href="javascript:void(0);" class="btn btn-info" onclick="marcarCredencial();">Marcar impreso</a>
                <div class="dropdown d-inline">
                    <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ver Credenciales
                    </button>
                    <div class="dropdown-menu">
                        <div class="dropdown-title">Imprimir</div>
                        <a class="dropdown-item has-icon" id="anverso" href="javascript:void(0);" onclick="imprimirCredencial(1);"><i class="fas fa-user-tie"></i> Anverso</a>
                        <a class="dropdown-item has-icon" id="reverso" href="javascript:void(0);" onclick="imprimirCredencial(2);"><i class="fas fa-user-alt"></i> Reverso</a>
                        <a class="dropdown-item has-icon" id="reverso" href="javascript:void(0);" onclick="imprimirCredencial(3);"><i class="fas fa-users"></i> Todos</a>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4>JUNTA DIRECTIVA</h4>
    </div>
    <div class="card-body">
        <?php if (!empty(session()->getFlashdata('respuesta'))) { ?>
            <div class="alert alert-<?php echo session()->getFlashdata('respuesta')['type']; ?>">
                <?php echo session()->getFlashdata('respuesta')['msg']; ?>
            </div>
        <?php } ?>
        <div class="table-responsive">
            <table class="table table-striped nowrap table-bordered" id="tblDirectiva" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Item</th>
                        <th class="text-center">DNI</th>
                        <th>APELLIDOS</th>
                        <th>NOMBRES</th>
                        <th>CARGO</th>
                        <th>Impreso</th>
                        <th>#</th>
                        <th>Celular</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>

    function imprimirCredencial(flag) {

        var cbresoluciones = $("#cbresoluciones").val();

        if (cbresoluciones == '0') {

            Swal.fire({
                title: "Mensaje!",
                text: "Para imprimir las credenciales seleccione la resolución!",
                icon: "warning"
            });
            $("#cbresoluciones").addClass("is-invalid");

        } else {

            if (flag == 1) {
                window.open(reporte_url + "reportes/index.jsp?tipo=pdf&nombrereporte=CREDENCIAL_ANVERSO&param=anio^|numero^|idresolucion^" + cbresoluciones);
            } else if (flag == 2) {
                window.open(reporte_url + "reportes/index.jsp?tipo=pdf&nombrereporte=CREDENCIAL_REVERSO&param=anio^|numero^|idresolucion^" + cbresoluciones);
            } else if (flag == 3) {
                window.open(reporte_url + "reportes/index.jsp?tipo=pdf&nombrereporte=CREDENCIAL&param=anio^|numero^|idresolucion^" + cbresoluciones);
            }
        }
    }

    function marcarCredencial() {

        var cbresoluciones = $("#cbresoluciones").val();
        var cbresoluciones_text = $("#cbresoluciones option:selected").text();

        if (cbresoluciones == '0') {

            Swal.fire({
                title: "Mensaje!",
                text: "Para marcar las credenciales como impresas seleccione la resolución!",
                icon: "warning"
            });
            $("#cbresoluciones").addClass("is-invalid");

        } else {

            Swal.fire({
                title: 'Mensaje?',
                text: `Esta seguro de marcar como impreso las credenciales de la Resolución ${ cbresoluciones_text }!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Marcar como impreso !'
            }).then((result) => {
                if (result.isConfirmed) {
                    estadoCredencial(cbresoluciones);
                }
            })
        }
    }

    function marcarEntrega() {

        var cbresoluciones = $("#cbresoluciones").val();
        var cbresoluciones_text = $("#cbresoluciones option:selected").text();

        if (cbresoluciones == '0') {

            Swal.fire({
                title: "Mensaje!",
                text: "Para generar el acta de entrega seleccione la resolución!",
                icon: "warning"
            });
            $("#cbresoluciones").addClass("is-invalid");

        } else {

            Swal.fire({
                title: 'Mensaje?',
                text: `Esta seguro de generar el acta de entrega de la Resolución ${ cbresoluciones_text }!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, generar el acta de entrega !'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: base_url + 'organizacion/' + cbresoluciones + '/entregacredencial',
                        method: "GET",
                        success: function(data) {
                            //alert(data);
                            tblDirectiva.ajax.reload();
                            window.open(reporte_url + "reportes/index.jsp?tipo=pdf&nombrereporte=CREDENCIAL_ACTA&param=idresolucion^" + cbresoluciones);
                        }
                    });

                }
            })
        }
    }

    function estadoCredencial(cbresoluciones) {

        //console.log(cbresoluciones);

        $.ajax({
            url: base_url + 'organizacion/' + cbresoluciones + '/impresioncredencial',
            method: "GET",
            success: function(data) {
                //alert(data);
                tblDirectiva.ajax.reload();
            }
        });
    }

    function buscarDni() {

        var dni = $("#dni").val();

        if (dni.length == 8) {
            BuscarPersonaDNI(dni);
        } else {
            //limpiar_propietario();
            //bloquear_datosPropietario('0');
        }
    }

    function BuscarPersonaDNI(dni) {

        $.ajax({
            url: base_url + 'personas/' + dni + '/consultardni',
            type: 'GET',
            data: {
                dni: dni
            },
            beforeSend: function(e) {
                //  $('#load').addClass('load');
            },
            success: function(data) {

                var datosPersona = JSON.parse(data);

                //if (c.valor.return.coResultado = '0000') {
                //if (data.DNI != null) {
                // bloquear_datosPropietario('1');
                $('#nombre').val(datosPersona.nombres);
                $('#apellido_pat').val(datosPersona.apaterno);
                $('#apellido_mat').val(datosPersona.amaterno);
                $('#direccion').val(datosPersona.direccion);
                $('#ubigeo').val(datosPersona.ubigeo);
                $('#foto').val(datosPersona.foto);

                var baseStr64 = datosPersona.foto;
                imgElem.setAttribute('src', "data:image/png;base64," + baseStr64);

                $("#apellido_pat").addClass("is-valid");
                $("#apellido_mat").addClass("is-valid");
                $("#cbcargos").addClass("is-invalid");
                $("#cbresoluciones").addClass("is-invalid");

                //} else {
                //limpiar_propietario();
                //bloquear_datosPropietario('0');
                //
                //} else {
                //limpiar_propietario();
                //bloquear_datosPropietario('0');
                //}
                //$('#load').removeClass('load');

            }
        });

    }
</script>
<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<script src="<?php echo base_url('assets/js/pages/juntadirectiva.js'); ?>"></script>
<?= $this->endSection('js'); ?>