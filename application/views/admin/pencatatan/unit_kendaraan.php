<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
    <?php echo validation_errors(); ?>
    <?= form_open_multipart('admin/Unit_kendaraan/add_kendaraan');?>    
        <p class="mb-3 fs-5 font-w-500 color-darker">
            Pencatatan Unit Kendaraan
        </p>
        <div class="card-section color-light-dark">
            <div class="head">
                <p>Detail Kendaraan</p>
            </div>
            <div class="body form">
            
                <div class="row m-0 p-0 w-100">
                    <div class="col-12 col-lg-6 ps-0 d-flex flex-column">
                        <label class="mb-3">Upload Foto Kendaraan</label>
                        <div class="upload-img color-dark">
                            <span class="iconify fs-80px mb-3 z-2" data-icon="ic:baseline-photo-camera"></span>
                            <p class="z-2">Klik disini untuk upload foto</p>

                            <input type="file" name="foto" accept="image/png, image/gif, image/jpeg" id="imageInput" class="z-2" required/>
                            <div class="z-2"></div>
                            
                            <img src="" class="image-preview">
                        </div>
                        <small><?php if(isset($error)) { echo $error; }?></small>
                    </div>
                    <div class="col-12 col-lg-6 pe-0 d-flex flex-column justify-content-between">
                        <label class="mb-3">Nomor STNK Kendaraan</label>
                        <input type="text" class="login-input regular" name="stnk" placeholder="Masukkan nomor STNK kendaraan" required>
                        <label class="my-3">Nomor Rangka Kendaraan</label>
                        <input type="text" class="login-input regular" name="rangka" placeholder="Masukkan nomor STNK kendaraan" required>
                        <label class="my-3">Merk Kendaraan</label>
                        <input type="text" class="login-input regular" name="merk" placeholder="Masukkan Merk Kendaraan" required>
                        <label class="my-3">Tanggal Beli Kendaraan</label>
                        <input type="date" class="login-input regular fs-16px" name="tanggal" id="datepicker" required>
                    </div>
                </div>
            
            </div>
        </div>

        <div class="card-section">
            <div class="head">
                <p>Area Operasional</p>
            </div>
            <div class="body form">
                <div class="row m-0 p-0 w-100">
                    <div class="col-12 col-lg-12 pe-0">
                        <label class="mb-3">Kota</label>
                        <select name="kota" class="form-control" required>
                        
                            <option value="" disabled selected>Pilih Kota</option>
                            <?php foreach ($datakota as $key): ?>
                            <option value="<?php echo $key->region_id ?>"><?php echo $key->region_kota ?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-section">
            <div class="head">
                <p>Instansi Penyewa</p>
            </div>
            <div class="body form">
                <div class="row m-0 p-0 w-100">
                    <div class="col-12 col-lg-6 ps-0">
                        <label class="mb-3">Nama Instansi</label>
                        <input type="text" class="login-input regular" name="instansi" placeholder="Masukkan Nama Instansi" required>
                    </div>
                    <div class="col-12 col-lg-6 pe-0">
                        <label class="mb-3">Jenis Instansi</label>
                        <select name="jenis_instansi" id="jenis_instansi" class="login-input regular fs-16px" required>
                            <option value="" disabled selected>Pilih Jenis Instansi</option>
                            <option value="BUMN">BUMN</option>
                            <option value="Non BUMN">Non BUMN</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn-table submit-modal">
            Submit Data
        </button>
    <?= form_close();?>
    </div>
</div>