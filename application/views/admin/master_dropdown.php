<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master Wilayah
            </p>
            <button type="button" class="btn-table green" data-bs-toggle="modal" data-bs-target="#add_masterDropdownWil">Tambah</button>
        </div>
        <div class="card-section">
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table id="tableDropdown" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Menu Dropdown', 'List Dropdown', 'Aksi');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($Dropdown as $row) {
                                $this->table->add_row(
                                    $no++,
                                    $row->dropdown_menu,
                                    $row->dropdown_list,

                                    '<button type="button" data-id="' . $row->dropdown_id . '" data-menu="' . $row->dropdown_menu . '" data-list="' . $row->dropdown_list . '"  class="btn-table edit_masterDropdown btnEdit" data-bs-toggle="modal" data-bs-target="#edit_masterDropdown">
                                        <span class="iconify-inline" data-icon="bx:bx-edit" data-width="20" data-height="20"></span>
                                    </button>
                                    <button type="button" data-id="' . $row->dropdown_id . '" class="btn-table red hapus_masterDropdown btnEdit" data-bs-toggle="modal" data-bs-target="#hapus_masterDropdown">
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
        <!--Dropdown SIM--->
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master SIM
            </p>
        </div>
        <div class="card-section">
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table id="tableDropdown" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Menu Dropdown', 'List Dropdown', 'Aksi');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($SIM as $row) {
                                $this->table->add_row(
                                    $no++,
                                    $row->dropdown_menu,
                                    $row->dropdown_list,

                                    '<button type="button" data-id="' . $row->dropdown_id . '" data-menu="' . $row->dropdown_menu . '" data-list="' . $row->dropdown_list . '"  class="btn-table edit_masterDropdown btnEdit" data-bs-toggle="modal" data-bs-target="#edit_masterDropdown">
                                        <span class="iconify-inline" data-icon="bx:bx-edit" data-width="20" data-height="20"></span>
                                    </button>
                                    <button type="button" data-id="' . $row->dropdown_id . '" class="btn-table red hapus_masterDropdown btnEdit" data-bs-toggle="modal" data-bs-target="#hapus_masterDropdown">
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
        <!--Dropdown PT--->
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master PT
            </p>
        </div>
        <div class="card-section">
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table id="tableDropdown" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Menu Dropdown', 'List Dropdown', 'Aksi');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($PT as $row) {
                                $this->table->add_row(
                                    $no++,
                                    $row->dropdown_menu,
                                    $row->dropdown_list,

                                    '<button type="button" data-id="' . $row->dropdown_id . '" data-menu="' . $row->dropdown_menu . '" data-list="' . $row->dropdown_list . '"  class="btn-table edit_masterDropdown btnEdit" data-bs-toggle="modal" data-bs-target="#edit_masterDropdown">
                                        <span class="iconify-inline" data-icon="bx:bx-edit" data-width="20" data-height="20"></span>
                                    </button>
                                    <button type="button" data-id="' . $row->dropdown_id . '" class="btn-table red hapus_masterDropdown btnEdit" data-bs-toggle="modal" data-bs-target="#hapus_masterDropdown">
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
        <!--Dropdown Jenis Kendaraan--->
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Jenis Kendaraan
            </p>
        </div>
        <div class="card-section">
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table id="tableDropdown" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Menu Dropdown', 'List Dropdown', 'Aksi');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($JenKen as $row) {
                                $this->table->add_row(
                                    $no++,
                                    $row->dropdown_menu,
                                    $row->dropdown_list,

                                    '<button type="button" data-id="' . $row->dropdown_id . '" data-menu="' . $row->dropdown_menu . '" data-list="' . $row->dropdown_list . '"  class="btn-table edit_masterDropdown btnEdit" data-bs-toggle="modal" data-bs-target="#edit_masterDropdown">
                                        <span class="iconify-inline" data-icon="bx:bx-edit" data-width="20" data-height="20"></span>
                                    </button>
                                    <button type="button" data-id="' . $row->dropdown_id . '" class="btn-table red hapus_masterDropdown btnEdit" data-bs-toggle="modal" data-bs-target="#hapus_masterDropdown">
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
        <!--Dropdown Jenis Sparepart--->
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master Jenis Sparepart
            </p>
        </div>
        <div class="card-section">
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table id="tableDropdown" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Menu Dropdown', 'List Dropdown', 'Aksi');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($JenSpa as $row) {
                                $this->table->add_row(
                                    $no++,
                                    $row->dropdown_menu,
                                    $row->dropdown_list,

                                    '<button type="button" data-id="' . $row->dropdown_id . '" data-menu="' . $row->dropdown_menu . '" data-list="' . $row->dropdown_list . '"  class="btn-table edit_masterDropdown btnEdit" data-bs-toggle="modal" data-bs-target="#edit_masterDropdown">
                                        <span class="iconify-inline" data-icon="bx:bx-edit" data-width="20" data-height="20"></span>
                                    </button>
                                    <button type="button" data-id="' . $row->dropdown_id . '" class="btn-table red hapus_masterDropdown btnEdit" data-bs-toggle="modal" data-bs-target="#hapus_masterDropdown">
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


        <!-- Modal Tambah Dropdown -->
        <div class="modal fade" id="add_masterDropdownWil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Tambah Dropdown</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('admin/Dropdown/aksiTambahDropdown'); ?>
                        <div class="pb-4">
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Menu Dropdown</label>
                                <select name="menu" class="login-input regular" required>
                                    <option value="Wilayah">Wilayah</option>
                                    <option value="SIM">SIM</option>
                                    <option value="PT">PT</option>
                                    <option value="Jenis Kendaraan">Jenis Kendaraan</option>
                                    <option value="Jenis Sparepart">Jenis Sparepart</option>
                                </select>
                                <!-- <input type="" class="login-input regular" name="menu" value="Wilayah" disabled> -->
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">List Dropdown</label>
                                <input type="text" class="login-input regular" name="list" placeholder="" required>
                            </div>
                        </div>
                        <button type="submit" class="btn-table submit-modal">Tambah data</button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Dropdown -->
        <div class="modal fade" id="edit_masterDropdown" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Ubah Data Dropdown</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('admin/Dropdown/aksiEditDropdown'); ?>
                        <div class="pb-4">

                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Menu Dropdown</label>
                                <select id="mdlEdit_menu" name="menu" class="login-input regular" required>
                                    <option value="Wilayah">Wilayah</option>
                                    <option value="SIM">SIM</option>
                                    <option value="PT">PT</option>
                                    <option value="Jenis Kendaraan">Jenis Kendaraan</option>
                                    <option value="Jenis Sparepart">Jenis Sparepart</option>
                                </select>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">List Dropdown</label>
                                <input type="text" class="login-input regular" name="list" placeholder="" required>
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

        <!-- Modal Hapus Dropdown -->
        <div class="modal fade" id="hapus_masterDropdown" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Hapus Dropdown</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('admin/Dropdown/aksiHapus'); ?>
                        <div class="pb-4">
                            <div class="d-flex flex-column my-2 w-100">
                                <p class="font-w-700 color-darker mb-0">Apakah anda yakin menghapus data ini ?</p>
                                <input type="hidden" id="dropdown_id" name="dropdown_id" value="">
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
            $('#tableDropdown tbody').on('click', '.btnEdit', function() {
                const id = $(this).data('id')
                const menu = $(this).data('menu')
                const list = $(this).data('list')

                $('input[name=dropdown_id]').val(id);
                $('input[name=menu]').val(menu);
                $('input[name=list]').val(list);
            })
        </script>
        <div class="foot">
        </div>
    </div>
</div>