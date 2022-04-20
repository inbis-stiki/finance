
<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="row">
            <div class="col">
                <div class="alert alert-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    Jatuh tempo pembayaran pajak STNK nomor kendaraan N 894583 AAF adalah 2 Februari 2022, <a href="#" class="alert-link">cek detail</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="alert alert-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    Jatuh tempo pembayaran pajak STNK nomor kendaraan N 894583 AAF adalah 2 Februari 2022, <a href="#" class="alert-link">cek detail</a>
                </div>
            </div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
            <div class="col">
                <div style="float: right;">
                    <span><i>Updated at : <?= date_format(date_create($reportUpdated->updated_at), 'j M Y H:i') ?></i></span>&nbsp;
                    <a href="<?= site_url('admin/update-report')?>" class="btn-table green" style="padding-top: 7px;">
                        <span class="iconify-inline" data-icon="ci:refresh" data-width="20" data-height="20" style="margin-top: 3px;"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-section">
            <div class="head">
                <p>Global Cost</p>
            </div>
            <div class="body" style="padding: 15px;">
                <?php
                $template = array('table_open' => '<table id="tblGlobal" class="table-custom" border="0">');
                $this->table->set_template($template);
                $this->table->set_heading('Area Operasional', 'Jumlah Transaksi', 'Total Transaksi');

                foreach ($GlobalCost as $row) {
                    $this->table->add_row(
                        $row->report_wilayah,
                        $row->report_jumlah_transaksi,
                        "Rp." . number_format($row->report_total_transaksi)
                    );
                }
                echo $this->table->generate();
                ?>

            </div>
            <div class="foot">
            </div>
        </div>
        <div class="card-section">
            <div class="head">
                <p>Daftar Kendaraan</p>
            </div>
            <div class="body" style="padding: 15px">
                <?php
                $template = array('table_open' => '<table id="tblKendaraan" class="table-custom">');
                $this->table->set_template($template);
                $this->table->set_heading('No. STNK', 'Pemilik', 'Merk Kendaraan', 'Umur Kendaraan', 'Wilayah');

                foreach ($DaftarKendaraan as $row) {
                    $currentDate = date("Y-m-d");
                    $umur = date_diff(date_create($row->kendaraan_tanggal_beli), date_create($currentDate));

                    $this->table->add_row(
                        $row->kendaraan_stnk,
                        $row->kendaraan_jenis == "Pribadi" ? "Pribadi" : $row->kendaraan_pt,
                        $row->kendaraan_merk,
                        $umur->format("%m") . " Bulan " . $umur->format('%y') . "Tahun",
                        $row->kendaraan_wilayah,
                    );
                }
                echo $this->table->generate();
                ?>
            </div>
            <div class="foot">
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#tblGlobal').DataTable();
        $('#tblKendaraan').DataTable();
    })
</script>