let tblResoluciones;
document.addEventListener('DOMContentLoaded', function () {
    tblResoluciones = $('#tblResoluciones').DataTable({
        lengthMenu: [100, 250, 500, 1000],
        ajax: {
            url: base_url + 'resoluciones/list',
            dataSrc: ''
        },
        columns: [
            {
                data: null,
                render: function (data, type) {
                    if (type === 'display') {
                        return `
                        <a class="btn btn-primary" href="${base_url + 'resoluciones/' + data.ID + '/edit'}"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-info" href="${base_url + 'organizacion/' + data.idorganizacion + '/edit'} "data-toggle="tooltip" title="Ir a la organizacion"><i class="
fas fa-directions"></i></a>
<a class="btn btn-warning" href="${data.Archivo}" target="_blank" rel="noopener noreferrer" data-toggle="tooltip" title="Visualizar resolución"><i class="fa-solid fa-eye"></i></a>`;
                    }
                    return data;
                },
            },
            { data: 'ID' },
            { data: 'Numero' },
            { data: 'Anio' },
            { data: 'Siglas' },
            { data: 'InicioVigencia' },
            { data: 'FinVigencia' },
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
            },
            {
                data: null,
                render: function (data, type) {

                    var EstadoClass = "";
                    var escaneado = data.escaneado == 1 ? 'Si' : 'No';

                    switch (data.escaneado) {
                        case "1":
                            EstadoClass = "badge badge-success";
                            break;
                        case "0":
                            EstadoClass = "badge badge-danger";
                            break;
                        default:
                            EstadoClass = "badge badge-dark";
                    }

                    if (type === 'display') {
                        return `<span class="${EstadoClass}">${escaneado}</span>`;
                    }
                    return data;
                },
            }
        ],
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        //dom: '<"top"i>rt<"bottom"flp><"clear">',
        dom,
        buttons,
        order: [[1, 'asc']]
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