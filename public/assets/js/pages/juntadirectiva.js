let tblDirectiva;

var id_organizacion = $('#id_organizacion').val();
var id_resolucion = $('#cbresoluciones').val();

$('#dni').focus();

document.addEventListener('DOMContentLoaded', function(){
    tblDirectiva = $('#tblDirectiva').DataTable( {
        lengthMenu : [20, 40, 60, 80, 100],
        ajax: {
            url: base_url + 'organizacion/'+id_organizacion+'/'+id_resolucion+'/listardirectiva',
            dataSrc: ''
        },
        columns: [
            {
                data: 'item',
                className: 'text-right',
                width: '5%'
            },
            { 
                data: 'dni',
                className: 'text-center',
                width: '10%'
            },
            { data: 'apellidos' },
            { data: 'nombres' },
            { data: 'cargo', width: '30%'},
            {
                data: null,
                className: 'text-center',
                width: '10%',
                render: function (data, type) {

                    var EstadoClass = "";
                    var impreso = data.impreso==1 ? 'Si' : data.impreso==2 ? 'Entregado' : 'No';

                    switch (data.impreso)
                    {
                        case "2":
                            EstadoClass = "badge badge-info";
                            break;
                        case "1":
                            EstadoClass = "badge badge-success";
                            break;
                        case "0":
                            EstadoClass = "badge badge-primary";
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
            {
                data: null,
                width: '5%',
                render: function (data, type) {
                    if (type === 'display') { 
                        return `
                        <form action="${ base_url + 'organizacion/' + data.id +'/' + id_organizacion }" method="post" class="d-inline eliminar">
                            <input type="hidden" name="${csrf_token.getAttribute('content')}" value="${csrf_hash.getAttribute('content')}" />    
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                        <a class="btn btn-success" target="_blank" href=https://wa.me/${data.telefono}?text=Buenas+tardes,><i class="fab fa-whatsapp"></i></a>`
                        ;
                    }
                    return data;
                },
            },
            { data: 'telefono', width: '30%'},
            { data: 'correo', width: '30%'}
        ],
        responsive: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        dom,
        buttons,
        order: [[0, 'asc']]
    } );

    tblDirectiva.on('draw', function () {
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

$('#cbresoluciones').change(function(){

    var id_organizacion = $('#id_organizacion').val();
    var id_resolucion = $('#cbresoluciones').val();
    var url = base_url + 'organizacion/'+id_organizacion+'/'+id_resolucion+'/listardirectiva';

    $('#tblDirectiva').DataTable().ajax.url(url).load();

});