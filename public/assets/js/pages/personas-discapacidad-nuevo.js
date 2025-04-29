let tblSalud;
let tblActividades;
let tblFamiliar;
let dni;

dni = $('#dni').val();

/*	discapacidad	*/
document.addEventListener('DOMContentLoaded', function () {

	var groupColumn = 1;
	
	tblSalud = $('#tblsalud').DataTable({
		ajax: {
			url: base_url + 'personasdiscapacidad/' + dni + '/listardiscapacidad',
			dataSrc: ''
		},
		columnDefs: [{ visible: false, targets: groupColumn }],
		order: [[groupColumn, 'asc']],
		displayLength: 25,
		drawCallback: function (settings) {
			var api = this.api();
			var rows = api.rows({ page: 'current' }).nodes();
			var last = null;
	 
			api.column(groupColumn, { page: 'current' })
				.data()
				.each(function (group, i) {
					if (last !== group) {
						$(rows)
							.eq(i)
							.before(
								'<tr class="group"><td colspan="5"><b><i>' +
									group +
									'</i></b></td></tr>'
							);
	 
						last = group;
					}
				});
		},
		columns: [
			{ data: 'ID' },
			{ data: 'discapacidad_en' },
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
						<a class="btn btn-danger" href="javascript:void(0);"><i class="fas fa-trash" onclick="QuitarSalud(${data.ID});"></i></a>
						`;
					}
					return data;
				},
			},
		],
		responsive: true,
		language: {
			url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
		}
	});

/*
	// Order by the grouping
	$('#example tbody').on('click', 'tr.group', function () {
		var currentOrder = table.order()[0];
		if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
			table.order([groupColumn, 'desc']).draw();
		}
		else {
			table.order([groupColumn, 'asc']).draw();
		}
	});
*/
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

/*	familiar	*/
document.addEventListener('DOMContentLoaded', function () {

	tblFamiliar = $('#tblfamiliar').DataTable({
		ajax: {
			url: base_url + 'personasdiscapacidad/' + dni + '/listarfamiliar',
			dataSrc: ''
		},
		columns: [
			{ data: 'nombres_completos' },
			{ data: 'edad' },
			{ data: 'parentesco' },
			{ data: 'ocupacion' },
			{ data: 'instruccion' },
			{
				data: null,
				render: function (data, type) {
					if (type === 'display') {
						return `
						<a class="btn btn-danger" href="javascript:void(0);"><i class="fas fa-trash" onclick="QuitarFamiliar(${data.ID});"></i></a>
						`;
					}
					return data;
				},
			},
		],
		responsive: true,
		language: {
			url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
		},
		order: [[0, 'asc']]
	});

});

/*	actividades	*/
document.addEventListener('DOMContentLoaded', function () {

	var groupColumn = 1;
	
	tblActividades = $('#tblActividades').DataTable({
		ajax: {
			url: base_url + 'personasdiscapacidad/' + dni + '/listaractividades',
			dataSrc: ''
		},
		columnDefs: [{ visible: false, targets: groupColumn }],
		order: [[groupColumn, 'asc']],
		displayLength: 25,
		drawCallback: function (settings) {
			var api = this.api();
			var rows = api.rows({ page: 'current' }).nodes();
			var last = null;
	 
			api.column(groupColumn, { page: 'current' })
				.data()
				.each(function (group, i) {
					if (last !== group) {
						$(rows)
							.eq(i)
							.before(
								'<tr class="group"><td colspan="5"><b><i>' +
									group +
									'</i></b></td></tr>'
							);
	 
						last = group;
					}
				});
		},
		columns: [
			{ data: 'ID' },
			{ data: 'discapacidad_en' },
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
                        <a class="btn btn-danger" href="javascript:void(0);"><i class="fas fa-trash" onclick="QuitarActividad(${data.ID});"></i></a>
						`;
					}
					return data;
				},
			},
		],
		responsive: true,
		language: {
			url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
		}
	});

/*
	// Order by the grouping
	$('#example tbody').on('click', 'tr.group', function () {
		var currentOrder = table.order()[0];
		if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
			table.order([groupColumn, 'desc']).draw();
		}
		else {
			table.order([groupColumn, 'asc']).draw();
		}
	});
*/
});

function imprimirFichaomaped() {
	dni = $('#dni').val();
	window.open(reporte_url + `reportes/omaped.jsp?tipo=pdf&nombrereporte=FICHA_OMAPED&param=dni^${dni}`);
}

function validaTipoTramite(){

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

function AgregarDiscapacidad(){

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

function AgregarActividades(){

	var dni = $('#dni').val();
	var cbactividad_discapacidad = $('#cbactividad_discapacidad').val();
	var cbrespuesta_actividad = $('#cbrespuesta_actividad').val();

	if (cbactividad_discapacidad == '0') {
		$("#cbactividad_discapacidad").addClass("is-invalid");
		Swal.fire({
			title: "Seleccione la deficiencia de salud",
			text: "",
			icon: "warning"
		});
		return;
	};

	Swal.fire({
		title: ``,
		text: `Esta seguro de agrega la actividad?`,
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#54ca68',
		cancelButtonColor: '#fc544b',
		confirmButtonText: 'Si, continuar.'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: base_url + 'personasdiscapacidad/agregaractividades/' + dni + '/' + cbactividad_discapacidad + '/' + cbrespuesta_actividad,
				method: "GET",
				success: function (data) {
					tblActividades.ajax.reload();
				}
			});
		}
	});
}

function AgregarFamiliar() {

	var dni = $('#dni').val();
	var nombres_apellidos = $('#nombres_apellidos').val();
	var edad = $('#edad2').val();
	var parentesco = $('#parentesco').val();
	var ocupacion = $('#ocupacion').val();
	var instruccion = $('#instruccion').val();
/*
	if (cdsalud == '0') {
		$("#cbsalud").addClass("is-invalid");
		Swal.fire({
			title: "Seleccione la deficiencia de salud",
			text: "",
			icon: "warning"
		});
		return;
	};
*/
	Swal.fire({
		title: ``,
		text: `Esta seguro de agrega al familiar?`,
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#54ca68',
		cancelButtonColor: '#fc544b',
		confirmButtonText: 'Si, continuar.'
	}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: base_url + 'personasdiscapacidad/agregarfamiliar/' + dni + '/' + nombres_apellidos + '/' + edad + '/' + parentesco+ '/' + ocupacion+ '/' + instruccion,
						method: "GET",
						success: function (data) {
							tblFamiliar.ajax.reload();
							$('#nombres_apellidos').val('');
							$('#edad2').val('0');
							$('#parentesco').val('');
							$('#ocupacion').val('');
							$('#instruccion').val('');
						}
					});
				}
	});
}

function QuitarSalud(id){

	var dni = $('#dni').val();

	Swal.fire({
		title: ``,
		text: `Esta seguro de quitar el registro?`,
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#54ca68',
		cancelButtonColor: '#fc544b',
		confirmButtonText: 'Si, continuar.'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: base_url + 'personasdiscapacidad/deletesalud/' + id + '/' + dni,
				method: "GET",
				success: function (data) {
					tblSalud.ajax.reload();
				}
			});
		}
	});
}

function QuitarActividad(id){

	var dni = $('#dni').val();

	Swal.fire({
		title: ``,
		text: `Esta seguro de quitar el registro?`,
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#54ca68',
		cancelButtonColor: '#fc544b',
		confirmButtonText: 'Si, continuar.'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: base_url + 'personasdiscapacidad/deletesalud/' + id + '/' + dni,
				method: "GET",
				success: function (data) {
					tblActividades.ajax.reload();
				}
			});
		}
	});
}

function QuitarFamiliar(id){

	var dni = $('#dni').val();

	Swal.fire({
		title: ``,
		text: `Esta seguro de quitar al familiar?`,
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#54ca68',
		cancelButtonColor: '#fc544b',
		confirmButtonText: 'Si, continuar.'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: base_url + 'personasdiscapacidad/deletefamilia/' + id + '/' + dni,
				method: "GET",
				success: function (data) {
					tblFamiliar.ajax.reload();
				}
			});
		}
	});
}