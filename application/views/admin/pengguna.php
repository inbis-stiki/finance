<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Pengguna
            </p>
            <button type="button" id="btn_addPenggun" class="btn-table green" data-bs-toggle="modal" data-bs-target="#add_pengguna">Tambah</button>
        </div>
        <?php
            if(!empty($this->session->flashdata('err_msg'))){
                echo '
                    <div class="alert alert-danger" role="alert">
                    '.$this->session->flashdata('err_msg').'
                    </div>
                ';        
            }
            if(!empty($this->session->flashdata('succ_msg'))){
                echo '
                    <div class="alert alert-success" role="alert">
                        '.$this->session->flashdata('succ_msg').'
                    </div>
                ';        
            }
        ?>
        <div class="card-section">
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table id="tablePengguna" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Foto', 'Nama', 'Hak Akses', 'Aksi');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($User as $row) {
                                $img = $row->user_img == null || $row->user_img == '' ? site_url().'assets/src/img/admin.png' : $row->user_img;
                                $this->table->add_row(
                                    $no++,
                                    '
                                        <div >
                                            <img style="width: 50px;height: 50px;border-radius: 50%;" src="'.$img.'" alt="">
                                        </div>
                                    ',
                                    $row->user_nama,
                                    $row->user_nama,
                                    '
                                    <button type="button" data-id="' . $row->user_username . '" data-nama="' . $row->user_nama . '" class="btn-table green edit_masterSparepart btnReset" data-bs-toggle="modal" data-bs-target="#reset_pengguna">
                                        <span class="iconify-inline" data-icon="fluent:key-reset-24-regular" data-width="20" data-height="20"></span>
                                    </button>
                                    <button type="button" data-id="' . $row->user_username . '" data-nama="' . $row->user_nama . '" data-management="'.$row->user_ismanagement.'" data-admin="'.$row->user_isadmin.'" data-master="'.$row->user_ismaster.'" data-super="'.$row->user_issuper.'" class="btn-table edit_masterSparepart btnEdit" data-bs-toggle="modal" data-bs-target="#edit_masterSparepart">
                                        <span class="iconify-inline" data-icon="bx:bx-edit" data-width="20" data-height="20"></span>
                                    </button>
                                    <button type="button" data-id="' . $row->user_username . '" class="btn-table red hapus_pengguna btnDelete" data-bs-toggle="modal" data-bs-target="#hapus_pengguna">
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
        <!-- Modal Tambah Pengguna -->
        <div class="modal fade" id="add_pengguna" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Tambah Pengguna</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('super/pengguna/store'); ?>
                        <div class="pb-4">
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Username</label>
                                <input type="text" class="login-input regular" name="username" placeholder="" required>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Nama</label>
                                <input type="text" class="login-input regular" name="nama" placeholder="" required>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Password</label>
                                <input type="text" class="login-input regular add_password" name="" placeholder="" disabled>
                                <input type="hidden" class="login-input regular add_password" name="password" placeholder="">
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Hak Akses</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="isManagement" id="inlineCheckbox1">
                                    <label class="form-check-label" for="inlineCheckbox1">Management</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="isAdmin" id="inlineCheckbox2">
                                    <label class="form-check-label" for="inlineCheckbox2">Admin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="isMaster" id="inlineCheckbox3">
                                    <label class="form-check-label" for="inlineCheckbox3">Master</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="isSuper" id="inlineCheckbox4">
                                    <label class="form-check-label" for="inlineCheckbox4">Super</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn-table submit-modal">Tambah data</button>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Edit Sparepart -->
        <div class="modal fade" id="edit_masterSparepart" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Ubah Pengguna</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('super/pengguna/update'); ?>
                        <div class="pb-4">
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Username</label>
                                <input type="text" class="login-input regular mdlEdit_username" name="username" placeholder="" disabled>
                                <input type="hidden" class="login-input regular mdlEdit_username" name="username" placeholder="" required>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Nama</label>
                                <input id="mdlEdit_nama" type="text" class="login-input regular" name="nama" placeholder="" required>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Hak Akses</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="isManagement" id="mdlEdit_management">
                                    <label class="form-check-label" for="mdlEdit_management">Management</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="isAdmin" id="mdlEdit_admin">
                                    <label class="form-check-label" for="mdlEdit_admin">Admin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="isMaster" id="mdlEdit_master">
                                    <label class="form-check-label" for="mdlEdit_master">Master</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="isSuper" id="mdlEdit_super">
                                    <label class="form-check-label" for="mdlEdit_super">Super</label>
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
        <!-- Modal Delete -->
        <!-- Modal Hapus Pengguna -->
        <div class="modal fade" id="hapus_pengguna" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Hapus Pengguna</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('super/pengguna/destroy'); ?>
                        <div class="pb-4">
                            <div class="d-flex flex-column my-2 w-100">
                                <p class="font-w-700 color-darker mb-0">Apakah anda yakin menghapus pengguna ini ?</p>
                                <input type="hidden" id="mdlDelete_id" name="username" value="">
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
        <!-- Modal Reset Pengguna -->
        <div class="modal fade" id="reset_pengguna" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Reset Password Pengguna</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('super/pengguna/reset-password'); ?>
                        <div class="pb-4">
                            <div class="d-flex flex-column my-2 w-100">
                                <p class="font-w-700 color-darker mb-0">Apakah anda yakin untuk mereset password pengguna ini ? Password baru <code id="mdlReset_pass1"></code></p>
                                <input type="hidden" id="mdlReset_id" name="username" value="">
                                <input type="hidden" id="mdlReset_pass2" name="password" value="">
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
        <script>
            $('#btn_addPenggun').click(function(){
                $('.add_password').val(randAlphaNumeric(8));
            })
            $('#tablePengguna tbody').on('click', '.btnEdit', function() {
                const username      = $(this).data('id')
                const nama          = $(this).data('nama')
                const isManagement  = $(this).data('management')
                const isAdmin       = $(this).data('admin')
                const isMaster      = $(this).data('master')
                const isSuper       = $(this).data('super')

                $('.mdlEdit_username').val(username)
                $('#mdlEdit_nama').val(nama)

                if(isManagement == '1')
                    $('#mdlEdit_management').attr('checked', true)
                else
                    $('#mdlEdit_management').attr('checked', false)
                    
                if(isAdmin == '1')
                    $('#mdlEdit_admin').attr('checked', true)
                else
                    $('#mdlEdit_admin').attr('checked', false)

                if(isMaster == '1')
                    $('#mdlEdit_master').attr('checked', true)
                else
                    $('#mdlEdit_master').attr('checked', false)

                if(isSuper == '1')
                    $('#mdlEdit_super').attr('checked', true)
                else
                    $('#mdlEdit_super').attr('checked', false)

            })
            $('#tablePengguna tbody').on('click', '.btnDelete', function() {
                const id = $(this).data('id')
                $('#mdlDelete_id').val(id);
            })
            $('#tablePengguna tbody').on('click', '.btnReset', function() {
                const id = $(this).data('id')
                const newPass = randAlphaNumeric(8);
                $('#mdlReset_id').val(id);
                $('#mdlReset_pass1').html(newPass);
                $('#mdlReset_pass2').val(newPass);
            })
            const randAlphaNumeric = length => {
                var result = '';
                var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
                return result;
            }
        </script>
        <!-- <div class="foot"> -->
        <!-- </div> -->
    </div>
</div>
</div>