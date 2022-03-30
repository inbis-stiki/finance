
<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
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