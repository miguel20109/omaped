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
            url: base_url + 'personasfallecidas/' + cbtramite + '/' + cbmes + '/' + cbanio +'/listaautorizaciones',
            dataSrc: ''
        },
        columns: [
            {
                data: null,
                render: function (data, type) {
                    if (type === 'display') {
                        return `
						<a class="btn btn-success" href="javascript:void(0);" onclick="ImprimirAutorizacion('${data.ID}', '${data.reporte}');" data-toggle="tooltip" title="Imprimir autorización"><i class="fas fa-print"></i></a>
						`;
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
	
function ListarAutorizaciones(){

    var cbtramite = $('#cbtramite').val();
    var url = base_url + 'personasfallecidas/' + cbtramite + '/' + cbmes + '/' + cbanio +'/listaautorizaciones';

    $('#tblFallecidos').DataTable().ajax.url(url).load();

}

function ImprimirAutorizacion(id, reporte){
    window.open(reporte_url + `reportes/index.jsp?tipo=pdf&nombrereporte=${reporte}&param=id^${id}`);
}
