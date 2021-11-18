<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master Sparepart
            </p>
            <button type="button" class="btn-table" data-bs-toggle="modal" data-bs-target="#add_masterSparepart">Add</button>
        </div>
        <div class="card-section">
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Jenis Sparepart', 'Ideal Pemakaian', 'Action');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($Sparepart as $row) {
                                if ($row->sparepart_bulan > 0) {
                                    $this->table->add_row(
                                        $no++,
                                        $row->sparepart_nama,
                                        $row->sparepart_bulan . ' Bulan',
<<<<<<< Updated upstream
                                        '<button type="button" class="btn-table green" data-bs-toggle="modal" data-bs-target="#edit_masterSparepart">
=======
                                        '<button type="button" class="btn-table green edit_masterSparepart" data-bs-toggle="modal" data-bs-target="#edit_masterSparepart' . $row->sparepart_id . '">
>>>>>>> Stashed changes
                                            Edit
                                        </button>'
                                    );
                                } else {
                                    $this->table->add_row(
                                        $no++,
                                        $row->sparepart_nama,
                                        $row->sparepart_km . ' Km',
<<<<<<< Updated upstream
                                        '<button type="button" class="btn-table green" data-bs-toggle="modal" data-bs-target="#edit_masterSparepart">
=======
                                        '<button type="button" class="btn-table green edit_masterSparepart" data-bs-toggle="modal" data-bs-target="#edit_masterSparepart' . $row->sparepart_id . '">
>>>>>>> Stashed changes
                                            Edit
                                        </button>'
                                    );
                                }

                            ?>
                            <?php }
                            echo $this->table->generate(); ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal Edit Sparepart -->
        <?php
        foreach ($Sparepart as $row) :
            $sparepart_id = $row->sparepart_id;
            $sparepart_nama = $row->sparepart_nama;
            $sparepart_km = $row->sparepart_km;
            $sparepart_bulan = $row->sparepart_bulan;
        ?>
            <div class="modal fade" id="edit_masterSparepart<?= $sparepart_id ?>" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-2">
                        <div class="modal-header">
                            <p class="font-w-700 color-darker mb-0">Edit Sparepart</p>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body fs-14px pt-0 d-flex flex-column">
                            <?= form_open_multipart('admin/Sparepart/aksiEditPart'); ?>
                            <div class="pb-4">

                                <div class="d-flex flex-column my-2 w-100">
                                    <label class="font-w-400 my-2 color-secondary">Jenis Sparepart</label>
                                    <input type="text" class="login-input regular" name="jenis2" value="<?= $sparepart_nama ?>" required>
                                    <input type="hidden" id="sparepart_id" name="sparepart_id" value="<?= $sparepart_id ?>">
                                </div>
                                <div class="row m-0 p-0 w-full">
                                    <label class="font-w-400 my-2 color-secondary ps-0">Ideal Penggantian</label>
                                    <div class="col-6 ps-0 d-flex flex-row align-items-center">
                                        <div class="d-flex flex-row align-items-center radio-wrapper">
                                            <input type="radio" id="km2" value="km2" name="ideal2" class="pilih2" checked>
                                            <label for="km2" class="font-w-500 ms-2 me-3">Kilometer</label>
                                        </div>
                                        <input type="number" name="km-txt2" id="pilihkm" class="login-input regular" min="0" value="<?= $sparepart_km ?>" required>
                                    </div>
                                    <div class="col-6 pe-0 d-flex flex-row align-items-center">
                                        <div class="d-flex flex-row align-items-center radio-wrapper">
                                            <input type="radio" id="bulan2" value="bulan" name="ideal2" class="pilih2">
                                            <label for="bulan2" class="font-w-500 ms-2 me-3">Bulan</label>
                                        </div>
                                        <input type="number" name="bulan-txt2" id="pilihbln" class="login-input regular" min="0" max="12" value="<?= $sparepart_bulan ?>" disabled required>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row">
                                <button type="button" class="btn-table submit-modal outline me-1" data-bs-dismiss="modal">Hapus</button>
                                <button type="submit" class="btn-table submit-modal ms-1" data-bs-dismiss="modal">Simpan</button>
                            </div>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
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
        <div class="foot">
        </div>
    </div>
</div>
</div>