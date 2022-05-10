<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <?php
            $date = date('Y-m-d');
            foreach ($notifSTNK as $item) {
                $statusAlert = 'warning';
                $jatuhTempo  = date_create($item->kendaraan_deadlinestnk);
                if(date_format($jatuhTempo, 'Y-m-d') < $date){
                    $statusAlert = 'danger';
                }
                echo '
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-'.$statusAlert.'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                Jatuh tempo pembayaran pajak STNK nomor kendaraan '.$item->kendaraan_stnk.' adalah '.date_format($jatuhTempo, "j F Y").', <span style="cursor: pointer;font-weight: bold;" onclick="showModalInfo(\''.$item->kendaraan_no_rangka.'|'.$item->kendaraan_stnk.'\', 1)" class="alert-link"><u><i>cek detail</i></u></span>
                            </div>
                        </div>
                    </div>        
                ';
            }
            foreach ($notifKir as $item) {
                $statusAlert = 'warning';
                $jatuhTempo  = date_create($item->kendaraan_deadlinekir);
                if(date_format($jatuhTempo, 'Y-m-d') < $date){
                    $statusAlert = 'danger';
                }
                echo '
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-'.$statusAlert.'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                Jatuh tempo pembayaran pajak KIR nomor kendaraan '.$item->kendaraan_stnk.' adalah '.date_format($jatuhTempo, "j F Y").', <span style="cursor: pointer;font-weight: bold;" onclick="showModalInfo(\''.$item->kendaraan_no_rangka.'|'.$item->kendaraan_stnk.'\', 2)" class="alert-link"><u><i>cek detail</i></u></span>
                            </div>
                        </div>
                    </div>        
                ';
            }
        ?>
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
        <div class="row" style="margin-bottom: 10px;">
            <div class="col">
                <div style="float: right;">
                    <span><i>Updated at : <?= date_format(date_create($reportUpdated->updated_at), 'j M Y H:i') ?></i></span>&nbsp;
                    <a href="<?= site_url('management/update-report')?>" class="btn-table green" style="padding-top: 7px;">
                        <span class="iconify-inline" data-icon="ci:refresh" data-width="20" data-height="20" style="margin-top: 3px;"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card-section">
                    <div class="head">
                        <p>Global Cost</p>
                        <?php
                            $totalGlobalCost = 0;
                            foreach ($GlobalCost as $item) {
                                $totalGlobalCost += $item->report_total_transaksi;
                            }    
                        ?>
                        <p id="totalGlobalCost">Total : Rp.<?= number_format($totalGlobalCost)?></p>
                        <div style="float: right;">
                            <div class="form-group">
                                <label>Tahun</label>
                                <select name="" id="filGlobalCost" class="form-control" style="width: 150px;" id="">
                                    <option value="All">Semua</option>
                                    <?php
                                        $currYear = date('Y');
                                        for($year = (int)$currYear; $startYear = 2021 <= $year; $year--){
                                            $isSelected = $currYear == $year ? 'selected' : '';
                                            echo '
                                                <option value="'.$year.'" '.$isSelected.'>'.$year.'</option>
                                            ';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
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
                        <div class="form-group">
                            <label for="">Area</label>
                            <select name="" id="filCostArea1" class="form-control filCostArea" style="width: 150px;" id="">
                                <option value="All">Semua</option>
                                <?php
                                    $i = 1;
                                    foreach ($masterArea as $item) {
                                        $first = $i++ == 1 ? 'selected' : '';
                                        echo '
                                            <option value="'.$item->dropdown_list.'" '.$first.'>'.$item->dropdown_list.'</option>
                                        ';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select name="" id="filCostArea2" class="form-control filCostArea" style="width: 150px;" id="">
                                <option value="All">Semua</option>
                                <?php
                                    $currYear = date('Y');
                                    for($year = (int)$currYear; $startYear = 2021 <= $year; $year--){
                                        $isSelected = $currYear == $year ? 'selected' : '';
                                        echo '
                                            <option value="'.$year.'" '.$isSelected.'>'.$year.'</option>
                                        ';
                                    }
                                ?>
                            </select>
                        </div>
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
                        <div class="form-group">
                            <label for="">Bulan</label>
                            <select name="" id="filJenisBiayaSparepart1" class="form-control filJenisBiayaSparepart" style="width: 150px;" id="">
                                <option value="All">Semua</option>
                                <?php
                                    $i = 0;
                                    $currMonth = date('n');
                                    foreach ($masterBulan as $item) {
                                        $isSelected = $currMonth == ++$i ? 'selected' : '';
                                        echo '
                                            <option value="'.$i.'" '.$isSelected.'>'.$item.'</option>
                                        ';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select name="" id="filJenisBiayaSparepart2" class="form-control filJenisBiayaSparepart" style="width: 150px;" id="">
                                <option value="All">Semua</option>
                                <?php
                                    $currYear = date('Y');
                                    for($year = (int)$currYear; $startYear = 2021 <= $year; $year--){
                                        $isSelected = $currYear == $year ? 'selected' : '';
                                        echo '
                                            <option value="'.$year.'" '.$isSelected.'>'.$year.'</option>
                                        ';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="body" style="margin-bottom: 12px;">
                        <div style="width: 99%;" id="chart_jenis"></div>
                    </div>
                    <div class="foot">
                    </div>
                </div>
            </div>
            
        <div class="row">
            <div class="col-6">
                <div class="card-section">
                    <div class="head">
                        <p>Total Cost PT</p>
                        <div class="form-group">
                            <label for="">Bulan</label>
                            <select name="" id="filCostPT" class="form-control filCostPT" style="width: 150px;" id="">
                                <option value="All">Semua</option>
                                <?php
                                    $i = 0;
                                    $currMonth = date('n');
                                    foreach ($masterBulan as $item) {
                                        $isSelected = $currMonth == ++$i ? 'selected' : '';
                                        echo '
                                            <option value="'.$i.'" '.$isSelected.'>'.$item.'</option>
                                        ';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select name="" id="filCostPT2" class="form-control filCostPT" style="width: 150px;" id="">
                                <option value="All">Semua</option>
                                <?php
                                    $currYear = date('Y');
                                    for($year = (int)$currYear; $startYear = 2021 <= $year; $year--){
                                        $isSelected = $currYear == $year ? 'selected' : '';
                                        echo '
                                            <option value="'.$year.'" '.$isSelected.'>'.$year.'</option>
                                        ';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="body" style="padding: 15px">
                        <table id="tblCostPT" class="table-custom">
                            <thead>
                                <tr>
                                    <th>PT</th>
                                    <th style="width: 20%;">Wilayah</th>
                                    <th style="width: 35%;">Total</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="foot">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-section">
                    <div class="head">
                        <p>Total Cost Per PT</p>
                        <div class="form-group">
                            <label for="">Daftar PT</label>
                            <select name="" id="filCostPerPT1" class="form-control filCostPerPT" style="width: 150px;" id="">
                                <option value="All">Semua</option>
                                <?php
                                    $i = 1;
                                    foreach ($masterPT as $item) {
                                        $first = $i++ == 1 ? 'selected' : '';
                                        echo '
                                            <option value="'.$item->dropdown_list.'" '.$first.'>'.$item->dropdown_list.'</option>
                                        ';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select name="" id="filCostPerPT2" class="form-control filCostPerPT" style="width: 150px;" id="">
                                <option value="All">Semua</option>
                                <?php
                                    $currYear = date('Y');
                                    for($year = (int)$currYear; $startYear = 2021 <= $year; $year--){
                                        $isSelected = $currYear == $year ? 'selected' : '';
                                        echo '
                                            <option value="'.$year.'" '.$isSelected.'>'.$year.'</option>
                                        ';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="body">
                        <div style="width: 99%;" id="chart_pt"></div>
                    </div>
                    <div class="foot">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card-section">
                    <div class="head">
                        <p>Cost Per Kendaraan</p>
                    </div>
                    <div class="body" style="padding: 15px">
                        <?php
                            $template = array('table_open' => '<table id="tblKendaraan" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No STNK', 'Pemilik', 'Jumlah Transaksi', 'Total Transaksi', 'Detail');

                            foreach ($Kendaraan as $row) {
                                $this->table->add_row(
                                    $row->report_stnk,
                                    $row->report_pt,
                                    number_format($row->report_jumlah_transaksi),
                                    'Rp.'.number_format($row->report_total_transaksi),
                                    '<a href="'.site_url('management/cost-kendaraan/'.str_replace(' ', '_', $row->report_no_rangka).'/'.str_replace(' ', '_', $row->report_stnk)).'" target="_blank">
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

<!-- Modal Info Kendaraan -->
<div class="modal fade" id="info_kendaraan" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content p-2">
            <div class="modal-header">
                <p class="font-w-700 color-darker mb-0">Info Kendaraan</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-14px pt-0 d-flex flex-column">
                <div class="pb-4">
                    
                    <div class="row">
                        <div class="col">
                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                <label class="my-2 color-secondary">Foto Kendaraan</label>
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators">
                                    </ol>
                                    <div class="carousel-inner">
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex flex-column my-2 w-100 col-md-6">
                                        <label class="my-2 color-secondary">Nomor Rangka</label>
                                        <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_rangka" value="" disabled>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex flex-column my-2 w-100 col-md-6">
                                        <label class="my-2 color-secondary">Nomor STNK</label>
                                        <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_stnk" value="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex flex-column my-2 w-100 col-md-6">
                                        <label class="my-2 color-secondary">Merk</label>
                                        <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_merk" value="" disabled>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex flex-column my-2 w-100 col-md-6">
                                        <label class="my-2 color-secondary">Kapasitas Tangki</label>
                                        <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_kapasitas" value="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex flex-column my-2 w-100 col-md-6">
                                        <label class="my-2 color-secondary">Tanggal Jatuh SIM</label>
                                        <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_tgljatuhsim" value="" disabled>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="d-flex flex-column my-2 w-100 col-md-6">
                                        <label class="my-2 color-secondary">Tanggal Jatuh KIR</label>
                                        <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_tgljatuhkir" value="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex flex-column my-2 w-100 col-md-6">
                                        <label class="my-2 color-secondary">Pemilik</label>
                                        <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_pemilik" value="" disabled>
                                    </div>
                                </div>
                                <div class="col">
                                <div class="d-flex flex-column my-2 w-100 col-md-6">
                                    <label class="my-2 color-secondary">Umur</label>
                                    <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_umur" value="" disabled>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <form action="<?= site_url('management/update-deadline')?>" method="POST">
                                <div class="d-flex flex-column my-2 w-100 col-md-6">
                                    <label class="my-2 color-secondary">Tanggal Deadline Pajak <span id="update_label"></span> Terbaru</label>
                                    <input type="date" name="deadline" min="<?= date('Y-m-d')?>" class="login-input regular fs-16px input-administrasi-input">
                                </div>
                                <input type="hidden" name="id" id="update_id">
                                <input type="hidden" name="status" id="update_status">
                                <button type="submit" data-slct="exp" class="btn-table green infoKendaraan">
                                    <span class="iconify-inline" data-icon="fluent:save-16-filled" data-width="15" data-height="15"></span>
                                    <span>Update</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <input type="hidden" class="login-input regular fs-16px" name="driver_nik">
                    <button class="btn-table submit-modal mt-5" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url() ?>assets/src/js/apexchart.js"></script>
<script>
    var tblCostPT = $('#tblCostPT').DataTable({
        'processing': true,
        'serverSide': true,
        'ordering': false,
        'searching': false,
        'serverMethod': 'post',
        'ajax': {
            'url':'<?= site_url('management/ajxUpdateCostPTAll')?>',
            'data': {
                'month': $('#filCostPT').val(),
                'year': $('#filCostPT2').val()
            }
        },
        "columnDefs": [
            { "name": "PT",   "targets": 0 },
            { "name": "Wilayah",  "targets": 1 },
            { "name": "Total", "targets": 2 }
        ],
        'columns': [
            { data: 'pt' },
            { data: 'wilayah' },
            { data: 'total' }
        ]
    });
    $('#tblKendaraan').DataTable({
        'ordering': false
    });
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
                        echo number_format(((float)$item->report_total_transaksi / 1000000), 2, '.', '').',';
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
                    return value.toFixed(2)+" Jt";
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
                        echo number_format(((float)$item->report_total_transaksi / 1000000), 2, '.', '').',';
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
                    return value.toFixed(2)+" Jt";
                }
            },
        },
        dataLabels: {
          enabled: true,
        },
    }
    var options3 = {
        chart: {
            type: 'bar',
            height: '300px'
        },
        series: [{
            name: 'sales',
            data: [
                <?php
                    foreach ($JenisPengeluaran as $item) {
                        // echo ((int)$item->report_total_transaksi / 1000000).'.toFixed(1),';
                        echo number_format(((float)$item->total_jenis_pengeluaran / 1000000), 2, '.', '').',';
                    }    
                ?>
            ]
        }],
        colors: ['#4F48ED'],
        xaxis: {
            categories: [
                <?php
                    foreach ($JenisPengeluaran as $item) {
                        echo '"'.$item->pengeluaran_group.'",';
                    }        
                ?> 
            ]
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value.toFixed(2)+" Jt";
                }
            },
        },
        dataLabels: {
          enabled: true,
        },
    }
    var options4 = {
        chart: {
            type: 'bar',
            height: '300px'
        },
        series: [{
            name: 'sales',
            data: [
                <?php
                    foreach ($TransaksiPT as $item) {
                        echo number_format(((float)$item->report_total_transaksi / 1000000), 2, '.', '').',';
                    }    
                ?>
            ]
        }],
        colors: ['#4F48ED'],
        xaxis: {
            categories: [
                <?php
                    foreach ($TransaksiPT as $item) {
                        echo 'getFullMonthh('.((int)$item->report_bulan - 1).'),';
                    }        
                ?> 
            ]
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value.toFixed(2)+" Jt";
                }
            },
        },
        dataLabels: {
          enabled: true,
        },
    }

    var chart = new ApexCharts(document.querySelector("#chart_global"), options);
    var chart2 = new ApexCharts(document.querySelector("#chart_area"), options2);
    var chart3 = new ApexCharts(document.querySelector("#chart_jenis"), options3);
    var chart4 = new ApexCharts(document.querySelector("#chart_pt"), options4);

    chart.render();
    chart2.render();
    chart3.render();
    chart4.render();

    $('#filGlobalCost').change(function(){
        $.ajax({
            url: '<?= site_url('management/ajxUpdateGlobalCost')?>',
            method: 'POST',
            data: {year: $(this).val()},
            success: function(res){
                res = JSON.parse(res)
                
                data = []
                categories = []
                totalCost = 0

                for(let i of res){
                    data.push((i.report_total_transaksi / 1000000).toFixed(2))
                    categories.push(getFullMonthh(i.report_bulan - 1))
                    totalCost += parseInt(i.report_total_transaksi)
                }
                $('#totalGlobalCost').html(`Total : Rp.${numberWithCommas(totalCost)}`)
                var updateOptions = {
                    chart: {
                        type: 'area',
                        height: '300px'
                    },
                    series: [{
                        name: 'sales',
                        data
                    }],
                    colors: ['#4F48ED'],
                    xaxis: {
                        categories
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return value.toFixed(2)+" Jt";
                            }
                        },
                    },
                    dataLabels: {
                    enabled: true,
                    },
                }
                $('#chart_global').empty()
                var updateChart = new ApexCharts(document.querySelector("#chart_global"), updateOptions);
                updateChart.render();

            }
        })
    })

    $('.filCostArea').change(function (){
        const area = $('#filCostArea1').val()
        const year = $('#filCostArea2').val()
        $.ajax({
            url: '<?= site_url('management/ajxUpdateCostArea')?>',
            method: 'POST',
            data: {area, year},
            success: function(res){
                res = JSON.parse(res)
                
                data = []
                categories = []

                for(let i of res){
                    data.push((i.report_total_transaksi / 1000000).toFixed(2))
                    categories.push(getFullMonthh(i.report_bulan - 1))
                }
                var updateOptions2 = {
                    chart: {
                        type: 'bar',
                        height: '300px'
                    },
                    series: [{
                        name: 'sales',
                        data
                    }],
                    colors: ['#4F48ED'],
                    xaxis: {
                        categories
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return value.toFixed(2)+" Jt";
                            }
                        },
                    },
                    dataLabels: {
                        enabled: true,
                    },
                }
                $('#chart_area').empty()
                var updateChart2 = new ApexCharts(document.querySelector("#chart_area"), updateOptions2);
                updateChart2.render();
            }
        })
    })
    $('.filJenisBiayaSparepart').change(function(){
        const month = $('#filJenisBiayaSparepart1').val()
        const year = $('#filJenisBiayaSparepart2').val()
        $.ajax({
            url: '<?= site_url('management/ajxUpdateJenisPengeluaran')?>',
            method: 'POST',
            data: {month, year},
            success: function(res){
                res = JSON.parse(res)
                
                data = []
                categories = []

                for(let i of res){
                    data.push((i.total_jenis_pengeluaran / 1000000).toFixed(2))
                    categories.push(i.pengeluaran_group)
                }
                var updateOptions3 = {
                    chart: {
                        type: 'bar',
                        height: '300px'
                    },
                    series: [{
                        name: 'sales',
                        data
                    }],
                    colors: ['#4F48ED'],
                    xaxis: {
                        categories
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return value.toFixed(2)+" Jt";
                            }
                        },
                    },
                    dataLabels: {
                        enabled: true,
                    },
                }
                $('#chart_jenis').empty()
                var updateChart3 = new ApexCharts(document.querySelector("#chart_jenis"), updateOptions3);
                updateChart3.render();
            }
        })
    })
    $('.filCostPerPT').change(function (){
        const pt = $('#filCostPerPT1').val()
        const year = $('#filCostPerPT2').val()
        $.ajax({
            url: '<?= site_url('management/ajxUpdateCostPT')?>',
            method: 'POST',
            data: {pt, year},
            success: function(res){
                res = JSON.parse(res)
                
                data = []
                categories = []

                for(let i of res){
                    data.push((i.report_total_transaksi / 1000000).toFixed(2))
                    categories.push(getFullMonthh(i.report_bulan - 1))
                }
                var updateOptions4 = {
                    chart: {
                        type: 'bar',
                        height: '300px'
                    },
                    series: [{
                        name: 'sales',
                        data
                    }],
                    colors: ['#4F48ED'],
                    xaxis: {
                        categories
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return value.toFixed(2)+" Jt";
                            }
                        },
                    },
                    dataLabels: {
                        enabled: true,
                    },
                }
                $('#chart_pt').empty()
                var updateChart4 = new ApexCharts(document.querySelector("#chart_pt"), updateOptions4);
                updateChart4.render();
            }
        })
    })
    $('.filCostPT').change(function(){
        tblCostPT.destroy()
        tblCostPT = $('#tblCostPT').DataTable({
            'processing': true,
            'serverSide': true,
            'ordering': false,
            'searching': false,
            'serverMethod': 'post',
            'ajax': {
                'url':'<?= site_url('management/ajxUpdateCostPTAll')?>',
                'data': {
                    'month': $('#filCostPT').val(),
                    'year': $('#filCostPT2').val()
                }
            },
            "columnDefs": [
                { "name": "PT",   "targets": 0 },
                { "name": "Wilayah",  "targets": 1 },
                { "name": "Total", "targets": 2 }
            ],
            'columns': [
                { data: 'pt' },
                { data: 'wilayah' },
                { data: 'total' }
            ]
        });
    })


    const showModalInfo = (id, statusUpdate) => {
        $('#update_id').val(id);
        $('#update_status').val(statusUpdate);
        $('#update_label').html(statusUpdate == "1" ? "STNK" : "KIR");

        $.ajax({
            url: '<?= site_url('master/kendaraan/ajxGet')?>',
            method: 'post',
            data: {id},
            success: function(res){
                res = JSON.parse(res)
                res['kendaraan_jenis'] = res['kendaraan_jenis'] == "Perusahaan" ? `${res['kendaraan_pt']}` : res['kendaraan_jenis'];

                tglJatuhSim = new Date(res['kendaraan_deadlinestnk']);
                tglJatuhSim = `${tglJatuhSim.getDay()} ${getFullMonth(tglJatuhSim.getMonth())} ${tglJatuhSim.getFullYear()}`;
                
                tglJatuhKIR = new Date(res['kendaraan_deadlinekir']);
                tglJatuhKIR = `${tglJatuhKIR.getDay()} ${getFullMonth(tglJatuhKIR.getMonth())} ${tglJatuhKIR.getFullYear()}`;

                $('#kendaraan_rangka').val(res['kendaraan_no_rangka']);
                $('#kendaraan_stnk').val(res['kendaraan_stnk']);
                $('#kendaraan_merk').val(res['kendaraan_merk']);
                $('#kendaraan_pemilik').val(res['kendaraan_jenis']);
                $('#kendaraan_tgljatuhsim').val(tglJatuhSim);
                $('#kendaraan_tgljatuhkir').val(tglJatuhKIR);
                $('#kendaraan_umur').val(res['umur']);
                $('#kendaraan_kapasitas').val(res['kendaraan_kapasitas_tangki']+" Liter");

                let index = 0;
                let indicators = '';
                let carouselInner = '';
                let status = 'active';

                for(let i of res['kendaraan_foto']){
                    if(index != 0){
                        status = '';
                    }
                    
                    indicators += `
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="${index}" class="${status}"></li>
                    `;

                    carouselInner += `
                        <div class="carousel-item ${status}">
                            <img class="d-block imgItem" style="height: 312px;width: 600px;background-size: cover;" src="<?= site_url('')?>assets/images/fotokendaraan/${i}" alt="Second slide" alt="">
                        </div>
                    `;
                    index++
                }
                $('.carousel-indicators').html(indicators)
                $('.carousel-inner').html(carouselInner)
                $('.carousel-item').zoom({
                    on: 'grab'
                })
                $('#info_kendaraan').modal('show');
            }
        })
    }

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