<div class="body form">
    <div class="row m-0 p-0 w-100">
        <div class="col-12 col-lg-6 ps-0">
            <label class="mb-3">Nomor STNK Kendaraan</label>
            <select name="provinsi" id="provinsi" class="login-input regular fs-16px input-administrasi-input">
                <option value="" disabled selected>Pilih STNK</option>
                <option value="">N 1670 AY</option>
                <option value="">AG 2201 B</option>
                <option value="">N 199 A</option>
            </select>
        </div>
        <div class="col-12 col-lg-6 pe-0">
            <label class="mb-3">Tanggal Beli Kendaraan</label>
            <input type="date" class="login-input regular fs-16px input-administrasi-input">
        </div>
        <div class="ms-auto col-12 col-lg-6 mt-3 pe-0 input-administrasi">
            <button class="btn-table submit-modal" id="input-administrasi">
                Masukkan Data
            </button>
        </div>
    </div>
</div>
<div class="head mid administrasi-extend">
    <p>CATATAN PENGELUARAN ADMINISTRASI</p>
</div>
<div class="body form administrasi-extend">

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
            <label class="mb-3">Total Biaya</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Rp.</span>
                <input type="number" class="form-control" aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <!-- END OF LOOP -->

    <!-- LOOP -->
    <p class="font-w-700 fs-16px my-2">Pengeluaran 2</p>
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
            <label class="mb-3">Total Biaya</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Rp.</span>
                <input type="number" class="form-control" aria-describedby="basic-addon1">
            </div>
        </div>
    </div>
    <!-- END OF LOOP -->

    <button class="btn-table add-entry mt-3" data-bs-toggle="modal" data-bs-target="#success">
        Tambah Data
    </button>
</div>

<button class="btn-table submit-modal submit-administrasi absolute disabled" data-bs-toggle="modal" data-bs-target="#success" disabled>
    Simpan Data
</button>