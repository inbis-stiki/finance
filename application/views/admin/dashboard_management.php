<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="row mb-3">
            <div class="col-3">
                <div class="p-3" style="border-radius: 10px;background: #7C77F4;">
                    <div class="row">
                        <div class="col-3">
                            <span class="iconify-inline mt-1" data-icon="ps:car" data-width="45" data-height="45" style="color: #fff;"></span>
                        </div>
                        <div class="col-9">
                            <div style="color:#fff; font-size: 14px;">Jumlah Kendaraan</div>
                            <div style="color:#fff; font-size: 18px;font-weight: bold;">150 Kendaraan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="p-3" style="border-radius: 10px;background: #322E8C;">
                    <div class="row">
                        <div class="col-3 ">
                            <span class="iconify-inline mt-1" data-icon="clarity:list-outline-badged" data-width="45" data-height="45" style="color: #fff;"></span>
                        </div>
                        <div class="col-9">
                            <div style="color:#fff; font-size: 14px;">Pengajuan Baru</div>
                            <div style="color:#fff; font-size: 18px;font-weight: bold;">10 Pengajuan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card-section">
                    <div class="head">
                        <p>Global Cost</p>
                        <input type="date">
                    </div>
                    <div class="body">
                        <div style="width: 99%;" id="chart_global"></div>
                    </div>
                    <div class="foot">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card-section">
                    <div class="head">
                        <p>Total Cost Per Area</p>
                        <input type="date">
                    </div>
                    <div class="body">
                        <div style="width: 99%;" id="chart_area"></div>
                    </div>
                    <div class="foot">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-section">
                    <div class="head">
                        <p>Total Cost Per Jenis Biaya</p>
                        <input type="date">
                    </div>
                    <div class="body" style="margin-bottom: 12px;">
                        <div style="width: 99%;" id="chart_jenis"></div>
                    </div>
                    <div class="foot">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="card-section">
                    <div class="head">
                        <p>Sparepart</p>
                        <input type="date">
                    </div>
                    <div class="body">
                        <!-- <div style="width: 99%;" id="chart_area"></div> -->
                    </div>
                    <div class="foot">
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card-section">
                    <div class="head">
                        <p>Cost Per Kendaraan</p>
                        <input type="date">
                    </div>
                    <div class="body" style="margin-bottom: 12px;">
                        <!-- <div style="width: 99%;" id="chart_jenis"></div> -->
                    </div>
                    <div class="foot">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url() ?>/assets/src/js/apexchart.js"></script>
<script>
    var options = {
        chart: {
            type: 'area',
            height: '300px'
        },
        series: [{
            name: 'sales',
            data: [40,30,20,20,0.5,1,5,5,8,60,0.02]
        }],
        colors: ['#4F48ED'],
        xaxis: {
            categories: ["Januari","Februari","Maret","April","Mei","Juni","Juli", "Agustus","September", "Oktober", "November", "Desember"]
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value+" Jt";
                }
            },
        },
        dataLabels: {
          enabled: true,
        },
    }
    var options2 = {
        chart: {
            type: 'bar',
            height: '300px'
        },
        series: [{
            name: 'sales',
            data: [40,30,20,20,0.5,1,5,5,8,60,0.02]
        }],
        colors: ['#4F48ED'],
        xaxis: {
            categories: ["Jan","Feb","Mar","Apr","Mei","Jun","Jul", "Agu","Sep", "Okt", "Nov", "Des"]
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value+" Jt";
                }
            },
        },
        dataLabels: {
          enabled: true,
        },
    }
    var options3 = {
        chart: {
            type: 'pie',
            height: '300px'
        },
        series: [44, 55, 41, 17],
        labels: ['Karburator', 'Kipas Pendingin', 'Plunger', 'Lain-lain'],
        colors: ['#322E8C', '#4F48ED', '#FFBE1A', '#E5E5E5'],
        dataLabels: {
          enabled: true,
        },
    }

    var chart = new ApexCharts(document.querySelector("#chart_global"), options);
    var chart2 = new ApexCharts(document.querySelector("#chart_area"), options2);
    var chart3 = new ApexCharts(document.querySelector("#chart_jenis"), options3);

    chart.render();
    chart2.render();
    chart3.render();
</script>