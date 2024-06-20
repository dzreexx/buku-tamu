<div>
{{-- The whole world belongs to you. --}}

<div class="w-full md:w-3/4">
    <div id="chartdua">
</div>

<script>
    var optionsdua = {
              series: [{
              name: 'Pengunjung Login',
              data: @json($dataLogin)
            }, {
              name: 'Pengunjung tanpa login',
              data: @json($dataNotLogin)
            },{
              name: 'Total Pengunjung',
              data: @json($data)
            }],
              chart: {
              type: 'bar',
              height: 350
            },
            plotOptions: {
              bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
              },
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              show: true,
              width: 2,
              colors: ['transparent']
            },
            xaxis: {
              categories: @json($labelsYear),
            },
            yaxis: {
              title: {
                text: 'Kunjungan Pertahun'
              }
            },
            fill: {
              opacity: 1
            },
            tooltip: {
              y: {
                formatter: function (val) {
                  return " " + val + ""
                }
              }
            }
            };
    
    var chartdua = new ApexCharts(document.querySelector("#chartdua"), optionsdua);
    chartdua.render();
      </script>

    
</div>
