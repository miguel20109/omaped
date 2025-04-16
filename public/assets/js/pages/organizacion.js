let tblOrganizacion;
document.addEventListener('DOMContentLoaded', function () {
    tblOrganizacion = $('#tblOrganizacion').DataTable({
        lengthMenu: [50, 100, 200],
        ajax: {
            url: base_url + 'organizacion/list',
            dataSrc: ''
        },
        columns: [
            {
                data: null,
                render: function (data, type) {
                    if (type === 'display') {
                        return `
                        <a class="btn btn-success" href="${base_url + 'organizacion/' + data.ID + '/juntadirectiva'}"><i class="fa-solid fa-users"></i></a>
                        <a class="btn btn-primary" href="${base_url + 'organizacion/' + data.ID + '/edit'}"><i class="fas fa-edit"></i></a>
                        `;
                    }
                    return data;
                },
            },
            {
                data: 'ID',
            },
            {
                data: 'nombre_organizacion_social',
                width: '10px'
            },
            {
                data: null,
                className: 'text-left',
                width: '10%',
                render: function (data, type) {

                    var EstadoClass = "";
                    var impreso = data.vigencia == 1 ? 'Vigente' : 'Sin vigencia';

                    switch (data.vigencia) {
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
                        return `<span class="${EstadoClass}">${impreso}</span>`;
                    }
                    return data;
                },
            },
            { data: 'zonal' },
            { data: 'siop' }
        ],
        responsive: false,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        dom,
        buttons,
        order: [[1, 'desc']]
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