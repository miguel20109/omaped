let tblRUOS;

document.addEventListener('DOMContentLoaded', function () {
    tblRUOS = $('#tblRUOS').DataTable({
        lengthMenu: [100, 250, 500],
        ajax: {
            url: base_url + 'ruos/list',
            dataSrc: ''
        },
        searchBuilder: {
            columns: [1]
        },
        columns: [
            { data: 'nombre_organizacion_social' },
            { data: 'resolucion' },
            { data: 'desde' },
            { data: 'hasta' },
            { data: 'nombre_apellido' },
            { data: 'dni' },
            { data: 'zonal' },
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
