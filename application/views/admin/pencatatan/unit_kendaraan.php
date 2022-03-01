<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <?php echo validation_errors(); ?>
        <?= form_open_multipart('admin/peminjaman/store'); ?>
        <p class="mb-3 fs-5 font-w-500 color-darker">
            Transaksi Peminjaman
        </p>
        <div class="card-section">
            <div class="head">
                <p>Area Operasional</p>
            </div>
            <div class="body form">
                <div class="col-12 col-lg-12 pe-0 d-flex flex-column justify-content-between">
                    <div class="row m-0 p-0 w-100">
                        <div class="col-12 col-lg-6 ps-0">
                            <label class="my-3">Tanggal Awal Transaksi</label>
                            <input type="date" class="login-input regular col-xl-6" name="tanggal_start" id="datepicker" required>
                        </div>
                        <div class="col-12 col-lg-6 pe-0">
                            <label class="my-3">Tanggal Akhir Transaksi</label>
                            <input type="date" class="login-input regular col-xl-6" name="tanggal_end" id="datepicker" required>
                        </div>
                    </div>
                    <label class="mb-3">Kendaraan</label>
                    <select name="kendaraan" class="form-control" id="slct_kendaraan" required>
                        <option value="" disabled selected>Pilih Kendaraan</option>
                        <?php foreach ($datakendaraan as $key) : ?>
                            <option value="<?php echo $key->kendaraan_no_rangka ?>|<?php echo $key->kendaraan_stnk ?>"><?php echo $key->kendaraan_stnk ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="mt-3" id="boxInfoKendaraan">
                        <p style="text-align: center;font-weight: bold;font-size: 18px;">Detail Kendaraan</p>
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
                    </div>
                    <div id="kendaraan_alert" style="color: red;" hidden>Harap memilih kendaraan terlebih dahulu!</div>
                    <label class="my-3">Klien</label>
                    <select name="instansi" class="form-control" id="slct_klien" required>

                        <option value="" disabled selected>Pilih Klien</option>
                        <?php foreach ($datainstansi as $key) : ?>
                            <option value="<?php echo $key->client_id ?>"><?php echo $key->client_nama ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="mt-3" id="boxInfoKlien">
                        <p style="text-align: center;font-weight: bold;font-size: 18px;">Detail Klien</p>
                        <div class="row">
                            <div class="col">
                                <div class="d-flex flex-column my-2 w-100 col-md-6">
                                    <label class="my-2 color-secondary">Nama</label>
                                    <input type="text" class="login-input regular fs-16px" name="" id="klien_nama" value="" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex flex-column my-2 w-100 col-md-6">
                                    <label class="my-2 color-secondary">Jenis</label>
                                    <input type="text" class="login-input regular fs-16px" name="" id="klien_jenis" value="" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="d-flex flex-column my-2 w-100 col-md-6">
                                    <label class="my-2 color-secondary">Alamat</label>
                                    <input type="text" class="login-input regular fs-16px" name="" id="klien_alamat" value="" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex flex-column my-2 w-100 col-md-6">
                                    <label class="my-2 color-secondary">Kontak</label>
                                    <input type="text" class="login-input regular fs-16px" name="" id="klien_kontak" value="" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="d-flex flex-column my-2 w-100 col-md-6">
                                    <label class="my-2 color-secondary">NPWP</label>
                                    <input type="text" class="login-input regular fs-16px" name="" id="klien_npwp" value="" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex flex-column my-2 w-100 col-md-6">
                                    <label class="my-2 color-secondary">Nomor Rekening</label>
                                    <input type="text" class="login-input regular fs-16px" name="" id="klien_norek" value="" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-column my-2 w-100">
                                    <label class="my-2 color-secondary">Wilayah</label>
                                    <input type="text" class="login-input regular fs-16px" name="" id="klien_wilayah" value="" disabled>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <button type="submit" class="btn-table submit-modal">
            Kirim Data
        </button>
        <?= form_close(); ?>
    </div>
</div>
<!-- Modal Info Kendaraan -->
<!-- <div class="modal fade" id="info_kendaraan" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
</div> -->
<!-- Modal Info Klien -->
<div class="modal fade" id="info_klien" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content p-2">
            <div class="modal-header">
                <p class="font-w-700 color-darker mb-0">Info Klien</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-14px pt-0 d-flex flex-column">
                <div class="pb-4">
                    <div class="row">
                        <div class="col">
                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                <label class="my-2 color-secondary">Nama</label>
                                <input type="text" class="login-input regular fs-16px" name="" id="klien_nama" value="" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                <label class="my-2 color-secondary">Jenis</label>
                                <input type="text" class="login-input regular fs-16px" name="" id="klien_jenis" value="" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                <label class="my-2 color-secondary">Alamat</label>
                                <input type="text" class="login-input regular fs-16px" name="" id="klien_alamat" value="" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                <label class="my-2 color-secondary">Kontak</label>
                                <input type="text" class="login-input regular fs-16px" name="" id="klien_kontak" value="" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                <label class="my-2 color-secondary">NPWP</label>
                                <input type="text" class="login-input regular fs-16px" name="" id="klien_npwp" value="" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                <label class="my-2 color-secondary">Nomor Rekening</label>
                                <input type="text" class="login-input regular fs-16px" name="" id="klien_norek" value="" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Wilayah</label>
                                <input type="text" class="login-input regular fs-16px" name="" id="klien_wilayah" value="" disabled>
                            </div>
                        </div>
                        <!-- <div class="col">
                            
                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                <label class="my-2 color-secondary">Umur</label>
                                <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_umur" value="" disabled>
                            </div>
                        </div> -->
                    </div>
                    
                    <input type="hidden" class="login-input regular fs-16px" name="driver_nik">
                    <button class="btn-table submit-modal mt-5" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#slct_kendaraan').change(function(){
        const id = $(this).val()
        if(id){
            $.ajax({
                url: '<?= site_url('master/kendaraan/ajxGet')?>',
                method: 'post',
                data: {id},
                success: function(res){
                    res = JSON.parse(res)
                    res['kendaraan_jenis'] = res['kendaraan_jenis'] == "Perusahaan" ? `${res['kendaraan_pt']}` : res['kendaraan_jenis'];

                    tglJatuhSim = new Date(res['kendaraan_deadlinesim']);
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

                    $('#boxInfoKendaraan').attr('hidden', false);
                }
            })
        }else{
            $('#boxInfoKendaraan').attr('hidden', true);
        }
    })
    $('#slct_klien').change(function(){
        const id = $(this).val()
        if(id){
            $.ajax({
                url: '<?= site_url('master/klien/ajxGetKlien')?>',
                method: 'post',
                data: {id},
                success: function(res){
                    res = JSON.parse(res)
                    $('#klien_nama').val(res['client_nama']);
                    $('#klien_jenis').val(res['client_jenis']);
                    $('#klien_alamat').val(res['client_alamat']);
                    $('#klien_kontak').val(res['client_contact']);
                    $('#klien_npwp').val(res['client_npwp']);
                    $('#klien_norek').val(res['client_norek']);
                    $('#klien_wilayah').val(res['client_region']);

                    $('#boxInfoKlien').attr('hidden', false);
                }
            })
        }else{
            $('#boxInfoKlien').attr('hidden', true);
        }
    })
    $('#infoKendaraan').click(function(){
        if($('#slct_kendaraan').val()){
            $('#kendaraan_alert').attr('hidden', true)
            $('#info_kendaraan').modal('show');
        }else{
            $('#kendaraan_alert').attr('hidden', false)
        }
    })
    $('#infoKlien').click(function(){
        if($('#slct_klien').val()){
            $('#klien_alert').attr('hidden', true)
            $('#info_klien').modal('show');
        }else{
            $('#klien_alert').attr('hidden', false)
        }
    })
</script>