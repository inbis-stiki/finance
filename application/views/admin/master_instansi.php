<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master Instansi
            </p>
            <button type="button" class="btn-table green" data-bs-toggle="modal" data-bs-target="#add_masterInstansi">Tambah</button>
        </div>
        <div class="card-section">
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table id="tableInstansi" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Nama Instansi', 'Jenis Instansi', 'Aksi');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($Instansi as $row) {
                                $this->table->add_row(
                                    $no++,
                                    $row->instansi_nama,
                                    $row->instansi_jenis,

                                    '<button type="button" data-id="' . $row->instansi_id . '" data-nama="' . $row->instansi_nama . '" data-jenis="' . $row->instansi_jenis . '" class="btn-table edit_masterInstansi btnEdit" data-bs-toggle="modal" data-bs-target="#edit_masterInstansi">
                                        <span class="iconify-inline" data-icon="bx:bx-edit" data-width="20" data-height="20"></span>
                                    </button>
                                    <button type="button" data-id="' . $row->instansi_id . '" class="btn-table red hapus_masterInstansi btnEdit" data-bs-toggle="modal" data-bs-target="#hapus_masterInstansi">
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

        <!-- Modal Tambah Instansi -->
        <div class="modal fade" id="add_masterInstansi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Tambah Instansi</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('admin/Instansi/aksiTambahInstansi'); ?>
                        <div class="pb-4">

                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Nama Instansi</label>
                                <input type="text" class="login-input regular" name="nama" placeholder="" required>
                            </div>
                            <div class="row m-0 p-0 w-full">
                                <label class="my-2 color-secondary ps-0">Jenis Instansi</label>
                                <div class="col-6 ps-0 d-flex flex-row align-items-center">
                                    <div class="d-flex flex-row align-items-center radio-wrapper">
                                        <input type="radio" value="bumn" name="jenis" class="pilih" checked>
                                        <label for="bumn" class="font-w-500 ms-2 me-3">BUMN</label>
                                    </div>
                                </div>
                                <div class="col-6 pe-0 d-flex flex-row align-items-center">
                                    <div class="d-flex flex-row align-items-center radio-wrapper">
                                        <input type="radio" value="nonbumn" name="jenis" class="pilih">
                                        <label for="nonbumn" class="font-w-500 ms-2 me-3">Non BUMN</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn-table submit-modal">Tambah data</button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Instansi -->
        <div class="modal fade" id="edit_masterInstansi" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Ubah Data Instansi</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('admin/Instansi/aksiEditInstansi'); ?>
                        <div class="pb-4">

                            <div class="d-flex flex-column my-2 w-100">
                                <label class="font-w-400 my-2 color-secondary">Nama Instansi</label>
                                <input type="text" class="login-input regular" name="instansi" value="" required>
                                <input type="hidden" id="instansi_id" name="instansi_id" value="">
                            </div>
                            <div class="row m-0 p-0 w-full">
                                <label class="my-2 color-secondary ps-0">Jenis Instansi</label>
                                <div class="col-6 ps-0 d-flex flex-row align-items-center">
                                    <div class="d-flex flex-row align-items-center radio-wrapper">
                                        <input type="radio" id="bumn" value="BUMN" name="jenis" class="pilih2">
                                        <label for="bumn" class="font-w-500 ms-2 me-3">BUMN</label>
                                    </div>
                                </div>
                                <div class="col-6 pe-0 d-flex flex-row align-items-center">
                                    <div class="d-flex flex-row align-items-center radio-wrapper">
                                        <input type="radio" id="nonbumn" value="Non BUMN" name="jenis" class="pilih2">
                                        <label for="nonbumn" class="font-w-500 ms-2 me-3">Non BUMN</label>
                                    </div>
                                </div>
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

        <!-- Modal Hapus Instansi -->
        <div class="modal fade" id="hapus_masterInstansi" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Hapus Instansi</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('admin/Instansi/aksiHapus'); ?>
                        <div class="pb-4">
                            <div class="d-flex flex-column my-2 w-100">
                                <p class="font-w-700 color-darker mb-0">Apakah anda yakin menghapus data ini ?</p>
                                <input type="hidden" id="instansi_id" name="instansi_id" value="">
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
            $('#tableInstansi tbody').on('click', '.btnEdit', function() {
                const id = $(this).data('id')
                const nama = $(this).data('nama')
                const jenis = $(this).data('jenis')

                $('input[name=instansi]').val(nama);
                $('input[name=instansi_id]').val(id);

                if (jenis == "BUMN") {
                    $('#bumn').prop('checked', true)
                } else {
                    $('#nonbumn').prop('checked', true)
                }
            })
        </script>
        <div class="foot">
        </div>
    </div>
</div>
</div>