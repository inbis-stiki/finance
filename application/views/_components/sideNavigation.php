<div class="side-nav">
    <div class="top-space"></div>
    <div class="profile-section">
        <img src="<?= site_url() ?>assets/src/img/admin.png" alt="">
        <p class="mb-0"><?= $auth['username']; ?></p>
    </div>
    <div class="nav-section">

        <div class="nav-links <?= uri_string() == 'admin/dashboard' ? 'active' : '' ?>">
            <a href="<?= site_url() ?>admin/dashboard">Dashboard</a>
        </div>
        <!-- <div class="nav-links <?= uri_string() == 'admin/form_pengajuan' ? 'active' : '' ?>">
            <a href="<?= site_url() ?>admin/form_pengajuan">Form Pengajuan</a>
        </div> -->
        <?php
        $active = (uri_string() == 'admin/master_driver' || uri_string() == 'admin/master_region' || uri_string() == 'admin/master_instansi' || uri_string() == 'admin/master_sparepart' || uri_string() == 'admin/master_kendaraan' || uri_string() == 'admin/master_pengeluaran' ? "active" : "");
        ?>
        <?php
        $activeform = (uri_string() == 'admin/form_pengajuan/unit_kendaraan' || uri_string() == 'admin/form_pengajuan/jenis_biaya' ? "active" : "");
        ?>

        <div class="nav-links accordion-nav <?= $activeform ?>">
            <div class="position-relative">
                <a>Form Pengajuan</a>
                <span class="iconify chevron" data-icon="akar-icons:chevron-left"></span>
            </div>

            <div class="sub-nav">
                <a href="<?= site_url() ?>admin/form_pengajuan/unit_kendaraan">Peminjaman</a>
                <a href="<?= site_url() ?>admin/form_pengajuan/jenis_biaya">Sparepart</a>
            </div>
        </div>

        <div class="nav-links accordion-nav <?= $active ?>">
            <div class="position-relative">
                <a>Master</a>
                <span class="iconify chevron" data-icon="akar-icons:chevron-left"></span>
            </div>

            <div class="sub-nav">
                <a href="<?= site_url() ?>admin/master_driver">Driver</a>
                <a href="<?= site_url() ?>admin/master_region">Wilayah</a>
                <a href="<?= site_url() ?>admin/master_instansi">Instansi</a>
                <a href="<?= site_url() ?>admin/master_sparepart">Sparepart</a>
                <a href="<?= site_url() ?>admin/master_kendaraan">Kendaraan</a>
                <a href="<?= site_url() ?>admin/master_pengeluaran">Jenis Pengeluaran</a>
            </div>
        </div>
    </div>
</div>
<div class="top-nav">
    <div class="d-flex justify-content-between align-items-center h-100 px-4">
        <button id="toggleSideNav" class="cursor-pointer fs-2 border-0 bg-transparent color-dark" data-toggle="modal" data-target="#logoutModal">
            <span class="iconify burger" data-icon="ci:hamburger"></span>
        </button>
        <button type="button" class="btn-table orange logoutModal" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <span class="iconify" data-icon="ls:logout"></span>
            Keluar
        </button>
        <!-- <a class="btn-table orange" type="button" data-toggle="modal" data-target="#logoutModal">
            <span class="iconify" data-icon="ls:logout"></span>
            Keluar
        </a> -->
    </div>
</div>

<!-- Modal Logout -->
<div class="modal fade" id="logoutModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-2">
            <div class="modal-header">
                <p class="font-w-700 color-darker mb-0">Konfirmasi Keluar</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fs-14px pt-0 d-flex flex-column">
                <div class="pb-4">
                    <div class="d-flex flex-column my-2 w-100">
                        <p class="font-w-700 color-darker mb-0">Apakah anda yakin keluar ?</p>
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <a href="<?= base_url('admin/Auth/logout') ?>" class="btn-table submit-modal ms-1" style="text-align: center;">Keluar</a>
                </div>
            </div>
        </div>
    </div>
</div>