<canvas
        id="merchantStats"
        data-c1label='["{!! @$c1_labels !!}"]'
        data-c1tmvalues='["{!! @$c1_tm !!}"]'
        data-c1ttmvalues='["{!! @$c1_ttm !!}"]'
        style="height: 300px; width: 100%">
</canvas>
<script>
  $(function () {
    'use strict';
    let merchantStatsCtx = document.getElementById('merchantStats').getContext('2d');
    let merchantChartLabels = $('#merchantStats').data('c1label');
    let tm = $('#merchantStats').data('c1tmvalues');
    let ttm = $('#merchantStats').data('c1ttmvalues');
    let merchantStatsChart = new Chart(merchantStatsCtx, {
      type: "line",
      data: {
        labels: merchantChartLabels,
        datasets: [
          {
            yAxisID: 'A',
            label: "Total Merchant",
            data: tm,
            borderWidth: 1,
            pointBorderWidth: 0,
            pointBorderColor: '#7DBF6F',
            borderColor: '#7DBF6F',
            backgroundColor: 'rgba(125,191,111,0.2)'
          },
          {
            yAxisID: 'B',
            label: "Transacting Merchant",
            data: ttm,
            borderWidth: 1,
            pointBorderColor: '#8A2F89',
            borderColor: '#8A2F89',
            fill: 'none',
            backgroundColor: 'rgba(138,47,137,0.20)'
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
            id: 'A',
            position: 'left',
            display: true,
            scaleLabel: {
              display: true,
              labelString: 'Total Merchant'
            },
            ticks: {
              beginAtZero: true,
              userCallback: function (label, index, labels) {
                if (Math.floor(label) === label) {
                  return label;
                }
              },
            }
          }, {
            id: 'B',
            position: 'right',
            display: true,
            stacked: false,
            scaleLabel: {
              display: true,
              labelString: 'Transacting Merchant'
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