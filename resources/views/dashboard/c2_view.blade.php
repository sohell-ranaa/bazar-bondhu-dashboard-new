
<canvas
        id="merchantStatsByDistrict"
        data-c2label='["{!! @$c2_labels !!}"]'
        data-tangailvalues='["{!! @$total_tangail_values !!}"]'
        data-sirajganjvalues='["{!! @$total_sirajganj_values !!}"]'
        data-sherpurvalues='["{!! @$total_sherpur_values !!}"]'
        data-jamalpurvalues='["{!! @$total_jamalpur_values !!}"]'
        style="height: 300px; width: 100%">
</canvas>
<script>

  $(function () {
    'use strict';

    let merchantStatsByDistrictCtx = document.getElementById('merchantStatsByDistrict').getContext('2d');
    let chartLabels = $('#merchantStatsByDistrict').data('c2label');
    let tangailvalues = $('#merchantStatsByDistrict').data('tangailvalues');
    let sirajganjvalues = $('#merchantStatsByDistrict').data('sirajganjvalues');
    let sherpurvalues = $('#merchantStatsByDistrict').data('sherpurvalues');
    let jamalpurvalues = $('#merchantStatsByDistrict').data('jamalpurvalues');
    let merchantStatsByDistrictChart = new Chart(merchantStatsByDistrictCtx, {
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
              labelString: 'Merchants'
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
