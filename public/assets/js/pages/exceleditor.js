document.addEventListener('DOMContentLoaded', function () {

});

const container = document.querySelector('#example1');
const exampleConsole = document.querySelector('#output');
const autosave = document.querySelector('#autosave');
const load = document.querySelector('#load');
const save = document.querySelector('#save');
const hot = new Handsontable(container, {
  language: 'es-MX',
  data:getData(),
  startRows: 20,
  startCols: 2,
  colHeaders: [
    'ID',
    'Nombre del año'
  ],
  columns: [
    {
      data: 'ID',
      readOnly: true,
    },
    {
      data: 'nombre',
    }
  ],
  filters: true,
  dropdownMenu: ['filter_by_value', 'filter_action_bar'],
  afterGetColHeader(col, TH) {
    // remove the column menu button from the 'Brand', 'Price', and 'Date' columns
    if (col > 0) {
      const button = TH.querySelector('.changeType');

      if (!button) {
        return;
      }

      button.parentElement.removeChild(button);
    }
  },
  rowHeaders: true,
  height: 'auto',
  licenseKey: 'non-commercial-and-evaluation',
  afterChange(change, source) {
    if (source === 'loadData') {
      return; // don't save this change
    }

    if (!change) {
      return;
    }

    if (!autosave.checked) {
      return;
    }
/*	
	var data = JSON.stringify(change);
	console.log(change);

	$.ajax({
		url: 'http://172.16.18.13/ruos/public/exceleditor/guardar/'+data,
		type: 'get',
		dataType: 'json',
		contentType: 'application/json',
		success: function (data) {
			exampleConsole.innerText = `Autosaved (${change.length} cell${
			change.length > 1 ? 's' : ''
			})`;
			console.log('The POST request is only used here for the demo purposes');
		}
	});
*/
  },
  autoWrapRow: true,
  autoWrapCol: true,
});

load.addEventListener('click', () => {
  getData();
});

function getData() {

  fetch('http://172.16.18.13/ruos/public/exceleditor/list').then((response) => {
	response.json().then((data) => {
	  hot.loadData(data.data);
	  // or, use `updateData()` to replace `data` without resetting states
	  MessageAlert("info", "Cargando datos...", "center", "2000");
	  //exampleConsole.innerText = 'Datos cargados';
	});
  });


}
	
save.addEventListener('click', () => {
	var data = JSON.stringify(hot.getData());

	$.ajax({
		url: 'http://172.16.18.13/ruos/public/exceleditor/guardar/'+data,
		type: 'get',
		dataType: 'json',
		contentType: 'application/json',
		success: function (data) {
			MessageAlert("success", "Datos guardados", "center", "2000");
			//exampleConsole.innerText = 'Datos guardados';
			//console.log('La solicitud POST solo se utiliza aquí para fines de demostración.');
			//console.log(hot.getData());
		}
	});
});
/*
autosave.addEventListener('click', () => {
  if (autosave.checked) {
    exampleConsole.innerText = 'Los cambios se guardarán automáticamente';
  } else {
    exampleConsole.innerText = 'Los cambios no se guardarán automáticamente';
  }
});
*/

function MessageAlert(icon, title, position, timer){
	const Toast = Swal.mixin({
		toast: true,
		position: position,
		iconColor: 'white',
		customClass: {
			popup: 'colored-toast',
		},
		showConfirmButton: false,
		timer: timer,
		timerProgressBar: true,
	});
	(async () => {
	  await Toast.fire({
		icon: icon,
		title: title
	  })
	})()
}
