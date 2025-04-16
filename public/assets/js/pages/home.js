const year = document.querySelector('#year');
let myChart;

document.addEventListener("DOMContentLoaded", function () {
  movimientoGrafico(year.value);
  chart2(year.value);

  year.addEventListener('change', function(e){
    movimientoGrafico(e.target.value);
	chart2(e.target.value);
  })
});

function movimientoGrafico(anio) {
  if (myChart) {
    myChart.destroy();
  }
  const url = base_url + "fallecidosMes/" + anio;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      var options = {
        chart: {
          height: 350,
          type: "line",
          shadow: {
            enabled: true,
            color: "#000",
            top: 18,
            left: 7,
            blur: 10,
            opacity: 1,
          },
          toolbar: {
            show: false,
          },
        },
        colors: ["#77B6EA", "#545454"],
        dataLabels: {
          enabled: true,
        },
        stroke: {
          curve: "smooth",
        },
        series: [
          {
            name: "Total",
            data: [res.total.ene, res.total.feb, res.total.mar, res.total.abr, res.total.may, 
              res.total.jun, res.total.jul, res.total.ago, res.total.sep, res.total.oct, res.total.nov, res.total.dic],
          }
        ],
        title: {
          text: "Fallecidos por mes",
          align: "left",
        },
        grid: {
          borderColor: "#e7e7e7",
          row: {
            colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
            opacity: 0.8,
          },
        },
        markers: {
          size: 6,
        },
        xaxis: {
          categories: [
            "Ene",
            "Feb",
            "Mar",
            "Abr",
            "May",
            "Jun",
            "Jul",
            "Ago",
            "Sep",
            "Oct",
            "Nov",
            "Dic",
          ],
          title: {
            text: "Meses",
          },
          labels: {
            style: {
              colors: "#9aa0ac",
            },
          },
        },
        yaxis: {
          title: {
            text: "Cantidad",
          },
          labels: {
            style: {
              color: "#9aa0ac",
            },
          },
          min: 0,
          max: res.max,
        },
        legend: {
          position: "top",
          horizontalAlign: "right",
          floating: true,
          offsetY: -25,
          offsetX: -5,
        },
      };

      myChart = new ApexCharts(document.querySelector("#prestamos"), options);

      myChart.render();
    }
  };
}


function chart2(anio) {
	
    var options = {
        chart: {
            height: 350,
            type: 'bar',
            stacked: true,
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '200px',
            },
        },
        series: [{
            name: 'PRODUCT A',
            data: [44, 55, 41, 67, 22, 43, 44, 55, 41, 67, 22, 43]
        }, {
            name: 'PRODUCT B',
            data: [13, 23, 20, 8, 13, 27, 13, 23, 20, 8, 13, 27]
        }, {
            name: 'PRODUCT C',
            data: [11, 17, 15, 15, 21, 14, 11, 17, 15, 15, 21, 14]
        }],
        xaxis: {
            type: 'datetime',
            categories: ['01/01/2019 GMT', '01/02/2019 GMT', '01/03/2019 GMT', '01/04/2019 GMT', '01/05/2019 GMT', '01/06/2019 GMT',
						 '01/07/2019 GMT', '01/08/2019 GMT', '01/09/2019 GMT', '01/10/2019 GMT', '01/11/2019 GMT', '01/12/2019 GMT'
			],
            labels: {
                style: {
                    colors: "#9aa0ac"
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    color: "#9aa0ac"
                }
            }
        },
        legend: {
            position: 'top',
            offsetY: 40,
            show: false,
        },
        fill: {
            opacity: 1
        },
    }

    var chart = new ApexCharts(
        document.querySelector("#cementerios"),
        options
    );

    chart.render();

}