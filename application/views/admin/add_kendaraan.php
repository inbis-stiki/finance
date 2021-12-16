<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <?php echo validation_errors(); ?>
        <?= form_open_multipart('admin/aksiTambahKendaraan'); ?>
        <p class="mb-3 fs-5 font-w-500 color-darker">
            Master Tambah Kendaraan
        </p>
        <div class="card-section">
            <div class="head">
                <p>Detail Kendaraan</p>
            </div>
            <div class="body form">
                <div class="row m-0 p-0 w-100">
                    <div class="col-12 col-lg-12 pe-0 d-flex flex-column justify-content-between">
                      <?php
                            if(!empty($this->session->flashdata('err_msg'))){
                                echo '
                                    <div class="alert alert-danger" role="alert">
                                    '.$this->session->flashdata('err_msg').'
                                    </div>
                                ';        
                            }
                            if(!empty($this->session->flashdata('succ_msg'))){
                                echo '
                                    <div class="alert alert-success" role="alert">
                                        '.$this->session->flashdata('succ_msg').'
                                    </div>
                                ';        
                            }
                        ?>
                        <label class="mb-3">Upload Foto Kendaraan</label>
                        <div>
                            <input type="file" name="foto[]" accept=".jpg,.png,.jpeg" multiple requried>
                        </div>
                        <!-- <div class="upload-img color-dark">
                            <span class="iconify fs-80px mb-3 z-2" data-icon="ic:baseline-photo-camera"></span>
                            <p class="z-2">Klik disini untuk upload foto</p>

                            <input type="file" name="foto[]" accept="image/png, image/gif, image/jpeg" id="imageInput" class="z-2" required />
                            <div class="z-2"></div>

                            <img src="" class="image-preview">
                        </div> -->
                        <small><?php if (isset($error)) {
                                    echo $error;
                                } ?></small>
                        <label class="my-3">Nomor Rangka</label>
                        <input type="text" class="login-input regular" style="text-transform:uppercase" name="rangka" value="<?= !empty($temp['rangka']) ? $temp['rangka'] : "" ?>" required>
                        <label class="my-3">Nomor STNK</label>
                        <input type="text" class="login-input regular" style="text-transform:uppercase" name="stnk" value="<?= !empty($temp['stnk']) ? $temp['stnk'] : "" ?>" required>
                        <label class="my-3">Merk</label>
                        <input type="text" class="login-input regular" name="merk" value="<?= !empty($temp['merk']) ? $temp['merk'] : "" ?>" required>
                        <label class="my-3">Kapasitas Tangki</label>
                        <input type="number" class="login-input regular" name="tangki" value="<?= !empty($temp['tangki']) ? $temp['tangki'] : "" ?>" required>
                        <label class="my-3">Tanggal Beli</label>
                        <input type="date" class="login-input regular fs-16px" name="tanggal" id="datepicker" value="<?= !empty($temp['tanggal']) ? $temp['tanggal'] : "" ?>" required>
                        <label class="my-3">Tanggal Deadline Bayar Pajak</label>
                        <input type="date" class="login-input regular fs-16px" name="pajak" id="datepicker" value="<?= !empty($temp['pajak']) ? $temp['pajak'] : "" ?>" required>
                        <label class="my-3">Tanggal Deadline Bayar KIR</label>
                        <input type="date" class="login-input regular fs-16px" name="kir" id="datepicker" value="<?= !empty($temp['kir']) ? $temp['kir'] : "" ?>" required>
                    </div>
                </div>

            </div>
        </div>
        <button type="submit" class="btn-table submit-modal">
            SImpan Data
        </button>
        <?= form_close(); ?>
    </div>
</div>

<?php if ((($this->session->flashdata('sukses'))) && $this->session->flashdata('sukses') != "") { ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#success').modal('show');
        });
    </script>

<?php } ?>