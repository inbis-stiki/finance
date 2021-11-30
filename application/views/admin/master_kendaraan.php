<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master Kendaraan
            </p>
            <a href="<?php echo site_url(); ?>admin/Admin/tambah_kendaraan">
                <button type="button" class="btn-table">Add</button>
            </a>

        </div>
        <div class="card-section">
            <div class="body">
                <table class="table-custom" id="tblKendaraan">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'No. Rangka', 'No. STNK', 'Merk', 'Tanggal Beli', 'Action');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($Kendaraan as $row) {
                                $this->table->add_row(
                                    $no++,
                                    $row->kendaraan_no_rangka,
                                    $row->kendaraan_stnk,
                                    $row->kendaraan_merk,
                                    $row->kendaraan_tanggal_beli,
                                    '<a class="btn-table green edit_masterKendaraan" data-bs-toggle="modal" data-bs-target="#edit_masterKendaraan' . $row->kendaraan_no_rangka . '" title="Edit"
                                    <button type="button" class="btn-table green edit_masterKendaraan">
                                            Edit
                                        </button>
                                    </a>'

                                );

                            ?>
                            <?php }
                            echo $this->table->generate(); ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        foreach ($Kendaraan as $i) :
            $kendaraan_no_rangka = $i->kendaraan_no_rangka;
            $kendaraan_stnk = $i->kendaraan_stnk;
            $kendaraan_merk = $i->kendaraan_merk;
            $kendaraan_tanggal_beli = $i->kendaraan_tanggal_beli;
            $kendaraan_foto = $i->kendaraan_foto;

        ?>
            <div class="modal fade" id="edit_masterKendaraan<?php echo $kendaraan_no_rangka ?>" nama="edit_masterKendaraan" method="POST" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content p-2">
                        <div class="modal-header">
                            <p class="font-w-700 color-darker mb-0">Edit Kendaraan</p>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <?= form_open_multipart('admin/Master_kendaraan/updateKendaraan'); ?>
                        <div class="modal-body row m-0 p-0 w-100">

                            <div class="col-12 col-lg-6 ps-0 d-flex flex-column">
                                <label class="mb-3">Upload Foto Kendaraan</label>
                                <div class="upload-img color-dark">
                                    <span class="iconify fs-80px mb-3 z-2" data-icon="ic:baseline-photo-camera"></span>
                                    <p class="z-2">Klik disini untuk upload foto</p>

                                    <input type="file" name="kendaraan_foto" accept="image/png, image/gif, image/jpeg" id="imageInput" class="z-2" />
                                    <div class="z-2"></div>

                                    <img src="<?php echo base_url() . '/assets/images/fotokendaraan/' . $kendaraan_foto ?>" class="image-preview">
                                </div>
                                <small><?php if (isset($error)) {
                                            echo $error;
                                        } ?></small>
                            </div>
                            <div class="col-12 col-lg-6 pe-0 d-flex flex-column justify-content-between">
                                <label class="my-3">Nomor Rangka Kendaraan</label>
                                <input type="text" class="login-input regular" id="kendaraan_no_rangka" name="kendaraan_no_rangka" value="<?= $kendaraan_no_rangka ?>" disabled>
                                <label class="mb-3">Nomor STNK Kendaraan</label>
                                <input type="text" class="login-input regular" id="kendaraan_stnk" name="kendaraan_stnk" value="<?= $kendaraan_stnk ?>" required>
                                <label class="my-3">Merk Kendaraan</label>
                                <input type="text" class="login-input regular" id="kendaraan_merk" name="kendaraan_merk" value="<?= $kendaraan_merk ?>" required>
                                <label class="my-3">Tanggal Beli Kendaraan</label>
                                <input type="date" class="login-input regular fs-16px" id="kendaraan_tanggal_beli" name="kendaraan_tanggal_beli" value="<?= $kendaraan_tanggal_beli ?>" required>
                            </div>
                            <button type="submit" class="btn-table submit-modal">Edit data</button>

                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <script type="text/javascript">
            // $('#tblRegion tbody').on('click', '.edit_masterRegion', function() {
            //     alert('oke');
            //     const region_id = $(this).data('region_id');
            //     $('#region_id').val(region_id);
            //     const region_kota = $(this).data('region_kota');
            //     $('#region_kota').val(region_id);
            // })
        </script>

        <div class="foot">
        </div>
    </div>
</div>
</div>