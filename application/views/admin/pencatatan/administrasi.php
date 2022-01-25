<form action="<?= site_url('admin/transaksi/store-administrasi')?>" method="post">
    <div class="body form">
        <div class="row m-0 p-0 w-100">
            <div class="col-12 col-lg-6 ps-0">
                <label class="mb-3">Nomor STNK Kendaraan</label>
                <select name="admin_stnk" id="adm_slct_kendaraan" class="login-input regular fs-16px input-administrasi-input">
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
                    <button type="button" data-slct="adm" class="btn-table infoKendaraan">
                        <span class="iconify-inline" data-icon="ps:car" data-width="15" data-height="15"></span>
                        <span>Info Kendaraan</span>
                    </button>
                </div>
                <div id="adm_alert" style="color: red;" hidden>Harap memilih kendaraan terlebih dahulu!</div>
            </div>
            <div class="col-12 col-lg-6 pe-0">
                <label class="mb-3">Tanggal Transaksi</label>
                <input type="date" id="adm_inpt_tglBeli" max="<?= date('Y-m-d')?>" class="login-input regular fs-16px input-administrasi-input">
                <div class="alert alert-danger mt-3" style="margin-bottom: -0.5rem;" id="adm_alert2" role="alert" hidden>
                    Harap masukkan data dengan benar!
                </div>
                <button type="button" class="btn-table submit-modal mt-3" id="input-administrasi">
                    Masukkan Data
                </button>
            </div>
            <!-- <div class="ms-auto col-12 col-lg-6 mt-3 pe-0 input-administrasi">
                <div class="alert alert-danger" id="adm_alert2" role="alert" hidden>
                    Harap masukkan data dengan benar!
                </div>
                <button type="button" class="btn-table submit-modal" id="input-administrasi">
                    Masukkan Data
                </button>
            </div> -->
        </div>
    </div>
    <div class="head mid administrasi-extend">
        <p>CATATAN PENGELUARAN ADMINISTRASI</p>
    </div>
    <div class="body form administrasi-extend" >
        <div id="adm_boxInput">

        </div>
        <button style="color: gray !important;" type="button" class="btn-table add-entry mt-3" id="adm_tambahInput">
            Tambah Data
        </button>
    </div>
    <input type="hidden" name="kendaraan" id="adm_inptKendaraan">
    <input type="hidden" name="tglTransaksi" id="adm_inptTglTrans">
    <button type="submit" class="btn-table submit-modal submit-administrasi absolute disabled" disabled>
        Simpan Data
    </button>
</form>
<script>
    let adm_inptCount = 1;
    let jenPeng = ""
    <?php
        foreach ($pengAdmin as $item) {
            echo '
                jenPeng += \'<option value="'.$item->pengeluaran_id.'">'.$item->pengeluaran_jenis.'</option>\'
            ';
        }    
    ?>
    $('#adm_tambahInput').click(function(){
        $('#adm_boxInput').append(admRenderHtml())
        generateNoAdministrasi();
    })
    const admRenderHtml = () => {
        adm_inptCount++;
        return `
            <div id="adm_boxInputItem_${adm_inptCount}">
                <p class="font-w-700 fs-16px my-2">
                    <button type="button" class="btn-table red" onclick="deleteItemAdministrasi(${adm_inptCount})">
                        <span class="iconify-inline" data-icon="carbon:trash-can"data-width="15" data-height="15"></span>
                    </button>
                    &nbsp;
                    Pengeluaran <span class="adm_no" data-id="${adm_inptCount}" id="adm_no_${adm_inptCount}"></span>
                </p>
                <div class="row m-0 p-0 w-100">
                    <div class="col-12 col-lg-6 ps-0">
                        <label class="mb-3">Jenis Pengeluaran</label>
                        <select name="jenPeng[]" id="provinsi" class="login-input regular fs-16px" required>
                            <option value="" disabled selected>Pilih Jenis Pengeluaran</option>
                            ${jenPeng}
                        </select>
                    </div>
                    <div class="col-12 col-lg-6 pe-0">
                        <label class="mb-3">Total Biaya</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="text" name="total[]" onkeypress="return isNumberKey(event)" onkeyup="addCommaNumeric(event)" class="form-control" aria-describedby="basic-addon1" required>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
    const deleteItemAdministrasi = id => {
        $('#adm_boxInputItem_'+id).remove();
        generateNoAdministrasi();
    }
    const generateNoAdministrasi = () => {
        let no = 1;
        if($('.adm_no').length){
            $('.adm_no').each(function(i, obj) {
                $(this).html(no)
                no++
            });
        }else{
            $(".administrasi-extend").removeClass('active');
            $(".submit-administrasi").prop('disabled', true);
            $(".input-administrasi").show();
            $(".input-administrasi-input").prop('disabled', false);  
        }
    }
</script>