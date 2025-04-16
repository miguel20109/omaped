let tblFallecidos;
let cbtramite;

	cbtramite = $('#cbtramite').val();
	cbmes = $('#cbmes').val();
	cbanio = $('#cbanio').val();
	
//console.log(cbtramite);

document.addEventListener('DOMContentLoaded', function(){
	
    tblFallecidos = $('#tblFallecidos').DataTable( {
		lengthMenu: [20, 50, 100],
        ajax: {
            url: base_url + 'personasfallecidas/' + cbtramite + '/' + cbmes + '/' + cbanio + '/listasolicitudes',
            dataSrc: ''
        },
        columns: [
            {
                data: null,
                render: function (data, type) {
                    if (type === 'display') {
                        var boton_1 = `<a class="btn btn-primary" href="${ base_url + 'personasfallecidas/' + data.ID + '/editsolicitud' }"><i class="fas fa-edit"></i></a>`;
						var boton_2 = ` <form action="${ base_url + 'personasfallecidas/' + data.ID }" method="post" class="d-inline eliminar">
											<input type="hidden" name="${csrf_token.getAttribute('content')}" value="${csrf_hash.getAttribute('content')}" />    
											<input type="hidden" name="_method" value="DELETE">
											<button type="submit" class="btn btn-danger"><i class="far fa-hospital"></i></button>
										</form>`;
						return boton_1 + (data.estado == 1 ? boton_2 : '');
                    }
                    return data;
                },
            },
            { data: 'numero' },
			{ data: 'tramite' },
			{ data: 'solicitante' },
        ],
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        dom,
        buttons,
        order: [[0, 'asc']]
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
			text: "Esta seguro de generar la autorización!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Si, generar!'
		}).then((result) => {
			if (result.isConfirmed) {
				form.submit();
			}
		})
	}
	
function ListarSolicitudes(){

    var cbtramite = $('#cbtramite').val();
	var cbmes = $('#cbmes').val();
	var cbanio = $('#cbanio').val();
	
    var url = base_url + 'personasfallecidas/' + cbtramite + '/' + cbmes + '/' + cbanio +'/listasolicitudes';

    $('#tblFallecidos').DataTable().ajax.url(url).load();

}

function ImprimirSolicitudes(){

    var cbtramite = $('#cbtramite').val();
	var cbmes = $('#cbmes').val();
	var cbanio = $('#cbanio').val();
	
    window.open(reporte_url + `reportes/index.jsp?tipo=pdf&nombrereporte=reporte_ingresos&param=tramite^${cbtramite}|mes^${cbmes}|anio^${cbanio}`);
}
