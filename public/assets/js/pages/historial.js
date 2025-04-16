let tblHistorial;
document.addEventListener('DOMContentLoaded', function () {
    tblHistorial = $('#tblHistorial').DataTable({
        lengthMenu: [100, 250, 500, 1000],
        ajax: {
            url: base_url + 'historial/list',
            dataSrc: ''
        },
        columns: [
			{ data: 'nicho' },
			{ data: 'inhumacion' },
			{ data: 'fecha' },
			{ data: 'solicitante' },
			{ data: 'celular' },
			{ data: 'difunto' },
			{ data: 'fecha_fallecimiento' },
			{ data: 'cementerio' },
			{ data: 'recibo_nicho' },
			{ data: 'recibo_inhumacion' },
			{ data: 'fecha_pago' },
			{ data: 'monto' },
        ],
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        //dom: '<"top"i>rt<"bottom"flp><"clear">',
        dom,
        buttons,
        order: [[3, 'asc']]
    });
});
