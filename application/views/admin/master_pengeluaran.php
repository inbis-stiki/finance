<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master Jenis Pengeluaran
            </p>
<<<<<<< Updated upstream
            <button type="button" class="btn-table" data-bs-toggle="modal" data-bs-target="#add_masterPengeluaran">Add</button>
=======
            <button type="button" class="btn-table green" data-bs-toggle="modal" data-bs-target="#add_masterPengeluaran">Tambah</button>
>>>>>>> Stashed changes
        </div>
        <div class="card-section">
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table id="tablePengeluaran" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Jenis Pengeluaran', 'Grup Pengeluaran', 'Aksi');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($Pengeluaran as $row) {
                                $this->table->add_row(
                                    $no++,
                                    $row->pengeluaran_jenis,
                                    $row->pengeluaran_group,

<<<<<<< Updated upstream
                                    '<button type="button" data-id="' . $row->pengeluaran_id . '" data-jenis="' . $row->pengeluaran_jenis . '" data-group="' . $row->pengeluaran_group . '" class="btn-table green edit_masterPengeluaran btnEdit" data-bs-toggle="modal" data-bs-target="#edit_masterPengeluaran">
                                            Edit
                                        </button>
                                    <button type="button" data-id="' . $row->pengeluaran_id . '" class="btn-table orange hapus_masterPengeluaran btnEdit" data-bs-toggle="modal" data-bs-target="#hapus_masterPengeluaran">
                                            Hapus
=======
                                    '<button type="button" data-id="' . $row->pengeluaran_id . '" data-jenis="' . $row->pengeluaran_jenis . '" data-group="' . $row->pengeluaran_group . '" class="btn-table edit_masterPengeluaran btnEdit" data-bs-toggle="modal" data-bs-target="#edit_masterPengeluaran">
                                        <span class="iconify-inline" data-icon="bx:bx-edit" data-width="20" data-height="20"></span>
                                    </button>
                                    <button type="button" data-id="' . $row->pengeluaran_id . '" class="btn-table red hapus_masterPengeluaran btnEdit" data-bs-toggle="modal" data-bs-target="#hapus_masterPengeluaran">
                                        <span class="iconify-inline" data-icon="carbon:trash-can"data-width="20" data-height="20"></span>
>>>>>>> Stashed changes
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

        <!-- Modal Tambah Pengeluaran -->
        <div class="modal fade" id="add_masterPengeluaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Tambah Jenis Pengeluaran</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('admin/Pengeluaran/aksiTambahPengeluaran'); ?>
                        <div class="pb-4">

                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Jenis Pengeluaran</label>
                                <input type="text" class="login-input regular" name="jenis" placeholder="" required>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Group Pengeluaran</label>
                                <input type="text" class="login-input regular" name="group" placeholder="" required>
                            </div>
                        </div>
                        <button type="submit" class="btn-table submit-modal">Tambah data</button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Pengeluaran -->
        <div class="modal fade" id="edit_masterPengeluaran" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Ubah Data Jenis Pengeluaran</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('admin/Pengeluaran/aksiEditPengeluaran'); ?>
                        <div class="pb-4">
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="font-w-400 my-2 color-secondary">Jenis Pengeluaran</label>
                                <input type="text" class="login-input regular" name="jenis" value="" required>
                                <input type="hidden" id="pengeluaran_id" name="pengeluaran_id" value="">
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="font-w-400 my-2 color-secondary">Group Pengeluaran</label>
                                <input type="text" class="login-input regular" name="group" value="" required>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <button type="submit" class="btn-table submit-modal ms-1">Simpan</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Hapus Pengeluaran -->
        <div class="modal fade" id="hapus_masterPengeluaran" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Hapus Pengeluaran</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('admin/Pengeluaran/aksiHapus'); ?>
                        <div class="pb-4">
                            <div class="d-flex flex-column my-2 w-100">
                                <p class="font-w-700 color-darker mb-0">Apakah anda yakin menghapus data ini ?</p>
                                <input type="hidden" id="pengeluaran_id" name="pengeluaran_id" value="">
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <button type="button" class="btn-table submit-modal outline me-1" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-table submit-modal ms-1">Hapus</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#tablePengeluaran tbody').on('click', '.btnEdit', function() {
                const id = $(this).data('id')
                const jenis = $(this).data('jenis')
                const group = $(this).data('group')

                $('input[name=jenis]').val(jenis);
                $('input[name=group]').val(group);
                $('input[name=pengeluaran_id]').val(id);
            })
        </script>
        <div class="foot">
        </div>
    </div>
</div>
</div>