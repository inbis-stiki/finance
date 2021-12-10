<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master Klien
            </p>
            <button type="button" class="btn-table green" data-bs-toggle="modal" data-bs-target="#add_masterKlien">Tambah</button>
        </div>
        <div class="card-section">
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table id="tableKlien" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Nama Klien', 'Jenis', 'Alamat', 'Kontak', 'NPWP', 'No. Rekening', 'Wilayah Klien', 'Aksi');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($Klien as $row) {
                                $this->table->add_row(
                                    $no++,
                                    $row->client_nama,
                                    $row->client_jenis,
                                    $row->client_alamat,
                                    $row->client_contact,
                                    $row->client_npwp,
                                    $row->client_norek,
                                    $row->region_kota,

                                    '<button type="button" data-nama="' . $row->client_nama . '" data-jenis="' . $row->client_jenis . '" data-alamat="' . $row->client_alamat . '" data-kontak="' . $row->client_contact . '" data-npwp="' . $row->client_npwp . '" data-norek="' . $row->client_norek . '" data-group="' . $row->id_region . '" class="btn-table edit_masterKlien btnEdit" data-bs-toggle="modal" data-bs-target="#edit_masterKlien">
                                        <span class="iconify-inline" data-icon="bx:bx-edit" data-width="20" data-height="20"></span>
                                    </button>
                                    <button type="button" data-nama="' . $row->client_nama . '" class="btn-table red hapus_masterKlien btnEdit" data-bs-toggle="modal" data-bs-target="#hapus_masterKlien">
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

        <!-- Modal Tambah Klien -->
        <div class="modal fade" id="add_masterKlien" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Tambah Klien</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('admin/Klien/aksiTambahKlien'); ?>
                        <div class="pb-4">
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Nama Klien</label>
                                <input type="text" class="login-input regular" name="nama" placeholder="" required>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Alamat Klien</label>
                                <input type="text" class="login-input regular" name="alamat" placeholder="" required>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Kontak Klien</label>
                                <input type="text" class="login-input regular" onkeypress="return Angka(event)" name="kontak" placeholder="" required>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">NPWP Klien</label>
                                <input type="text" class="login-input regular" onkeypress="return Angka(event)" name="npwp" placeholder="" required>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">No. Rekening Klien</label>
                                <input type="text" class="login-input regular" onkeypress="return Angka(event)" name="norek" placeholder="" required>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Wilayah Klien</label>
                                <select class="login-input regular" name="group" id="wilayahKlien" required>
                                    <option value="" disabled selected>Pilih Wilayah</option>
                                    <?php foreach ($Wilayah as $row) : ?>
                                        <option value="<?= $row->region_id ?>"><?= $row->region_kota ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="row m-0 p-0 w-full">
                                <label class="my-2 color-secondary ps-0">Jenis Klien</label>
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

        <!-- Modal Edit Klien -->
        <div class="modal fade" id="edit_masterKlien" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Ubah Data Klien</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('admin/Klien/aksiEditKlien'); ?>
                        <div class="pb-4">

                            <div class="d-flex flex-column my-2 w-100">
                                <label class="font-w-400 my-2 color-secondary">Nama Klien</label>
                                <input type="text" class="login-input regular" name="nama" value="" required>
                                <input type="hidden" id="instansi_id" name="instansi_id" value="">
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Alamat Klien</label>
                                <input type="text" class="login-input regular" name="alamat" placeholder="" required>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Kontak Klien</label>
                                <input type="text" class="login-input regular" onkeypress="return Angka(event)" name="kontak" placeholder="" required>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">NPWP Klien</label>
                                <input type="text" class="login-input regular" onkeypress="return Angka(event)" name="npwp" placeholder="" required>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">No. Rekening Klien</label>
                                <input type="text" class="login-input regular" onkeypress="return Angka(event)" name="norek" placeholder="" required>
                            </div>
                            <div class="row m-0 p-0 w-full">
                                <label class="my-2 color-secondary ps-0">Jenis Klien</label>
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

        <!-- Modal Hapus Klien -->
        <div class="modal fade" id="hapus_masterKlien" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Hapus Klien</p>
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
            $('#tableKlien tbody').on('click', '.btnEdit', function() {
                const nama = $(this).data('nama')
                const jenis = $(this).data('jenis')
                const alamat = $(this).data('alamat')
                const kontak = $(this).data('kontak')
                const npwp = $(this).data('npwp')
                const norek = $(this).data('norek')
                const group = $(this).data('group')

                $('input[name=nama]').val(nama);
                $('input[name=alamat]').val(alamat);
                $('input[name=kontak]').val(kontak);
                $('input[name=npwp]').val(npwp);
                $('input[name=norek]').val(norek);
                $('input[name=group]').val(group);

                if (jenis == "BUMN") {
                    $('#bumn').prop('checked', true)
                } else {
                    $('#nonbumn').prop('checked', true)
                }
            })

            function Angka(event) {
                var angka = (event.which) ? event.which : event.keyCode
                if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                    return false;
                return true;
            }
        </script>
        <div class="foot">
        </div>
    </div>
</div>
</div>