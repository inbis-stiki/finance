<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <?php echo validation_errors(); ?>
        <?= form_open_multipart('master/kendaraan/update'); ?>
        <p class="mb-3 fs-5 font-w-500 color-darker">
            Ubah Kendaraan
        </p>
        <div class="card-section">
            <div class="head">
                <p>Detail Kendaraan</p>
            </div>
            <div class="body form">
                <div class="row m-0 p-0 w-100">
                    <div class="col-12 col-lg-12 pe-0 d-flex flex-column justify-content-between">
                        <?php
                        if (!empty($this->session->flashdata('err_msg'))) {
                            echo '
                                    <div class="alert alert-danger" role="alert">
                                    ' . $this->session->flashdata('err_msg') . '
                                    </div>
                                ';
                        }
                        if (!empty($this->session->flashdata('succ_msg'))) {
                            echo '
                                    <div class="alert alert-success" role="alert">
                                        ' . $this->session->flashdata('succ_msg') . '
                                    </div>
                                ';
                        }
                        ?>
                        <label class="mb-3">Upload Foto Kendaraan</label>
                        <div>
                            <input type="file" name="foto[]" accept=".jpg,.png,.jpeg" multiple requried>
                        </div>
                        <div id="boxImg" class="text-center mb-3 p-3" style="border: 1px solid #ddd;border-radius: 10px;cursor: pointer;">
                            <?php
                            $kendaraan_foto = $kendaraan->kendaraan_foto;
                            $kendaraan_foto = json_decode($kendaraan_foto);
                            foreach ($kendaraan_foto as $key) :
                            ?>
                                <img style="max-width: 250px;" id="blah" class="" src="<?php echo ($key) ?>" />
                            <?php endforeach; ?>
                        </div>
                        <label class="mb-3">Upload Foto STNK</label>
                        <div>
                            <input type="file" name="stnk[]" accept=".jpg,.png,.jpeg" multiple requried>
                        </div>
                        <div id="boxImg" class="text-center mb-3 p-3" style="border: 1px solid #ddd;border-radius: 10px;cursor: pointer;">
                            <?php
                            $kendaraan_foto_stnk = $kendaraan->kendaraan_foto_stnk;
                            $kendaraan_foto_stnk = json_decode($kendaraan_foto_stnk);
                            foreach ($kendaraan_foto_stnk as $key) :
                            ?>
                                <img style="max-width: 250px;" id="blah" class="" src="<?php echo ($key)?>" />
                            <?php endforeach; ?>
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
                        <input type="text" class="login-input regular" placeholder="Nomor Rangka" value="<?= $kendaraan->kendaraan_no_rangka ?>" disabled>
                        <input type="hidden" name="rangka" value="<?= $kendaraan->kendaraan_no_rangka ?>">
                        <label class="my-3">Nomor STNK</label>
                        <input type="text" class="login-input regular" name="stnk" placeholder="Nomor STNK" value="<?= $kendaraan->kendaraan_stnk ?>" disabled>
                        <input type="hidden" class="login-input regular" value="<?= $kendaraan->kendaraan_stnk ?>">
                        <label class="my-3">Merk</label>
                        <input type="text" class="login-input regular" name="merk" placeholder="Merk" value="<?= $kendaraan->kendaraan_merk ?>" required>
                        <label class="my-3">Kapasitas Tangki</label>
                        <input type="number" class="login-input regular" onkeypress="return isNumberKey(event)" placeholder="Satuan Liter" name="tangki" value="<?= $kendaraan->kendaraan_kapasitas_tangki ?>" required>
                        <label class="my-3">Tanggal Beli</label>
                        <input type="date" class="login-input regular fs-16px" name="tanggal" id="datepicker" value="<?= $kendaraan->kendaraan_tanggal_beli ?>" required>
                        <label class="my-3">Tanggal Deadline Bayar Pajak</label>
                        <input type="date" class="login-input regular fs-16px" name="pajak" id="datepicker" value="<?= $kendaraan->kendaraan_deadlinestnk ?>" required>
                        <label class="my-3">Tanggal Deadline Bayar KIR</label>
                        <input type="date" class="login-input regular fs-16px" name="kir" id="datepicker" value="<?= $kendaraan->kendaraan_deadlinekir ?>" required>
                        <label class="my-3">Jenis Kendaraan</label>
                        <select name="jenis_kendaraan" id="jenis_kendaraan" class="login-input regular fs-16px" required>
                            <option value="" disabled>Pilih Jenis Kendaraan</option>
                            <?php
                                foreach ($datajenis as $item) {
                                    $status = '';
                                    if($kendaraan->kendaraan_jenis == $item->dropdown_list){
                                        $status = 'selected';
                                    }
                                    echo '
                                        <option value="'.$item->dropdown_list.'" '.$status.' >'.$item->dropdown_list.'</option>
                                    ';
                                }
                            ?>
                        </select>
                        <label class="my-3 groupPT" hidden="true">Nama Perusahaan</label>
                        <select name="pt" id="pt" class="login-input regular fs-16px groupPT" hidden="true">
                            <option value="" disabled selected>Pilih Perusahaan</option>
                            <?php
                                foreach ($datapt as $item) {
                                    echo '
                                        <option value="'.$item->dropdown_list.'">'.$item->dropdown_list.'</option>
                                    ';
                                }
                            ?>
                        </select>
                        <label class="my-3">Lokasi</label>
                        <select name="lokasi_ambil" id="lokasi_ambil" class="login-input regular fs-16px" required>
                            <option value="" disabled>Pilih Lokasi</option>
                            <?php
                                foreach ($datawilayah as $item) {
                                    $status = '';
                                    if($kendaraan->kendaraan_wilayah == $item->dropdown_list){
                                        $status = 'selected';
                                    }
                                    echo '
                                        <option value="'.$item->dropdown_list.'" '.$status.' >'.$item->dropdown_list.'</option>
                                    ';
                                }
                            ?>
                        </select>
                        <label class="my-3">Status</label>
                        <select class="login-input regular" name="status" id="" required>
                            <option value="">Pilih Status</option>
                            <option value="1" selected>Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
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

<?php if ((($this->session->flashdata('inserted'))) && $this->session->flashdata('inserted') != "") { ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#success').modal('show');
        });
    </script>

<?php } ?>
<script>
    $(document).ready(function(){
        const jenKend = "<?= $kendaraan->kendaraan_jenis ?>"
        if(jenKend == "Perusahaan"){
            $('.groupPT').attr('hidden', false)
            $('#pt').attr('disabled', false)
            $('#pt').val("<?= $kendaraan->kendaraan_pt?>").change()
        }
    })
    $('#jenis_kendaraan').change(function(){
        const val = $(this).val()
        if(val == 'Pribadi'){
            $('.groupPT').attr('hidden', true)
            $('#pt').attr('disabled', true)
        }else{
            $('.groupPT').attr('hidden', false)
            $('#pt').attr('disabled', false)
        }
    })
</script>