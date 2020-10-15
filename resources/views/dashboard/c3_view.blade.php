<canvas
        id="salesStats"
        data-c3label='["{!! @$c3_labels !!}"]'
        data-to='["{!! @$to !!}"]'
        data-toa='["{!! @$toa !!}"]'
        data-aoa='["{!! @$aoa !!}"]'
        style="height: 280px; width: 100%">
</canvas>
<script>
  $(function () {
    'use strict';

    let salesStatsCtx = document.getElementById('salesStats').getContext('2d');
    let chartLabels = $('#salesStats').data('c3label');
    let to = $('#salesStats').data('to');
    let toa = $('#salesStats').data('toa');
    let aoa = $('#salesStats').data('aoa');
    let salesStatsChart = new Chart(salesStatsCtx, {
      type: "line",
      data: {
        labels: chartLabels,
        datasets: [
          {
            label: "Total Order",
            data: to,
            borderWidth: 1,
            pointBorderColor: '#8A2F89',
            borderColor: '#8A2F89',
            // fill: 'none',
            backgroundColor: 'rgba(138,47,137,0.15)'
          },
          {
            label: "Total Amount",
            data: toa,
            borderWidth: 1,
            pointBorderColor: '#FDB833',
            borderColor: '#FDB833',
            hidden:true,
            // fill: 'none',
            backgroundColor: 'rgba(253,184,51,0.15)'
          },
          {
            label: "Average Order Amount",
            data: aoa,
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
    })
  })
</script>