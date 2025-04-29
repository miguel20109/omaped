let tblFallecidos;
document.addEventListener('DOMContentLoaded', function(){
    tblFallecidos = $('#tblFallecidos').DataTable( {
		lengthMenu: [20, 50, 100],
        ajax: {
            url: base_url + 'personasfallecidas/list',
            dataSrc: ''
        },
        columns: [
            {
                data: null,
                render: function (data, type) {
                    if (type === 'display') {
                        return `<a class="btn btn-primary" href="${ base_url + 'personasfallecidas/' + data.dni + '/edit' }"><i class="fas fa-edit"></i></a>
								<a class="btn btn-success" href="javascript:void(0);" onclick="imprimirDeclaracion('${data.iddeclarante}');" data-toggle="tooltip" title="Imprimir declaracion jurada"><i class="fas fa-print"></i></a>
						`;
                    }
                    return data;
                },
            },
            { data: 'dni' },
			{ data: 'nombres' },
			{ data: 'declarante' },
			{ data: 'telefono' }
        ],
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        dom,
        buttons
        //order: [[0, 'asc']]
    } );

    tblFallecidos.on('draw', function () {
        let lista = document.querySelectorAll('.eliminar');
        for (let i = 0; i < lista.length; i++) {
            lista[i].addEventListener('submit', function(e){
                e.preventDefault();
                eliminarRegistro(this);
            });          
        }
    });
})

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

	function imprimirDeclaracion(id) {
		window.open(reporte_url + `reportes/index.jsp?tipo=pdf&nombrereporte=declaracion_jurada&param=id^${id}`);
	}