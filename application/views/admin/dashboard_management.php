<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="row mb-3">
            <div class="col-3">
                <div class="p-3" style="border-radius: 10px;background: #7C77F4;">
                    <div class="row">
                        <div class="col-3">
                            <span class="iconify-inline mt-1" data-icon="bi:cash-coin" data-width="45" data-height="45" style="color: #fff;"></span>
                        </div>
                        <div class="col-9">
                            <div style="color:#fff; font-size: 14px;">Saldo Operasional</div>
                            <div style="color:#fff; font-size: 18px;font-weight: bold;">Rp.<?= number_format($saldo->balance)?></div>
                            <div style="border-top: 0.5px solid #fff;">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#mdl_saldo">
                                    <span class="iconify-inline" data-icon="clarity:settings-solid" data-width="15" data-height="15" style="color: #fff;"></span>
                                    <span style="color:#fff; font-size: 14px;">Atur Saldo</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="p-3" style="border-radius: 10px;background: #322E8C;">
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
                <div class="p-3" style="border-radius: 10px;background: #FFBE1A;">
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
<!-- Modal Saldo -->
<div class="modal fade" id="mdl_saldo" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-header">
                <p class="font-w-700 color-darker mb-0">Atur Saldo</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-14px pt-0 d-flex flex-column">
                <?= form_open_multipart('management/set-saldo'); ?>
                <div class="pb-4">
                    
                    <div class="input-group d-flex flex-column my-2 w-100">
                        <label class="my-2 color-secondary">Saldo</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="text" name="balance" value="<?= number_format($saldo->balance)?>" onkeypress="return isNumberKey(event)" onkeyup="addCommaNumeric(event)" class="form-control" aria-describedby="basic-addon1" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-table submit-modal">Simpan Data</button>
                </div>
                <?= form_close() ?>
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