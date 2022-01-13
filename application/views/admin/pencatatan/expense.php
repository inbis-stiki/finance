<form action="<?= site_url('admin/jenis-biaya/store-expense')?>" method="post">
    <div class="body form">
        <div class="row m-0 p-0 w-100">
            <div class="col-12 col-lg-6 ps-0">
                <label class="mb-3">Nomor STNK Kendaraan</label>
                <select name="provinsi" id="exp_slct_kendaraan" class="login-input regular fs-16px input-expense-input">
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
                    <button type="button" data-slct="exp" class="btn-table infoKendaraan">
                        <span class="iconify-inline" data-icon="ps:car" data-width="15" data-height="15"></span>
                        <span>Info Kendaraan</span>
                    </button>
                </div>
                <div id="exp_alert" style="color: red;" hidden>Harap memilih kendaraan terlebih dahulu!</div>
            </div>
            <div class="col-12 col-lg-6 pe-0">
                <label class="mb-3">Tanggal Service</label>
                <input type="date" id="exp_inpt_tglService" max="<?= date('Y-m-d')?>" class="login-input regular fs-16px input-expense-input">
            </div>
            <div class="ms-auto col-12 col-lg-6 mt-3 pe-0 input-expense">
                <div class="alert alert-danger" id="exp_alert" role="alert" hidden>
                        Harap masukkan data dengan benar!
                </div>
                <button type="button" class="btn-table submit-modal" id="input-expense">
                    Masukkan Data
                </button>
            </div>
        </div>
    </div>
    <div class="head mid expense-extend">
        <p>CATATAN PENGELUARAN</p>
    </div>
    <div class="body form expense-extend">
        <div class="row m-0 p-0 w-100">
            <div class="col-12 col-lg-3 ps-0">
                <label class="mb-3">Jenis Pengeluaran</label>
                <select name="" id="exp_jenPeng" class="login-input regular fs-16px">
                    <option value="" disabled selected>Pilih Jenis Pengeluaran</option>
                    <?php
                        foreach ($pengExp as $item) {
                            echo '
                                <option value="'.$item->pengeluaran_id.'|'.$item->pengeluaran_jenis.'">'.$item->pengeluaran_jenis.'</option>
                            ';
                        }    
                    ?>
                </select>
                <div class="mt-3" id="boxInfoKendaraan">
                    <button id="exp_tambahInput" type="button" class="btn-table">
                        <span class="iconify-inline" data-icon="akar-icons:plus" data-width="15" data-height="15"></span>
                        <span>Tambah Data</span>
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <div id="exp_boxInput" class="mt-3">

        </div>
    </div>
    <input type="hidden" name="kendaraan" id="exp_inptKendaraan">
    <input type="hidden" name="tglService" id="exp_inptTglService">
    <button type="submit" class="btn-table submit-modal submit-expense absolute disabled" disabled>
        Simpan Data
    </button>
</form>
<script>
    let exp_inptCount = 0;
    $('#exp_tambahInput').click(function(){
        let jenisPengeluaran = $('#exp_jenPeng').val()
        if(jenisPengeluaran){
            jenisPengeluaran = jenisPengeluaran.split('|'); 
            switch (jenisPengeluaran[1]) {
                case "BBM":
                    $('#exp_boxInput').append(expRenderBBMHtml(jenisPengeluaran[0], jenisPengeluaran[1]));
                    $(".submit-expense").prop('disabled', false);
                    break;
                case "Driver":
                    $('#exp_boxInput').append(expRenderDriverHtml(jenisPengeluaran[0], jenisPengeluaran[1]));
                    $(".submit-expense").prop('disabled', false);
                    break;
                case "Lain - Lain":
                    $('#exp_boxInput').append(expRenderLainHtml(jenisPengeluaran[0], jenisPengeluaran[1]));
                    $(".submit-expense").prop('disabled', false);
                    break;
            
                default:
                    break;
            }
            generateNoExpense();
        }
    })
    const expRenderBBMHtml = (idPeng, namaPeng) => {
        exp_inptCount++;
        return `
            <div id="exp_boxInputItem_${exp_inptCount}">
                <p class="font-w-700 fs-16px my-2">
                    <button type="button" class="btn-table red" onclick="deleteItemExpense(${exp_inptCount})">
                        <span class="iconify-inline" data-icon="carbon:trash-can"data-width="15" data-height="15"></span>
                    </button>
                    &nbsp;
                    Pengeluaran <span class="exp_no" data-id="${exp_inptCount}" id="exp_no_${exp_inptCount}"></span>
                </p>
                <div class="row m-0 p-0 w-100">
                    <div class="col-12 col-lg-6 ps-0">
                        <label class="mb-3">Jenis Pengeluaran</label>
                            <input type="text" value="${namaPeng}" class="form-control" aria-describedby="basic-addon1" disabled>
                            <input type="hidden" name="bbm[jenPeng][]" value="${idPeng}" class="form-control" aria-describedby="basic-addon1">
                        <label class="my-3">Total Biaya</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="number" name="bbm[total][]" onkeypress="return isNumberKey(event)" class="form-control" aria-describedby="basic-addon1" required>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 pe-0">
                        <label class="mb-3">Note</label>
                        <textarea name="bbm[keterangan][]" class="login-input regular h-auto fs-16px" rows="4"></textarea>
                    </div>
                </div>
            </div>
        `;
    }
    const expRenderDriverHtml = (idPeng, namaPeng) => {
        exp_inptCount++;
        return `
            <div id="exp_boxInputItem_${exp_inptCount}">
                <p class="font-w-700 fs-16px my-2">
                    <button type="button" class="btn-table red" onclick="deleteItemExpense(${exp_inptCount})">
                        <span class="iconify-inline" data-icon="carbon:trash-can"data-width="15" data-height="15"></span>
                    </button>
                    &nbsp;
                    Pengeluaran <span class="exp_no" data-id="${exp_inptCount}" id="exp_no_${exp_inptCount}"></span>
                </p>
                <div class="row m-0 p-0 w-100">
                    <div class="col-12 col-lg-6 ps-0">
                        <label class="mb-3">Jenis Pengeluaran</label>
                            <input type="text" value="${namaPeng}" class="form-control" aria-describedby="basic-addon1" disabled>
                            <input type="hidden" name="driver[jenPeng][]" value="${idPeng}" class="form-control" aria-describedby="basic-addon1">
                        <label class="my-3">Fee per Hari</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input id="exp_inptHarga_${exp_inptCount}" type="number" name="" onkeypress="return isNumberKey(event)" onkeyup="calculateBiayaExpense(${exp_inptCount})" class="form-control" aria-describedby="basic-addon1" required>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 ps-0">
                        <label class="mb-3">Total Hari Masuk</label>
                            <input id="exp_inptKuan_${exp_inptCount}" type="number" name="driver[kuantitas][]" onkeypress="return isNumberKey(event)" onkeyup="calculateBiayaExpense(${exp_inptCount})" class="form-control" aria-describedby="basic-addon1" required>
                        <label class="my-3">Total Fee</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input id="exp_inptBiaya_${exp_inptCount}" type="number" onkeypress="return isNumberKey(event)" name="driver[total][]" class="form-control" aria-describedby="basic-addon1" readonly required>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
    const expRenderLainHtml = (idPeng, namaPeng) => {
        exp_inptCount++;
        return `
            <div id="exp_boxInputItem_${exp_inptCount}">
                <p class="font-w-700 fs-16px my-2">
                    <button type="button" class="btn-table red" onclick="deleteItemExpense(${exp_inptCount})">
                        <span class="iconify-inline" data-icon="carbon:trash-can"data-width="15" data-height="15"></span>
                    </button>
                    &nbsp;
                    Pengeluaran <span class="exp_no" data-id="${exp_inptCount}" id="exp_no_${exp_inptCount}"></span>
                </p>
                <div class="row m-0 p-0 w-100">
                    <div class="col-12 col-lg-6 ps-0">
                        <label class="mb-3">Jenis Pengeluaran</label>
                            <input type="text" value="${namaPeng}" class="form-control" aria-describedby="basic-addon1" disabled>
                            <input type="hidden" name="lain[jenPeng][]" value="${idPeng}" class="form-control" aria-describedby="basic-addon1">
                        <div class="row m-0 p-0 w-100">
                            <div class="col-6 ps-0">
                                <label class="my-3">Qty</label>
                                <div class="input-group mb-3">
                                    <input type="number" id="exp_inptKuan_${exp_inptCount}" name="lain[kuantitas][]" onkeypress="return isNumberKey(event)" onkeyup="calculateBiayaExpense(${exp_inptCount})" class="form-control" aria-describedby="basic-addon2" required>
                                    <span class="input-group-text" id="basic-addon2">pcs</span>
                                </div>
                            </div>
                            <div class="col-6 pe-0">
                                <label class="my-3">Harga</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                    <input type="number" id="exp_inptHarga_${exp_inptCount}" name="" onkeypress="return isNumberKey(event)" onkeyup="calculateBiayaExpense(${exp_inptCount})" class="form-control" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 ps-0">
                        <label class="mb-3">Keterangan</label>
                            <input type="text" name="lain[detail][]" class="form-control" aria-describedby="basic-addon1" required>
                        <label class="my-3">Total Harga</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input id="exp_inptBiaya_${exp_inptCount}" type="number" onkeypress="return isNumberKey(event)" name="lain[total][]" class="form-control" aria-describedby="basic-addon1" readonly required>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
    const calculateBiayaExpense = id => {
        const kuantitas = $('#exp_inptKuan_'+id).val()
        const harga = $('#exp_inptHarga_'+id).val()
        if(kuantitas && harga){
            $('#exp_inptBiaya_'+id).val(kuantitas*harga);
        }
        
    }
    const deleteItemExpense = id => {
        $('#exp_boxInputItem_'+id).remove();
        generateNoExpense();
    }
    const generateNoExpense = () => {
        let no = 1;
        if($('.exp_no').length){
            $('.exp_no').each(function(i, obj) {
                $(this).html(no)
                no++
            });
        }else{
            $(".expense-extend").removeClass('active');
            $(".submit-expense").prop('disabled', true);
            $(".input-expense").show();
            $(".input-expense-input").prop('disabled', false);  
        }
    }
</script>
