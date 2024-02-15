<form action="<?= site_url('admin/transaksi/store-maintenance') ?>" method="post">
    <div class="body form">
        <div class="row m-0 p-0 w-100">
            <div class="col-12 col-lg-6 ps-0">
                <div class="form-group"></div>
                <label class="mb-3">Nomor STNK Kendaraan</label>
                <br>
                <select id="main_slct_kendaraan" class="select2 input-maintenance-input" style="width: 100%;">
                    <option value="" disabled selected>Pilih STNK</option>
                    <?php
                    foreach ($kendaraans as $item) {
                        echo '
                                <option value="' . $item->kendaraan_no_rangka . '|' . $item->kendaraan_stnk . '">' . $item->kendaraan_stnk . '</option>
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
                <div class="row w-100">
                    <div class="col-6 col-lg-6 ps-0">
                        <label class="mb-3">Tanggal Service</label>
                        <input type="date" id="main_inpt_tglService" max="<?= date('Y-m-d') ?>" class="login-input regular fs-16px input-maintenance-input">
                    </div>
                    <div class="col-6 col-lg-6 pe-0">
                        <label class="mb-3">Nama Toko</label>
                        <input type="text" id="main_inpt_toko" class="login-input regular fs-16px input-maintenance-input">
                    </div>
                </div>
                <div class="row w-100">
                    <div class="alert alert-danger mt-3" style="margin-bottom: -0.5rem;" id="main_alert2" role="alert" hidden>
                        Harap masukkan data dengan benar!
                    </div>
                    <button type="button" class="btn-table submit-modal mt-3" id="input-maintenance">
                        Masukkan Data
                    </button>
                </div>
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
    <!-- <input type="hidden" name="jarak" id="main_inptJarak"> -->
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
                jenPengMain += \'<option value="' . $item->pengeluaran_id . '">' . $item->pengeluaran_jenis . '</option>\'
            ';
    }
    ?>

    let jenSparepart = "";
    <?php
    foreach ($jenSparepart as $item) {
        echo '
            jenSparepart += \'<option value="' . $item->dropdown_list . '">' . $item->dropdown_list . '</option>\'
        ';
    }
    ?>


    $('#main_tambahInput').click(function() {
        if(document.getElementById('main_inptSeri_'+main_inptCount).value==null||document.getElementById('main_inptSeri_'+main_inptCount).value==""){
            alert('Isi Kode Barang terlebih dahulu');
        }else{
            $('#main_boxInput').append(mainRenderHtml())
            generateNoMaintenance();
        }
    })
    const mainRenderHtml = () => {
        main_inptCount++;
        $(document).ready(function() {
            $('.select2').select2();
        });

        $(document).ready(function() {
            $('#main_inptSeri_'+main_inptCount).on('change', function() {
            var selectedValue = $(this).val();
            checkKode(main_inptCount);
        });
        });
        
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
                    <div class="col-6 col-lg-6 ps-0 pe-2">
                        <div class="row m-0 p-0 w-100">
                            <div class="col-6 col-lg-6 pe-2 ps-0">
                                <label class="mb-3">Jenis Pengeluaran</label>
                                <div class="input-group mb-3">
                                    <select name="jenPeng[]" id="" class="select2 login-input regular fs-16px" required>
                                        <option value="" disabled selected>Pilih Jenis Pengeluaran</option>
                                        ${jenPengMain}
                                    </select>
                                </div>
                            </div>
                            <div class="col-6 ps-0 pe-0">
                            <label class="mb-3">Kode Barang</label>
                                <div class="input-group">
                                    <select id="main_inptSeri_${main_inptCount}" name="kdBarang[]" class="login-input regular fs-16px select2" required>    
                                    <option value="" selected disabled>Pilih...</option>
                                    <?php foreach ($sparepartData as $item): ?>
                                        <option value="<?php echo $item->sparepart_kode; ?>"><?php echo $item->sparepart_nama.'-' . $item->sparepart_kode; ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 ps-0">
                        <div class="row m-0 p-0 w-100">
                            <div class="col-6 col-lg-6 pe-2 ps-0">
                                <label class="mb-3">Jenis Sparepart</label>
                                <select id="main_slctJenSparepart_${main_inptCount}" onchange="onChangeJenSparepart(${main_inptCount})" class="select2 login-input regular fs-16px" disabled required>
                                    <option value="" disabled selected>Pilih Jenis Sparepart</option>
                                    ${jenSparepart}
                                </select>
                                <input type="hidden" id="main_slctInptJenSparepart_${main_inptCount}" name="jenSparepart[]" />
                            </div>
                            <div class="col-6 col-lg-6 ps-0 pe-0">
                                <label class="mb-3">Nama Barang</label>
                                <div class="input-group mb-3">
                                    <input type="text" onkeyup="onKeyUpBarang(${main_inptCount})" id="main_inptBarang_${main_inptCount}" class="form-control main_inptBarang_${main_inptCount}" aria-describedby="basic-addon1 " disabled required>
                                    <input type="hidden" class="main_inptBarang_${main_inptCount}" name="barang[]" />
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-4 ps-0">
                        <div class="row m-0 p-0 w-100">
                            <div class="col-6 pe-2 ps-0">
                                <label class="my-3">Qty</label>
                                <div class="input-group mb-3">
                                    <input id="main_inptKuan_${main_inptCount}" name="kuantitas[]" onkeypress="return isNumberKey(event)" onkeyup="calculateBiayaMaintenance(${main_inptCount}, 'main_inptKuan_')" class="form-control" aria-describedby="basic-addon2" required>
                                    <span class="input-group-text" id="basic-addon2">pcs</span>
                                </div>
                            </div>
                            <div class="col-6 ps-0 pe-0">
                                <label class="my-3">Harga</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                    <input id="main_inptHarga_${main_inptCount}" name="" onkeypress="return isNumberKey(event)" onkeyup="calculateBiayaMaintenance(${main_inptCount}, 'main_inptHarga_')" class="form-control" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-8 ps-0 pe-2">
                        <div class="row m-0 p-0 w-100">
                            <div class="col-6 ps-0">
                                <label class="my-3">Total Biaya</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                    <input type="text" name="total[]" id="main_inptBiaya_${main_inptCount}" class="form-control" aria-describedby="basic-addon1" readonly required>
                                </div>
                            </div>
                            <div class="col-6 col-lg-6 pe-0 ps-0">
                            <label class="my-3">Keterangan</label>
                                <div class="input-group mb-3">
                                    <textarea id="" name="keterangan[]" class="form-control" aria-describedby="basic-addon1"></textarea>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }
    const calculateBiayaMaintenance = (id, inpt) => {
        $(`#${inpt}${id}`).val(function(index, value) {
            return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
        let kuantitas = $('#main_inptKuan_' + id).val()
        let harga = $('#main_inptHarga_' + id).val()

        kuantitas = kuantitas.replace(/,/g, '');
        harga = harga.replace(/,/g, '');

        if (kuantitas && harga) {
            $('#main_inptBiaya_' + id).val(numberWithCommas(kuantitas * harga));
        }
    }
    const deleteItemMaintenance = id => {
        $('#main_boxInputItem_' + id).remove();
        generateNoMaintenance();
    }
    const generateNoMaintenance = () => {
        let no = 1;
        if ($('.main_no').length) {
            $('.main_no').each(function(i, obj) {
                $(this).html(no)
                no++
            });
        } else {
            $(".maintenance-extend").removeClass('active');
            $(".submit-maintenance").prop('disabled', true);
            $(".input-maintenance").show();
            $(".input-maintenance-input").prop('disabled', false);
        }
    }
    const showLoadSparepart = id => {
        const value = $('#main_slctSparepart_' + id).val()
        const itemSparepart = value.split('|');
        if (itemSparepart[1]) {
            $('#main_boxLoadName_' + id).html('Pemakaian (Jarak)');
            $('#main_boxLoadUnit_' + id).html('Km');
            $('#main_boxLoadIdeal_' + id).html(`Ideal: ${itemSparepart[1]} Km`);
        } else {
            $('#main_boxLoadName_' + id).html('Pemakaian (Durasi)');
            $('#main_boxLoadUnit_' + id).html('Bulan');
            $('#main_boxLoadIdeal_' + id).html(`Ideal: ${itemSparepart[2]} bulan`);
        }
        $('#main_boxLoadIdeal_' + id).attr('hidden', false);
        $('#main_inptLoad_' + id).attr('disabled', false);
    }
    const checkKode = idElmKdBarang => {
        kdBarang = $('#main_inptSeri_' + idElmKdBarang).val()
        // alert(kdBarang)
        $.ajax({
            url: '<?= site_url('admin/transaksi/ajxKdBarang') ?>',
            method: 'post',
            data: {
                kdBarang
            },
            success: function(res) {
                res = JSON.parse(res)
                if (res['status'] == true){
                    $('#main_slctJenSparepart_'+idElmKdBarang).attr('disabled', true);
                    $('#main_inptBarang_'+idElmKdBarang).attr('disabled', true);
                    
                    $('#main_slctJenSparepart_'+idElmKdBarang).val(res['data'][0]['sparepart_jenis']).change();
                    $('#main_slctInptJenSparepart_'+idElmKdBarang).val(res['data'][0]['sparepart_jenis']);
                    $('.main_inptBarang_'+idElmKdBarang).val(res['data'][0]['sparepart_nama']);

                    $('#main_inptSeriAlert_' + idElmKdBarang).html('<span style="color: green;">Kode barang telah terdaftar</span>');
                }else{
                    $('#main_slctJenSparepart_'+idElmKdBarang).attr('disabled', false);
                    $('#main_inptBarang_'+idElmKdBarang).attr('disabled', false);

                    $('#main_slctJenSparepart_'+idElmKdBarang).val('').change();
                    $('#main_slctInptJenSparepart_'+idElmKdBarang).val('');
                    $('.main_inptBarang_'+idElmKdBarang).val('');

                    $('#main_inptSeriAlert_' + idElmKdBarang).html('<span style="color: orange;">Kode barang belum terdaftar</span>');
                }

            }
        })
    }
    const onChangeJenSparepart = elm => {
        const val = $('#main_slctJenSparepart_'+elm).val()
        $('#main_slctInptJenSparepart_'+elm).val(val);
    }
    const onKeyUpBarang = elm => {
        const val = $('#main_inptBarang_'+elm).val();
        $('.main_inptBarang_'+elm).val(val);
    }
</script>