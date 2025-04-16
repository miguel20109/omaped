let tblResoluciones;
let id_organizacion;

id_organizacion = $('#id_organizacion').val();

document.addEventListener('DOMContentLoaded', function () {
    tblResoluciones = $('#tblResoluciones').DataTable({
        ajax: {
            url: base_url + 'organizacion/' + id_organizacion + '/listaresoluciones',
            dataSrc: ''
        },
        columns: [
            { data: 'item' },
            { data: 'numero' },
            { data: 'anio' },
            { data: 'finvigencia' },
            {
                data: null,
                render: function (data, type) {

                    var EstadoClass = "";
                    var vigente = data.vigente == 1 ? 'Vigente' : 'Expiro';

                    if (data.Estado == 'No registrado') {
                        return '';
                    }

                    switch (data.vigente) {
                        case "1":
                            EstadoClass = "badge badge-success";
                            break;
                        case "0":
                            EstadoClass = "badge badge-dark";
                            break;
                        default:
                            EstadoClass = "badge badge-dark";
                    }

                    if (type === 'display') {
                        return `<span class="${EstadoClass}">${vigente}</span>`;
                    }
                    return data;
                },
            },
            {
                data: null,
                render: function (data, type) {

                    var EstadoClass = "";
                    //console.log(data.Estado);

                    switch (data.Estado.toUpperCase()) {
                        case "PROCEDENTE":
                            EstadoClass = "badge badge-success";
                            break;
                        case "IMPROCEDENTE":
                            EstadoClass = "badge badge-danger";
                            break;
                        case "RECTIFICAR":
                            EstadoClass = "badge badge-info";
                            break;
                        case "COMPLEMENTACIÓN":
                            EstadoClass = "badge badge-primary";
                            break;
                        case "EXTEMPORÁNEO":
                            EstadoClass = "badge badge-dark";
                            break;
                        default:
                            EstadoClass = "badge badge-dark";
                    }

                    if (type === 'display') {
                        return `<span class="${EstadoClass}">${data.Estado}</span>`;
                    }
                    return data;
                },
            }
        ],
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        dom,
        buttons,
        order: [[0, 'asc']]
    });
});

function imprimirFicha() {
    var idorganizacion = $('#id_organizacion').val();
    window.open(reporte_url + "reportes/index.jsp?tipo=pdf&nombrereporte=FICHA_RUOS&param=idorganizacion^" + idorganizacion);

}

$('#cbtipoorganizacion').change(function () {

    var cbtipoorganizacion = $('#cbtipoorganizacion').val();
    var url = base_url + 'organizacion/'+cbtipoorganizacion+'/cbdenomina';

    $.ajax({
        url: url,
        dataType: "json",
        success: function (data) {

            let html = "<option value=''>Seleccionar</option>";

            if (data.length > 0) {

                $.each(data, function(i, item) {
                    //console.log(data[i].id);
                    //console.log(item.descripcion);
                    html = html + "<option value=" + item.id + ">" + item.descripcion + "</option>";
                });

                $('#cbdenomina').html(html);
            }
        }
    });

});

/*
    tblUsuarios.on('draw', function () {
        let lista = document.querySelectorAll('.eliminar');
        for (let i = 0; i < lista.length; i++) {
            lista[i].addEventListener('submit', function(e){
                e.preventDefault();
                eliminarRegistro(this);
            });          
        }
    });
});

function eliminarRegistro(form){
    Swal.fire({
        title: 'Mensaje?',
        text: "Esta seguro de eliminar!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      })
}
*/