<!-- Modal Tambah Sparepart -->
<div class="modal fade" id="add_masterSparepart" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-header">
                <p class="font-w-700 color-darker mb-0">Tambah Sparepart</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-14px pt-0 d-flex flex-column">
                <div class="pb-4">

                    <div class="d-flex flex-column my-2 w-100">
                        <label class="my-2 color-secondary">Jenis Sparepart</label>
                        <input type="text" class="login-input regular" placeholder="">
                    </div>
                    <div class="row m-0 p-0 w-full">
                        <label class="my-2 color-secondary ps-0">Ideal Penggantian</label>
                        <div class="col-6 ps-0 d-flex flex-row align-items-center">
                            <div class="d-flex flex-row align-items-center radio-wrapper">
                                <input type="radio" id="km" value="km" name="ideal" checked>
                                <label for="km" class="font-w-500 ms-2 me-3">Kilometer</label>
                            </div>
                            <input type="number" id="km-txt" class="login-input regular" min="0">
                        </div>
                        <div class="col-6 pe-0 d-flex flex-row align-items-center">
                            <div class="d-flex flex-row align-items-center radio-wrapper">
                                <input type="radio" id="bulan" value="bulan" name="ideal">
                                <label for="bulan" class="font-w-500 ms-2 me-3">Bulan</label>
                            </div>
                            <input type="number" id="bulan-txt" class="login-input regular" min="0" max="12" disabled>
                        </div>   
                    </div>
                </div>
                <button type="button" class="btn-table submit-modal" data-bs-dismiss="modal">Tambah data</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Sparepart -->
<div class="modal fade" id="edit_masterSparepart" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-header">
                <p class="font-w-700 color-darker mb-0">Edit Sparepart</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-14px pt-0 d-flex flex-column">
                <div class="pb-4">

                    <div class="d-flex flex-column my-2 w-100">
                        <label class="font-w-400 my-2 color-secondary">Jenis Sparepart</label>
                        <input type="text" class="login-input regular" value="Radiator">
                    </div>
                    <div class="row m-0 p-0 w-full">
                        <label class="font-w-400 my-2 color-secondary ps-0">Ideal Penggantian</label>
                        <div class="col-6 ps-0 d-flex flex-row align-items-center">
                            <div class="d-flex flex-row align-items-center radio-wrapper">
                                <input type="radio" id="km2" value="km" name="ideal2" checked>
                                <label for="km2" class="font-w-500 ms-2 me-3">Kilometer</label>
                            </div>
                            <input type="number" id="km-txt2" class="login-input regular" min="0" value="100">
                        </div>
                        <div class="col-6 pe-0 d-flex flex-row align-items-center">
                            <div class="d-flex flex-row align-items-center radio-wrapper">
                                <input type="radio" id="bulan2" value="bulan" name="ideal2">
                                <label for="bulan2" class="font-w-500 ms-2 me-3">Bulan</label>
                            </div>
                            <input type="number" id="bulan-txt2" class="login-input regular" min="0" max="12" disabled>
                        </div>   
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <button type="button" class="btn-table submit-modal outline me-1" data-bs-dismiss="modal">Hapus</button>
                    <button type="button" class="btn-table submit-modal ms-1" data-bs-dismiss="modal">Simpan</button>
                </div>
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
            <form class="form-horizontal" action="" id="formRegion">
            <!-- <div class="form-horizontal" id="formRegion"> -->
                <div class="modal-body fs-14px pt-0 d-flex flex-column">
                    <div class="pb-4">

                        <div class="d-flex flex-column my-2 w-100">
                            <label class="my-2 color-secondary">Nama Kota</label>
                            <input name="nama_kota" type="text" class="login-input regular nama_kota" placeholder="">
                        </div>
                    </div>
                    
                    <!-- <button type="button" class="btn-table submit-modal" data-bs-dismiss="modal">Tambah data</button> -->
                </div>
            <!-- </div> -->
                
            </form>
            <div class="modal-footer">
                        <button type="submit" class="btn-table submit-modal" onclick="saveRegion()">Tambah data</button>
            </div>
            <!-- <div class="modal-body fs-14px pt-0 d-flex flex-column">
                <div class="pb-4">

                    <div class="d-flex flex-column my-2 w-100">
                        <label class="my-2 color-secondary">Nama Kota</label>
                        <input name="nama_kota" type="text" class="login-input regular" placeholder="">
                    </div>
                </div>
                <button type="button" class="btn-table submit-modal" data-bs-dismiss="modal">Tambah data</button>
            </div> -->
        </div>
    </div>
</div>


<!-- Modal Edit Region -->
<div class="modal fade" id="edit_masterRegion" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-header">
                <p class="font-w-700 color-darker mb-0">Edit Region</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-14px pt-0 d-flex flex-column">
                <div class="pb-4">

                    <div class="d-flex flex-column my-2 w-100">
                        <label class="font-w-400 my-2 color-secondary">Nama Kota</label>
                        <input type="text" class="login-input regular" value="Malang">
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <button type="button" class="btn-table submit-modal outline me-1" data-bs-dismiss="modal">Hapus</button>
                    <button type="button" class="btn-table submit-modal ms-1" data-bs-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

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