<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master Jenis Pengeluaran
            </p>
            <button type="button" class="btn-table green" data-bs-toggle="modal" data-bs-target="#add_masterPengeluaran">Add</button>
        </div>
        <div class="card-section">
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table id="tablePengeluaran" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Jenis Pengeluaran', 'Grup Pengeluaran', 'Action');
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

                                    '<button type="button" data-id="' . $row->pengeluaran_id . '" data-jenis="' . $row->pengeluaran_jenis . '" data-group="' . $row->pengeluaran_group . '" class="btn-table edit_masterPengeluaran btnEdit" data-bs-toggle="modal" data-bs-target="#edit_masterPengeluaran">
                                            Edit
                                        </button>
                                    <button type="button" data-id="' . $row->pengeluaran_id . '" class="btn-table red hapus_masterPengeluaran btnEdit" data-bs-toggle="modal" data-bs-target="#hapus_masterPengeluaran">
                                            Hapus
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
                                <select class="login-input regular" name="group" id="" required>
                                    <option value="">Pilih Group</option>
                                    <option value="Administrasi">Administrasi</option>
                                    <option value="Maintenance">Maintenance</option>
                                    <option value="Expense">Expense</option>
                                </select>
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
                        <p class="font-w-700 color-darker mb-0">Edit Jenis Pengeluaran</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('admin/Pengeluaran/aksiEditPengeluaran'); ?>
                        <div class="pb-4">
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="font-w-400 my-2 color-secondary">Jenis Pengeluaran</label>
                                <input type="text" class="login-input regular" id="pengeluaran_jenis" name="jenis" value="" required>
                                <input type="hidden" id="pengeluaran_id" name="pengeluaran_id" value="">
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <select class="login-input regular" name="group" id="pengeluaran_group" required>
                                    <option value="">Pilih Group</option>
                                    <option value="Administrasi">Administrasi</option>
                                    <option value="Maintenance">Maintenance</option>
                                    <option value="Expense">Expense</option>
                                </select>
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

                $('#pengeluaran_jenis').val(jenis);
                $('#pengeluaran_group').val(group);
                $('input[name=pengeluaran_id]').val(id);
            })
        </script>
        <div class="foot">
        </div>
    </div>
</div>
</div>