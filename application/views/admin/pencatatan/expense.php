<div class="body form">
    <div class="row m-0 p-0 w-100">
        <div class="col-12 col-lg-6 ps-0">
            <label class="mb-3">Nomor STNK Kendaraan</label>
            <select name="provinsi" id="provinsi" class="login-input regular fs-16px input-expense-input">
                <option value="" disabled selected>Pilih STNK</option>
                <option value="">N 1670 AY</option>
                <option value="">AG 2201 B</option>
                <option value="">N 199 A</option>
            </select>
        </div>
        <div class="col-12 col-lg-6 pe-0">
            <label class="mb-3">Tanggal Service</label>
            <input type="date" class="login-input regular fs-16px input-expense-input">
        </div>
        <div class="ms-auto col-12 col-lg-6 mt-3 pe-0 input-expense">
            <button class="btn-table submit-modal" id="input-expense">
                Input Data
            </button>
        </div>
    </div>
</div>
<div class="head mid expense-extend">
    <p>CATATAN PENGELUARAN</p>
</div>
<div class="body form expense-extend">

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
            <label class="my-3">Total Biaya</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Rp.</span>
                <input type="number" class="form-control" aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="col-12 col-lg-6 pe-0">
            <label class="mb-3">Note</label>
            <textarea class="login-input regular h-auto fs-16px" rows="4"></textarea>
        </div>
    </div>
    <!-- END OF LOOP -->
    
    <button class="btn-table add-entry mt-3" data-bs-toggle="modal" data-bs-target="#success">
        Tambah Data
    </button>
</div>

<button class="btn-table submit-modal submit-expense absolute disabled" data-bs-toggle="modal" data-bs-target="#success" disabled>
    Submit Data
</button>