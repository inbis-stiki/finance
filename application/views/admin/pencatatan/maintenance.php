<div class="body form">
    <div class="row m-0 p-0 w-100">
        <div class="col-12 col-lg-6 ps-0">
            <label class="mb-3">Nomor STNK Kendaraan</label>
            <select name="provinsi" id="provinsi" class="login-input regular fs-16px input-maintenance-input">
                <option value="" disabled selected>Pilih STNK</option>
                <option value="">N 1670 AY</option>
                <option value="">AG 2201 B</option>
                <option value="">N 199 A</option>
            </select>
        </div>
        <div class="col-12 col-lg-6 pe-0">
            <label class="mb-3">Tanggal Service</label>
            <input type="date" class="login-input regular fs-16px input-maintenance-input">
        </div>
        <div class="col-12 col-lg-6 mt-3 ps-0">
            <div class="row m-0 p-0 w-100">
                <div class="col-6 ps-0">
                    <label class="mb-3">Nama Toko</label>
                    <input type="text" class="login-input regular fs-16px input-maintenance-input">
                </div>
                <div class="col-6">
                    <label class="mb-3">Jarak Tempuh</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control input-maintenance-input" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">km</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mt-auto mb-3 pe-0 input-maintenance">
            <button class="btn-table submit-modal" id="input-maintenance">
                Input Data
            </button>
        </div>
    </div>
</div>
<div class="head mid maintenance-extend">
    <p>CATATAN PENGELUARAN MAINTENANCE</p>
</div>
<div class="body form maintenance-extend">
    <!-- LOOP -->
    <p class="font-w-700 fs-16px my-2">Pengeluaran 1</p>
    <div class="row m-0 p-0 w-100">
        <div class="col-12 col-lg-6 ps-0">
            <label class="mb-3">Jenis Pengeluaran</label>
            <select name="provinsi" id="provinsi" class="login-input regular fs-16px">
                <option value="" disabled selected></option>
                <option value="">N 1670 AY</option>
                <option value="">AG 2201 B</option>
                <option value="">N 199 A</option>
            </select>
        </div>
        <div class="col-12 col-lg-6 pe-0">
            <div class="row m-0 p-0 w-100">
                <div class="col-6 ps-0">
                    <label class="mb-3">Jenis Sparepart</label>
                    <select name="provinsi" id="provinsi" class="login-input regular fs-16px">
                        <option value="" disabled selected></option>
                        <option value="">N 1670 AY</option>
                        <option value="">AG 2201 B</option>
                        <option value="">N 199 A</option>
                    </select>
                </div>
                <div class="col-6 pe-0">
                    <label class="mb-3">Nomor Seri</label>
                    <input type="text" class="login-input regular fs-16px">
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 ps-0">
            <div class="row m-0 p-0 w-100">
                <div class="col-6 ps-0">
                    <label class="my-3">Qty</label>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">km</span>
                    </div>
                </div>
                <div class="col-6 pe-0">
                    <label class="my-3">Harga</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Rp</span>
                        <input type="number" class="form-control" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-6 pe-0">
            <div class="row m-0 p-0 w-100">
                <div class="col-6 ps-0">
                    <label class="my-3">Harga</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Rp</span>
                        <input type="number" class="form-control" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF LOOP -->

    <button class="btn-table add-entry mt-3" data-bs-toggle="modal" data-bs-target="#success">
        Tambah Data
    </button>
</div>

<button class="btn-table submit-modal submit-maintenance absolute disabled" data-bs-toggle="modal" data-bs-target="#success" disabled>
    Submit Data
</button>