<canvas
        id="salesStatsByDistrict"
        data-c4label='["{!! @$c4_labels !!}"]'
        data-tangailvalues='["{!! @$total_tangail_order !!}"]'
        data-sirajganjvalues='["{!! @$total_sirajganj_order !!}"]'
        data-sherpurvalues='["{!! @$total_sherpur_order !!}"]'
        data-jamalpurvalues='["{!! @$total_jamalpur_order !!}"]'
        style="height: 280px; width: 100%">
</canvas>

<script>

  $(function () {
    'use strict';

    let salesStatsByDistrictCtx = document.getElementById('salesStatsByDistrict').getContext('2d');
    let chartLabels = $('#salesStatsByDistrict').data('c4label');
    let tangailvalues = $('#salesStatsByDistrict').data('tangailvalues');
    let sirajganjvalues = $('#salesStatsByDistrict').data('sirajganjvalues');
    let jamalpurvalues = $('#salesStatsByDistrict').data('jamalpurvalues');
    let sherpurvalues = $('#salesStatsByDistrict').data('sherpurvalues');
    let salesStatsByDistrictChart = new Chart(salesStatsByDistrictCtx, {
      type: "line",
      data: {
        labels: chartLabels,
        datasets: [
          {
            label: "Tangail",
            data: tangailvalues,
            borderWidth: 1,
            pointBorderWidth: 0,
            pointBorderColor: '#7DBF6F',
            borderColor: '#7DBF6F',
            // fill: 'none',
            backgroundColor: 'rgba(125,191,111,0.15)'
          },
          {
            label: "Sirajganj",
            data: sirajganjvalues,
            borderWidth: 1,
            pointBorderColor: '#8A2F89',
            borderColor: '#8A2F89',

            hidden:true,
            // fill: 'none',
            backgroundColor: 'rgba(138,47,137,0.15)'
          },
          {
            label: "Jamalpur",
            data: jamalpurvalues,
            borderWidth: 1,
            pointBorderColor: '#FDB833',
            borderColor: '#FDB833',
            // fill: 'none',
            backgroundColor: 'rgba(253,184,51,0.15)'
          },
          {
            label: "Sherpur",
            data: sherpurvalues,
            borderWidth: 1,
            pointBorderColor: '#296EB4',
            borderColor: '#296EB4',
            // fill: 'none',
            backgroundColor: 'rgba(41,110,180,0.15)'
          }
        ]
      },
      options: {
        tooltips: {
          mode: 'index',
          intersect: false,
        },
        scales: {
          xAxes: [{
            display: true,
            scaleLabel: {
              display: true,
              labelString: ''
            },
            ticks: {
              padding: 10
            }
          }],
          yAxes: [{
            display: true,
            stacked: false,
            scaleLabel: {
              display: true,
              labelString: 'Value'
            },
            ticks: {
              beginAtZero: true,
              userCallback: function (label, index, labels) {
                if (Math.floor(label) === label) {
                  return label;
                }
              },
            }
          }]
        },
      }
    });
  })
</script>