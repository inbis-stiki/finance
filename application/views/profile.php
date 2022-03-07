<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <?php echo validation_errors(); ?>
        <p class="mb-3 fs-5 font-w-500 color-darker">
            Profil
        </p>
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
            <div class="head">
                <p>Data Profil</p>
            </div>
            <div class="body form">
                <div class="row m-0 p-0 w-100">
                <?= form_open_multipart('profile/update'); ?>
                    <div class="col-12 col-lg-12 pe-0 d-flex flex-column justify-content-between">
                        <label class="mb-3">Username</label>
                        <input type="text" class="login-input regular" name="" placeholder="Username" value="<?= $user->user_username?>" onkeypress="return isNumberKey(event)" disabled>
                        <input type="hidden" class="login-input regular" name="username" value="<?= $user->user_username?>"  placeholder="Username" onkeypress="return isNumberKey(event)" required>
                        <label class="my-3">Nama</label>
                        <input type="text" class="login-input regular" name="nama" value="<?= $user->user_nama?>" placeholder="Nama" required>
                        <label class="my-3">Foto</label>
                        <?php
                            $linkImg = $user->user_img != NULL || $user->user_img != '' ? $user->user_img : base_url('assets/images/dummy-post.jpg');
                        ?>
                        <div id="boxImg" class="text-center mb-3 p-3" style="border: 1px solid #ddd;border-radius: 10px;cursor: pointer;">
                            <img style="max-width: 250px;" id="blah" class="" src="<?=  $linkImg?>" />
                        </div>
                        <input type="file" accept=".jpg,.png,.jpeg,.bmp" class="login-auth" name="foto" style="cursor: pointer;" id="imgPoster">
                        <label class="my-3">Ubah Password</label>
                        <button type="button" data-slct="adm" data-bs-toggle="modal" data-bs-target="#mdlChangePass" class="btn-table infoKendaraan" style="width: 100px;">
                            <span class="iconify-inline" data-icon="clarity:key-outline-alerted" data-width="15" data-height="15"></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn-table submit-modal">
            Simpan Data
        </button>
        <?= form_close(); ?>
    </div>
</div>
<!-- Modal Assign Kendaraan -->
<div class="modal fade" id="mdlChangePass" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-header">
                <p class="font-w-700 color-darker mb-0">Ubah Pasword</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-14px pt-0 d-flex flex-column">
            <?= form_open_multipart('profile/change-pass'); ?>
                <div class="pb-4">
                    <div class="d-flex flex-column my-2 w-100">
                        <label class="my-2 color-secondary">Password Baru</label>
                        <input type="text" class="login-input regular fs-16px" name="pass" value="" placeholder="Password" required>
                        <input type="hidden" class="login-input regular fs-16px" name="username" value="<?= $user->user_username?>" required>
                    </div>
                    <button type="submit" class="btn-table submit-modal">Simpan Data</button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?php if ((($this->session->flashdata('sukses'))) && $this->session->flashdata('sukses') != "") { ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#success').modal('show');
        });
    </script>
<?php } ?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#boxImg").click(function() {
        $('#imgPoster').click();
    });

    $("#imgPoster").change(function() {
        readURL(this);
    });

    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah2').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#boxImg2").click(function() {
        $('#imgPoster2').click();
    });

    $("#imgPoster2").change(function() {
        readURL2(this);
    });
</script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>