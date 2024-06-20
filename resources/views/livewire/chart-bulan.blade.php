    {{-- Success is as dangerous as failure. --}}
<div class="w-full md:w-3/4">
        <div id="chart">
        </div>
</div>
    <script>
        var options = {
  chart: {
    type: 'line'
  },
  series: [{
    name: 'Jumlah Pengunjung',
    data: @json($data)
  }],
  xaxis: {
    categories: @json($labels)
  }
}

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();
    </script>
