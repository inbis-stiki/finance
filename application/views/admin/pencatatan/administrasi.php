<form action="<?= site_url('admin/jenis-biaya/store-administrasi')?>" method="post">
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
            </div>
            <div class="col-12 col-lg-6 pe-0">
                <label class="mb-3">Tanggal Transaksi</label>
                <input type="date" id="adm_inpt_tglBeli" class="login-input regular fs-16px input-administrasi-input">
            </div>
            <div class="ms-auto col-12 col-lg-6 mt-3 pe-0 input-administrasi">
                <div class="alert alert-danger" id="adm_alert" role="alert" hidden>
                    Harap masukkan nomor stnk kendaraan dan tanggal transaksi!
                </div>
                <button type="button" class="btn-table submit-modal" id="input-administrasi">
                    Masukkan Data
                </button>
            </div>
        </div>
    </div>
    <div class="head mid administrasi-extend">
        <p>CATATAN PENGELUARAN ADMINISTRASI</p>
    </div>
    <div class="body form administrasi-extend" >
        <div id="adm_boxInput">

        </div>
        <button type="button" class="btn-table add-entry mt-3" id="adm_tambahInput">
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
    let adm_inptCount = 0;
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
    })
    const admRenderHtml = () => {
        adm_inptCount++;
        return `
            <p class="font-w-700 fs-16px my-2">
                <button type="button" class="btn-table red">
                    <span class="iconify-inline" data-icon="carbon:trash-can"data-width="15" data-height="15"></span>
                </button>
                &nbsp;
                Pengeluaran ${adm_inptCount}
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
                        <input type="number" name="total[]" onkeypress="return isNumberKey(event)" class="form-control" aria-describedby="basic-addon1" required>
                    </div>
                </div>
            </div>
        `;
    }
</script>