<div class="side-nav">
    <div class="top-space"></div>
    <div class="profile-section">
        <img src="<?= site_url() ?>assets/src/img/cat.jpg" alt="">
        <p class="mb-0"><?= $auth['username']; ?></p>
    </div>
    <div class="nav-links <?= uri_string() == 'admin/dashboard' ? 'active' : '' ?>">
        <a href="<?= site_url() ?>admin/dashboard">Dashboard</a>
    </div>
    <div class="nav-links <?= uri_string() == 'admin/form_pengajuan' ? 'active' : '' ?>">
        <a href="<?= site_url() ?>admin/form_pengajuan">Form Pengajuan</a>
    </div>
    <div class="nav-links <?= uri_string() == 'admin/master_sparepart' ? 'active' : '' ?>">
        <a href="<?= site_url() ?>admin/master_sparepart">Master Sparepart</a>
    </div>
    <div class="nav-links <?= uri_string() == 'admin/master_region' ? 'active' : '' ?>">
        <a href="<?= site_url() ?>admin/master_region">Master Region</a>
    </div>
</div>
<div class="top-nav">
    <div class="d-flex justify-content-end align-items-center h-100 ps-4">
        <a class="btn-table orange" style="margin-right: 10px;" href="<?= base_url('admin/Auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-white-400"></i>
            Logout
        </a>
    </div>
</div>