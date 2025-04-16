let tblTramite;
let tblOrdenes;
let tblSolicitudes;
let dni_difunto;

dni_difunto = $('#dni_difunto').val();

document.addEventListener('DOMContentLoaded', function () {
	
    tblTramite = $('#tblTramite').DataTable({
        ajax: {
            url: base_url + 'personasfallecidas/' + dni_difunto + '/listacroquis',
            dataSrc: ''
        },
        columns: [
            { data: 'numero' },
			{ data: 'solicitante' },
			{ data: 'tramite' },
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
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        dom,
        buttons,
        order: [[0, 'asc']]
    });

});

document.addEventListener('DOMContentLoaded', function () {

    tblOrdenes = $('#tblOrdenes').DataTable({
        ajax: {
            url: base_url + 'personasfallecidas/' + dni_difunto + '/listaorden',
            dataSrc: ''
        },
        columns: [
            { data: 'numero' },
			{ data: 'declarante' },
            {
                data: null,
                render: function (data, type) {
                    if (type === 'display') {
                        return `
		<a class="btn btn-success" href="javascript:void(0);" onclick="imprimirOrden(${data.ID});" data-toggle="tooltip" title="Imprimir croquis"><i class="fas fa-print"></i></a>`;
                    }
                    return data;
                },
            },
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


document.addEventListener('DOMContentLoaded', function () {

    tblSolicitudes = $('#tblSolicitudes').DataTable({
        ajax: {
            url: base_url + 'personasfallecidas/' + dni_difunto + '/listasolicitud',
            dataSrc: ''
        },
        columns: [
            { data: 'numero' },
			{ data: 'solicitante' },
			{ data: 'tramite' },
            {
                data: null,
                render: function (data, type) {
                    if (type === 'display') {
                        return `
				<a class="btn btn-success" href="javascript:void(0);" onclick="imprimirSolicitud(${data.ID},'${data.reporte}');" data-toggle="tooltip" title="Imprimir solicitud"><i class="fas fa-print"></i></a>
				`;
                    }
                    return data;
                },
            },
        ],
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        dom,
        buttons,
        order: [[0, 'asc']]
    });
	/*
    tblSolicitudes.on('draw', function () {
        let lista = document.querySelectorAll('.eliminar');
        for (let i = 0; i < lista.length; i++) {
            lista[i].addEventListener('submit', function(e){
                e.preventDefault();
                eliminarRegistro(this);
            });          
        }
    });
	*/
});

	function imprimirCroquis(id) {
		window.open(reporte_url + "reportes/index.jsp?tipo=pdf&nombrereporte=croquis&param=id^" + id);
	}

	function imprimirOrden(id) {
		window.open(reporte_url + "reportes/index.jsp?tipo=pdf&nombrereporte=orden_inhumacion&param=id^" + id);
	}
	
	function imprimirSolicitud(id, reporte) {
		window.open(reporte_url + `reportes/index.jsp?tipo=pdf&nombrereporte=${reporte}&param=id^${id}`);
	}
	
	function validaTipoTramite(){
		
		var cbtramite = $('#cbtramite').val();
		
		if (cbtramite=='0'){
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

	function GenerarOrden() {
		
		var dni_difunto = $('#dni').val();
		var dni_declarante = $('#dni_declarante').val();
		var nombre_completo = $('#nombre').val();
		var cementerio = $('#cbcementerio').val();
		var lugar = $('#cblugar').val();
		var procedencia = $('#procedencia').val();
		var sepultura = $('#cbsepultura').val();

		if(cementerio=='0'){
			$("#cbcementerio").addClass("is-invalid");
			Swal.fire({
			  title: "Seleccione el cementerio",
			  text: "",
			  icon: "warning"
			});
			return;
		};
		
		if(lugar=='0'){
			$("#cblugar").addClass("is-invalid");
			Swal.fire({
			  title: "Seleccione el lugar",
			  text: "",
			  icon: "warning"
			});
			return;
		};
		
		if(procedencia==''){
			$("#procedencia").addClass("is-invalid");
			Swal.fire({
			  title: "Ingrese la procedencia",
			  text: "",
			  icon: "warning"
			});
			return;
		};

		if(sepultura=='0'){
			$("#cbsepultura").addClass("is-invalid");
			Swal.fire({
			  title: "Ingrese la sepultura",
			  text: "",
			  icon: "warning"
			});
			return;
		};
		
		Swal.fire({
			title: ``,
			text: `Esta seguro de generar la orden de inhumación para ${ nombre_completo }?`,
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#54ca68',
			cancelButtonColor: '#fc544b',
			confirmButtonText: 'Si, generar orden'
		}).then((result) => {
			
			if (result.isConfirmed) {
				$.ajax({
					url: base_url + 'personasfallecidas/generaorden/'+dni_difunto+'/'+dni_declarante+'/'+cementerio+'/'+lugar+'/'+procedencia,
					method: "GET",
					success: function(data) {
						tblOrdenes.ajax.reload();
					}
				});
			}
			
		});
    }