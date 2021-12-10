<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <?php echo validation_errors(); ?>
        <?= form_open_multipart('admin/aksiTambahDriver'); ?>
        <p class="mb-3 fs-5 font-w-500 color-darker">
            Master Tambah Driver
        </p>
        <div class="card-section">
            <div class="head">
                <p>Detail Driver</p>
            </div>
            <div class="body form">
                <div class="row m-0 p-0 w-100">
                    <div class="col-12 col-lg-12 pe-0 d-flex flex-column justify-content-between">
                        <label class="mb-3">NIK</label>
                        <input type="telp" class="login-input regular" name="nik" placeholder="NIK" onkeypress="return isNumberKey(event)" required>
                        <label class="my-3">Nama</label>
                        <input type="text" class="login-input regular" name="nama" placeholder="Nama" required>
                        <label class="my-3">Foto</label>
                            <div id="boxImg" class="text-center mb-3 p-3" style="border: 1px solid #ddd;border-radius: 10px;cursor: pointer;">
                                <img style="max-width: 250px;" id="blah" class="" src="<?= base_url('assets/images/dummy-post.jpg')?>" />
                            </div>
                        <input type="file" accept=".jpg,.png,.jpeg,.bmp" class="login-auth" name="foto" style="cursor: pointer;" id="imgPoster" required>
                        <label class="my-3">Foto KTP</label>
                            <div id="boxImg2" class="text-center mb-3 p-3" style="border: 1px solid #ddd;border-radius: 10px;cursor: pointer;">
                                <img style="max-width: 250px;" id="blah2" class="" src="<?= base_url('assets/images/dummy-post.jpg')?>" />
                            </div>
                        <input type="file" accept=".jpg,.png,.jpeg,.bmp" class="login-auth" name="ktp" style="cursor: pointer;" id="imgPoster2" required>
                        <label class="my-3">Alamat</label>
                        <input type="text" class="login-input regular" name="alamat" placeholder="Alamat" required>
                        <label class="my-3">Telefon</label>
                        <input type="telp" class="login-input regular" onkeypress="return isNumberKey(event)" name="telp" placeholder="Telefon" required>
                    </div>
                </div>

            </div>
        </div>
        <button type="submit" class="btn-table submit-modal">
            SImpan Data
        </button>
        <?= form_close(); ?>
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

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#boxImg").click(function(){
        $('#imgPoster').click();
    });

    $("#imgPoster").change(function(){
        readURL(this);
    });
    
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah2').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#boxImg2").click(function(){
        $('#imgPoster2').click();
    });

    $("#imgPoster2").change(function(){
        readURL2(this);
    });

    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
        return true;
    }
</script>