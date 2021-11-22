<!-- Modal Tambah Sparepart -->
<div class="modal fade" id="add_masterSparepart" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-header">
                <p class="font-w-700 color-darker mb-0">Tambah Sparepart</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-14px pt-0 d-flex flex-column">
                <?= form_open_multipart('admin/Sparepart/aksiTambahPart'); ?>
                <div class="pb-4">

                    <div class="d-flex flex-column my-2 w-100">
                        <label class="my-2 color-secondary">Jenis Sparepart</label>
                        <input type="text" class="login-input regular" name="jenis" placeholder="" required>
                    </div>
                    <div class="row m-0 p-0 w-full">
                        <label class="my-2 color-secondary ps-0">Ideal Penggantian</label>
                        <div class="col-6 ps-0 d-flex flex-row align-items-center">
                            <div class="d-flex flex-row align-items-center radio-wrapper">
                                <input type="radio" id="km" value="km" name="ideal" class="pilih" checked>
                                <label for="km" class="font-w-500 ms-2 me-3">Kilometer</label>
                            </div>
                            <input type="number" name="km-txt" id="input-km" onkeypress="return isNumberKey(event)" class="login-input regular" min="0" required>
                        </div>
                        <div class="col-6 pe-0 d-flex flex-row align-items-center">
                            <div class="d-flex flex-row align-items-center radio-wrapper">
                                <input type="radio" id="bulan" value="bulan" name="ideal" class="pilih">
                                <label for="bulan" class="font-w-500 ms-2 me-3">Bulan</label>
                            </div>

                            <input type="number" name="bulan-txt" id="input-bulan" onkeypress="return isNumberKey(event)" class="login-input regular" min="0" disabled required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-table submit-modal">Tambah data</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Region -->
<div class="modal fade" id="add_masterRegion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-header">
                <p class="font-w-700 color-darker mb-0">Tambah Region</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-14px pt-0 d-flex flex-column">
                <?= form_open_multipart('admin/Master_region/aksiTambahRegion'); ?>
                <div class="pb-4">

                    <div class="d-flex flex-column my-2 w-100">
                        <label class="my-2 color-secondary">Nama Kota</label>
                        <input type="text" class="login-input regular" name="kota" placeholder="" required>
                    </div>
                    
                </div>
                <button type="submit" class="btn-table submit-modal">Tambah data</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Region -->


<!-- Modal Sukses -->
<div class="modal fade" id="success" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">

            <div class="modal-body fs-14px pt-0 d-flex flex-column align-items-center justify-content-center">

                <span class="iconify fs-100px color-primary my-4" data-icon="fluent:checkmark-starburst-16-filled"></span>
                <p class="h3 text-center mb-4">Data telah berhasil <br>di Submit</p>
                <button type="button" class="btn-table submit-modal" data-bs-dismiss="modal">OK</button>

            </div>
        </div>
    </div>
</div>

<script>
    $('.pilih').click(function() {
        const inputan = $(this).val()
        if (inputan == "km") {
            $('#input-km').attr('disabled', false)
            $('#input-bulan').attr('disabled', true)
        } else {
            $('#input-km').attr('disabled', true)
            $('#input-bulan').attr('disabled', false)
        }
    })
</script>

<script>
    $('.pilih2').click(function() {
        const inputann = $(this).val()
        if (inputann == "km2") {
            $('#pilihkm').attr('disabled', false)
            $('#pilihbln').attr('disabled', true)
        } else {
            $('#pilihkm').attr('disabled', true)
            $('#pilihbln').attr('disabled', false)
        }
    })
</script>
