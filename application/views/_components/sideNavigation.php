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
    <div class="d-flex flex-row justify-content-start align-items-center h-100 ps-4">
        <button type="submit" class="border-0 bg-transparent color-secondary fs-5"><span class="iconify" data-icon="fa-solid:search"></span></button>
        <input type="text" class="outline-none border-0 ms-2 px-3 w-25" placeholder="Search">
    </div>
</div>