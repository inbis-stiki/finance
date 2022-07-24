<div class="min-vh-100 general-padding bg-light-purple">
    
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Transaksi
            </p>
            <a href="#" class="btn-table green" type="button">Saldo: Rp. <?= number_format($saldo->balance)?></a>
        </div>
        <?php
            if(!empty($this->session->flashdata('err_msg'))){
                echo '
                    <div class="alert alert-danger" role="alert">
                    '.$this->session->flashdata('err_msg').'
                    </div>
                ';        
            }
            if(!empty($this->session->flashdata('succ_msg'))){
                echo '
                    <div class="alert alert-success" role="alert">
                        '.$this->session->flashdata('succ_msg').'
                    </div>
                ';        
            }
        ?>
        <div class="card-section">
            <div class="head pb-0">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Administrasi</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Maintenance</button>
                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Expense</button>
                    </div>
                </nav>
            </div>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <?php $this->load->view('admin/pencatatan/administrasi') ?>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <?php $this->load->view('admin/pencatatan/maintenance') ?>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <?php $this->load->view('admin/pencatatan/expense') ?>
                </div>
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
    $(document).ready(function(){
        <?php
            if($this->session->flashdata('succ_modal')){
                echo '$("#success").modal("show");';
            }    
        ?>
        $('.select2').select2();
    })
    $('.infoKendaraan').click(function(){
        const slct = $(this).data('slct')
        let id = ""
        
        if(slct == "adm"){
            id = $('#adm_slct_kendaraan').val()
        }else if(slct == "main"){
            id = $('#main_slct_kendaraan').val()
        }else if(slct == "exp"){
            id = $('#exp_slct_kendaraan').val()
        }

        if(id){
            $('#'+slct+"_alert").attr('hidden', true)
        }else{
            $('#'+slct+"_alert").attr('hidden', false)
        }

        $.ajax({
            url: '<?= site_url('admin/transaksi/ajxGetKendaraan')?>',
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
    })
</script>