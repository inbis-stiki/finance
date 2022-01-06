<form action="<?= site_url('admin/jenis-biaya/store-maintenance')?>" method="post">
    <div class="body form">
        <div class="row m-0 p-0 w-100">
            <div class="col-12 col-lg-6 ps-0">
                <label class="mb-3">Nomor STNK Kendaraan</label>
                <select id="main_slct_kendaraan" class="login-input regular fs-16px input-maintenance-input">
                    <option value="" disabled selected>Pilih STNK</option>
                    <?php
                        foreach ($kendaraans as $item) {
                            echo '
                                <option value="'.$item->kendaraan_no_rangka.'|'.$item->kendaraan_stnk.'">'.$item->kendaraan_stnk.'</option>
                            ';
                        }
                    ?>
                </select>
                <div class="mt-3" id="boxInfoKendaraan">
                    <button type="button" data-slct="main" class="btn-table infoKendaraan">
                        <span class="iconify-inline" data-icon="ps:car" data-width="15" data-height="15"></span>
                        <span>Info Kendaraan</span>
                    </button>
                </div>
                <div id="main_alert" style="color: red;" hidden>Harap memilih kendaraan terlebih dahulu!</div>
            </div>
            <div class="col-12 col-lg-6 pe-0">
                <label class="mb-3">Tanggal Service</label>
                <input type="date" id="main_inpt_tglService" class="login-input regular fs-16px input-maintenance-input">
            </div>
            <div class="col-12 col-lg-6 mt-3 ps-0">
                <div class="row m-0 p-0 w-100">
                    <div class="col-6 ps-0">
                        <label class="mb-3">Nama Toko</label>
                        <input type="text" id="main_inpt_toko" class="login-input regular fs-16px input-maintenance-input">
                    </div>
                    <div class="col-6">
                        <label class="mb-3">Jarak Tempuh</label>
                        <div class="input-group mb-3">
                            <input type="number" id="main_inpt_jarak" onkeypress="return isNumberKey(event)" class="form-control input-maintenance-input" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">km</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 mt-auto mb-3 pe-0 input-maintenance">
                <div class="alert alert-danger mt-3" id="main_alert" role="alert" hidden>
                    Harap masukkan data dengan benar!
                </div>
                <button type="button" class="btn-table submit-modal" id="input-maintenance">
                    Masukkan Data
                </button>
            </div>
        </div>
    </div>
    <div class="head mid maintenance-extend">
        <p>CATATAN PENGELUARAN MAINTENANCE</p>
    </div>
    <div class="body form maintenance-extend">
        <div id="main_boxInput">

        </div>
        <button style="color: gray !important;" type="button" class="btn-table add-entry mt-3" id="main_tambahInput">
            Tambah Data
        </button>
    </div>
    <input type="hidden" name="kendaraan" id="main_inptKendaraan">
    <input type="hidden" name="tglService" id="main_inptTglService">
    <input type="hidden" name="toko" id="main_inptToko">
    <input type="hidden" name="jarak" id="main_inptJarak">
    <button type="submit" class="btn-table submit-modal submit-maintenance absolute disabled" disabled>
        Simpan Data
    </button>
</form>
<script>
    let main_inptCount = 0;
    let jenPengMain = ""
    <?php
        foreach ($pengMaint as $item) {
            echo '
                jenPengMain += \'<option value="'.$item->pengeluaran_id.'">'.$item->pengeluaran_jenis.'</option>\'
            ';
        }    
    ?>

    let sparepart = "";
    <?php
        foreach ($sparepart as $item) {
            echo '
                sparepart += \'<option value="'.$item->sparepart_id.'">'.$item->sparepart_nama.'</option>\'
            ';
        }    
    ?>

    $('#main_tambahInput').click(function(){
        $('#main_boxInput').append(mainRenderHtml())
        generateNoMaintenance();
    })
    const mainRenderHtml = () => {
        main_inptCount++;
        return `
            <div id="main_boxInputItem_${main_inptCount}">
                <p class="font-w-700 fs-16px my-2">
                    <button type="button" class="btn-table red" onclick="deleteItemMaintenance(${main_inptCount})">
                        <span class="iconify-inline" data-icon="carbon:trash-can"data-width="15" data-height="15"></span>
                    </button>
                    &nbsp;
                    Pengeluaran <span class="main_no" data-id="${main_inptCount}" id="main_no_${main_inptCount}"></span>
                </p>
                <div class="row m-0 p-0 w-100">
                    <div class="col-12 col-lg-6 ps-0">
                        <label class="mb-3">Jenis Pengeluaran</label>
                        <select name="jenPeng[]" id="" class="login-input regular fs-16px" required>
                            <option value="" disabled selected>Pilih Jenis Pengeluaran</option>
                            ${jenPengMain}
                        </select>
                    </div>
                    <div class="col-12 col-lg-6 pe-0">
                        <div class="row m-0 p-0 w-100">
                            <div class="col-6 ps-0">
                                <label class="mb-3">Jenis Sparepart</label>
                                <select name="sparepart[]" class="login-input regular fs-16px" required>
                                    <option value="" disabled selected>Pilih Jenis Sparepart</option>
                                    ${sparepart}
                                </select>
                            </div>
                            <div class="col-6 pe-0">
                                <label class="mb-3">Nomor Seri</label>
                                <input type="text" name="noSeri[]" class="login-input regular fs-16px" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 ps-0">
                        <div class="row m-0 p-0 w-100">
                            <div class="col-6 ps-0">
                                <label class="my-3">Qty</label>
                                <div class="input-group mb-3">
                                    <input type="number" id="main_inptKuan_${main_inptCount}" name="kuantitas[]" onkeypress="return isNumberKey(event)" onkeyup="calculateBiayaMaintenance(${main_inptCount})" class="form-control" aria-describedby="basic-addon2" required>
                                    <span class="input-group-text" id="basic-addon2">pcs</span>
                                </div>
                            </div>
                            <div class="col-6 pe-0">
                                <label class="my-3">Harga</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                    <input type="number" id="main_inptHarga_${main_inptCount}" name="" onkeypress="return isNumberKey(event)" onkeyup="calculateBiayaMaintenance(${main_inptCount})" class="form-control" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-6 pe-0">
                        <div class="row m-0 p-0 w-100">
                            <div class="col-6 ps-0">
                                <label class="my-3">Total Biaya</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                    <input type="number" name="total[]" id="main_inptBiaya_${main_inptCount}" class="form-control" aria-describedby="basic-addon1" readonly required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
    const calculateBiayaMaintenance = id => {
        const kuantitas = $('#main_inptKuan_'+id).val()
        const harga = $('#main_inptHarga_'+id).val()
        if(kuantitas && harga){
            $('#main_inptBiaya_'+id).val(kuantitas*harga);
        }
        
    }
    const deleteItemMaintenance = id => {
        $('#main_boxInputItem_'+id).remove();
        generateNoMaintenance();
    }
    const generateNoMaintenance = () => {
        let no = 1;
        if($('.main_no').length){
            $('.main_no').each(function(i, obj) {
                $(this).html(no)
                no++
            });
        }else{
            $(".maintenance-extend").removeClass('active');
            $(".submit-maintenance").prop('disabled', true);
            $(".input-maintenance").show();
            $(".input-maintenance-input").prop('disabled', false); 
        }
    }
</script>
