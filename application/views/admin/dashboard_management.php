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
                            <div style="color:#fff; font-size: 18px;font-weight: bold;"><?= $JmlKendaraan?> Kendaraan</div>
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
                            <div style="color:#fff; font-size: 18px;font-weight: bold;"><?= $JmlPengajuan?> Pengajuan</div>
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
                    <div class="body" style="padding: 15px">
                        <?php
                            $template = array('table_open' => '<table id="tblSparepart" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('Detail', 'Jumlah',);

                            foreach ($Sparepart as $row) {
                                $this->table->add_row(
                                    $row->sparepart_nama,
                                    $row->sparepart_total
                                );
                            }
                            echo $this->table->generate(); 
                        ?>
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
                    <div class="body" style="padding: 15px">
                        <?php
                            $template = array('table_open' => '<table id="tblKendaraan" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No STNK', 'Klien', 'Jumlah Transaksi', 'Total Transaksi', 'Detail');

                            foreach ($Kendaraan as $row) {
                                $this->table->add_row(
                                    $row->report_stnk,
                                    $row->report_klien,
                                    number_format($row->report_jumlah_transaksi),
                                    'Rp.'.number_format($row->report_total_transaksi),
                                    '<a href="'.site_url('management/cost-kendaraan/'.str_replace(' ', '_', $row->report_no_rangka).'/'.str_replace(' ', '_', $row->report_stnk)).'">
                                        <span class="iconify-inline" style="color: #4F48ED;" data-icon="ci:external-link"data-width="20" data-height="20"></span>
                                    </a>'
                                );
                            }
                            echo $this->table->generate(); 
                        ?>
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
    $(document).ready(function(){
        $('#tblSparepart').DataTable({
            'searching': false,
            'ordering': false
        });
        $('#tblKendaraan').DataTable({
            'ordering': false
        });
    })
    var options = {
        chart: {
            type: 'area',
            height: '300px'
        },
        series: [{
            name: 'sales',
            data: [
                <?php
                    foreach ($GlobalCost as $item) {
                        echo ((int)$item->report_total_transaksi / 1000000).'.toFixed(1),';
                    }    
                ?>
            ]
        }],
        colors: ['#4F48ED'],
        xaxis: {
            categories: [
                <?php
                    foreach ($GlobalCost as $item) {
                        echo 'getFullMonthh('.((int)$item->report_bulan - 1).'),';
                    }        
                ?> 
            ]
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value.toFixed(1)+" Jt";
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
            data: [
                <?php
                    foreach ($CostPerArea as $item) {
                        echo ((int)$item->report_total_transaksi / 1000000).'.toFixed(1),';
                    }    
                ?>
            ]
        }],
        colors: ['#4F48ED'],
        xaxis: {
            categories: [
                <?php
                    foreach ($CostPerArea as $item) {
                        echo 'getFullMonthh('.((int)$item->report_bulan - 1).'),';
                    }        
                ?> 
            ]
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value.toFixed(1)+" Jt";
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

    function getFullMonthh (month){
            switch (month) {
                case 0:
                    return 'Januari'
                    break;
                case 1:
                    return 'Februari'
                    break;
                case 2:
                    return 'Maret'
                    break;
                case 3:
                    return 'April'
                    break;
                case 4:
                    return 'Mei'
                    break;
                case 5:
                    return 'Juni'
                    break;
                case 6:
                    return 'Juli'
                    break;
                case 7:
                    return 'Agustus'
                    break;
                case 8:
                    return 'September'
                    break;
                case 9:
                    return 'Oktober'
                    break;
                case 10:
                    return 'November'
                    break;
                case 11:
                    return 'Desember'
                    break;
                default:
                    break;
            }
        }
</script>