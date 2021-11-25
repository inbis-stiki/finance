<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master Kendaraan
            </p>
            <button type="button" class="btn-table" data-bs-toggle="modal" data-bs-target="#add_masterKendaraan">Add</button>
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
        <div class="modal fade" id="edit_masterKendaraan<?php echo $kendaraan_no_rangka?>" nama="edit_masterKendaraan" method="POST" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Edit Kendaraan</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <?= form_open_multipart('admin/Master_region/editRegion'); ?>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <div class="pb-4">

                            <div class="d-flex flex-column my-2 w-100">
                                <label class="font-w-400 my-2 color-secondary">Nama Kota</label>
                                <input type="text" class="form-control" id="region_kota" name="region_kota" value="<?php echo $region_kota?>">
                                <input type="hidden" id="region_id" name="region_id" value="<?php echo $region_id?>">
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <button type="button" class="btn-table submit-modal outline me-1" data-bs-dismiss="modal">Hapus</button>
                            <button type="submit" class="btn-table submit-modal ms-1" data-bs-dismiss="modal">Simpan</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
        <?php endforeach;?>
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