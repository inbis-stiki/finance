
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
        <div class="row" style="margin-bottom: 10px;">
            <div class="col">
                <div style="float: right;">
                    <span><i>Updated at : <?= date_format(date_create($reportUpdated->updated_at), 'j M Y H:i') ?></i></span>&nbsp;
                    <a href="<?= site_url('admin/update-report')?>" class="btn-table green" style="padding-top: 7px;">
                        <span class="iconify-inline" data-icon="ci:refresh" data-width="20" data-height="20" style="margin-top: 3px;"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-section">
            <div class="head">
                <p>Global Cost</p>
            </div>
            <div class="body" style="padding: 15px;">
                <?php
                $template = array('table_open' => '<table id="tblGlobal" class="table-custom" border="0">');
                $this->table->set_template($template);
                $this->table->set_heading('Area Operasional', 'Jumlah Transaksi', 'Total Transaksi');

                foreach ($GlobalCost as $row) {
                    $this->table->add_row(
                        $row->report_wilayah,
                        $row->report_jumlah_transaksi,
                        "Rp." . number_format($row->report_total_transaksi)
                    );
                }
                echo $this->table->generate();
                ?>

            </div>
            <div class="foot">
            </div>
        </div>
        <div class="card-section">
            <div class="head">
                <p>Daftar Kendaraan</p>
            </div>
            <div class="body" style="padding: 15px">
                <?php
                $template = array('table_open' => '<table id="tblKendaraan" class="table-custom">');
                $this->table->set_template($template);
                $this->table->set_heading('No. STNK', 'Pemilik', 'Merk Kendaraan', 'Umur Kendaraan', 'Wilayah');

                foreach ($DaftarKendaraan as $row) {
                    $currentDate = date("Y-m-d");
                    $umur = date_diff(date_create($row->kendaraan_tanggal_beli), date_create($currentDate));

                    $this->table->add_row(
                        $row->kendaraan_stnk,
                        $row->kendaraan_jenis == "Pribadi" ? "Pribadi" : $row->kendaraan_pt,
                        $row->kendaraan_merk,
                        $umur->format("%m") . " Bulan " . $umur->format('%y') . "Tahun",
                        $row->kendaraan_wilayah,
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
                    <input type="hidden" class="login-input regular fs-16px" name="driver_nik">
                    <button class="btn-table submit-modal mt-5" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#tblGlobal').DataTable();
        $('#tblKendaraan').DataTable();
    })
    const showModalInfo = (id, statusUpdate) => {
        $('#update_id').val(id);
        $('#update_status').val(statusUpdate);
        $('#update_label').html(statusUpdate == "1" ? "STNK" : "KIR");

        $.ajax({
            url: '<?= site_url('admin/transaksi/ajxGetKendaraan')?>',
            method: 'post',
            data: {id},
            success: function(res){
                res = JSON.parse(res)
                res['kendaraan_jenis'] = res['kendaraan_jenis'] == "Perusahaan" ? `${res['kendaraan_pt']}` : res['kendaraan_jenis'];

                tglJatuhSim = new Date(res['kendaraan_deadlinestnk']);
                tglJatuhSim = `${tglJatuhSim.getDate()} ${getFullMonth(tglJatuhSim.getMonth())} ${tglJatuhSim.getFullYear()}`;
                
                tglJatuhKIR = new Date(res['kendaraan_deadlinekir']);
                tglJatuhKIR = `${tglJatuhKIR.getDate()} ${getFullMonth(tglJatuhKIR.getMonth())} ${tglJatuhKIR.getFullYear()}`;

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
                            <img class="d-block imgItem" style="height: 312px;width: 600px;background-size: cover;" src="${i}" alt="Second slide" alt="">
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
</script>