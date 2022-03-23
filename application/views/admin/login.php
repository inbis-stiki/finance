<form action="<?= site_url('auth/login'); ?>" method="POST">
    <div class="min-vh-100 row m-0 p-0 w-100">
        <div class="col-12 col-md-6 bg-light-purple">
            <div class="d-flex flex-column justify-content-center align-items-center h-100 px-5">
                <p class="fs-36px font-w-700 color-primary">Cost & Control Reporting</p>
                <img width="100%" height="auto" src="<?= site_url() ?>assets/src/img/login_image.svg" alt="">
            </div>
        </div>
        <div class="col-12 col-md-6 my-5">
            <div class="d-flex flex-column justify-content-center align-items-start h-100 px-5">
                <p class="font-w-700 fs-36px mb-3">Masuk</p>
                <div class="d-flex flex-column my-2 w-100">
                    <?php
                        if($this->session->flashdata('err_msg')){
                            echo '
                            <div class="alert alert-danger" role="alert">'.$this->session->flashdata('err_msg').'</div>
                            ';
                        } 
                    ?>
                    <label class="font-w-500 my-2">Username</label>
                    <input type="text" onkeypress="return preventSpace(event)" name="username" id="username" class="login-input" placeholder="username123" required>
                    <?= form_error('username', '<small>', '</small>'); ?>
                </div>
                <div class="d-flex flex-column my-2 w-100">
                    <label class="font-w-500 my-2">Password</label>
                    <input type="password" name="user_password" id="user_password" class="login-input" placeholder="•••••••••••••" required>
                    <?= form_error('user_password', '<small>', '</small>'); ?>
                </div>
                <button type="submit" class="login-btn mt-4 ms-auto">Masuk</button>
            </div>
        </div>
    </div>
</form>