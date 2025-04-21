let tblSalud;
let tblOrdenes;
let tblSolicitudes;
let dni;

dni = $('#dni').val();

document.addEventListener('DOMContentLoaded', function () {

	tblSalud = $('#tblsalud').DataTable({
		ajax: {
			url: base_url + 'personasdiscapacidad/' + dni + '/listardiscapacidad',
			dataSrc: ''
		},
		columns: [
			{ data: 'ID' },
			{ data: 'discapacidad' },
			{ data: 'discapacidad' },
			{
                data: null,
                render: function (data, type) {

                    var EstadoClass = "";
                    var respuesta = data.respuesta == 1 ? 'Si' : 'No';

                    switch (data.respuesta) {
                        case "1":
                            EstadoClass = "badge badge-primary";
                            break;
                        default:
                            EstadoClass = "badge badge-danger";
                    }

                    if (type === 'display') {
                        return `<span class="${EstadoClass}">${respuesta}</span>`;
                    }
                    return data;
                },
            },
			{
				data: null,
				render: function (data, type) {
					if (type === 'display') {
						return `
						<a class="btn btn-success" href="javascript:void(0);" onclick="imprimirCroquis(${data.ID});" data-toggle="tooltip" title="Imprimir croquis"><i class="fas fa-print"></i></a>`;
					}
					return data;
				},
			},
		],
		responsive: true,
		language: {
			url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
		},
		dom,
		buttons,
		order: [[0, 'asc']]
	});

});

function imprimirSolicitud(id, reporte) {
	window.open(reporte_url + `reportes/index.jsp?tipo=pdf&nombrereporte=${reporte}&param=id^${id}`);
}

function validaTipoTramite() {

	var cbtramite = $('#cbtramite').val();

	if (cbtramite == '0') {
		$("#cbtramite").addClass("is-invalid");
		Swal.fire({
			title: 'Mensaje!',
			text: "Seleccione el tipo de tramite!",
			icon: 'info',
			showCancelButton: false,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Aceptar!'
		})
		return false;
	}
}

function AgregarDiscapacidad() {

	var dni = $('#dni').val();
	var cdsalud = $('#cbsalud').val();
	var cbrespuesta = $('#cbrespuesta').val();

	if (cdsalud == '0') {
		$("#cbsalud").addClass("is-invalid");
		Swal.fire({
			title: "Seleccione la deficiencia de salud",
			text: "",
			icon: "warning"
		});
		return;
	};

	Swal.fire({
		title: ``,
		text: `Esta seguro de agrega la deficiencia de salud?`,
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#54ca68',
		cancelButtonColor: '#fc544b',
		confirmButtonText: 'Si, continuar.'
	}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: base_url + 'personasdiscapacidad/agregardiscapacidad/' + dni + '/' + cdsalud + '/' + cbrespuesta,
						method: "GET",
						success: function (data) {
							tblSalud.ajax.reload();
						}
					});
				}
	});
}