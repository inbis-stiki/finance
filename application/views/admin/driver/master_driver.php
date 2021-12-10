<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master Driver
            </p>
            <a href="<?= base_url('admin/tambah_driver'); ?>" class="btn-table green" type="button">Tambah</a>
            <!-- <button type="button" class="btn-table" data-bs-toggle="modal">Add</button> -->
        </div>
        <div class="card-section">
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table id="tableDriver" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Nama Driver', 'Foto Driver', 'KTP Driver', 'Alamat Driver', 'Nomor Telepon Driver', 'Aksi');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($Driver as $row) {
                                $this->table->add_row(
                                    $no++,
                                    $row->driver_nama,
                                    '<img src="' . $row->driver_foto . '" style="width:100px">',
                                    '<img src="' . $row->driver_foto_ktp . '" style="width:100px">',
                                    $row->driver_alamat,
                                    $row->driver_telepon,

                                    '
                                    <a href="' .  base_url("admin/ubah_driver/" . $row->driver_nik) . '" >
                                        <button type="button" class="btn-table edit_masterDriver btnEdit">
                                            <span class="iconify-inline" data-icon="bx:bx-edit" data-width="20" data-height="20"></span>
                                        </button>
                                    </a>
                                    <button type="button" data-id="' . $row->driver_nik . '" class="btn-table red hapus_masterDriver btnHapus" data-bs-toggle="modal" data-bs-target="#hapus_masterDriver">
                                        <span class="iconify-inline" data-icon="carbon:trash-can"data-width="20" data-height="20"></span>
                                    </button>'
                                );
                            ?>
                            <?php }
                            echo $this->table->generate(); ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Hapus Driver -->
        <div class="modal fade" id="hapus_masterDriver" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Hapus Driver</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('admin/Driver/aksiHapus'); ?>
                        <div class="pb-4">
                            <div class="d-flex flex-column my-2 w-100">
                                <p class="font-w-700 color-darker mb-0">Apakah anda yakin menghapus data ini ?</p>
                                <input type="hidden" id="driver_nik" name="driver_nik" value="">
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <button type="submit" class="btn-table submit-modal ms-1">Hapus</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#tableDriver tbody').on('click', '.btnHapus', function() {
                const id = $(this).data('id')

                $('input[name=driver_nik]').val(id);
            })
        </script>
        <div class="foot">
        </div>
    </div>
</div>
</div>