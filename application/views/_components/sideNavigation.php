<div class="side-nav">
    <div class="top-space"></div>
    <div class="profile-section">
        <img src="<?= site_url() ?>assets/src/img/cat.jpg" alt="">
        <p class="mb-0"><?= $auth['username']; ?></p>
    </div>
    <div class="nav-section">

        <div class="nav-links <?= uri_string() == 'admin/dashboard' ? 'active' : '' ?>">
            <a href="<?= site_url() ?>admin/dashboard">Dashboard</a>
        </div>
        <div class="nav-links <?= uri_string() == 'admin/form_pengajuan' ? 'active' : '' ?>">
            <a href="<?= site_url() ?>admin/form_pengajuan">Form Pengajuan</a>
        </div>
        <?php
            $active = (uri_string() == 'admin/master_driver' || uri_string() == 'admin/master_region' || uri_string() == 'admin/master_instansi' || uri_string() == 'admin/master_sparepart' || uri_string() == 'admin/master_kendaraan' || uri_string() == 'admin/master_pengeluaran' ? "active" : "");
        ?>
        <div class="nav-links accordion-nav <?= $active?>">
            <div class="position-relative">
                <a>Master</a>
                <span class="iconify chevron" data-icon="akar-icons:chevron-left"></span>
            </div>

            <div class="sub-nav">
                <a href="<?= site_url() ?>admin/master_driver">Driver</a>
                <a href="<?= site_url() ?>admin/master_region">Region</a>
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
            <span class="iconify burger" data-icon="mdi:backburger"></span>
        </button>
        <a class="btn-table orange" href="<?= base_url('admin/Auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
            <span class="iconify" data-icon="ls:logout"></span>
            Logout
        </a>
    </div>
</div>