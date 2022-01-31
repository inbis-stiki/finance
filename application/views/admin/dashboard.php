<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="card-section">
            <div class="head">
                <p>Global Cost</p>
                <select name="" style="width: 30%;" class="login-input" id="">
                    <option value="Makang">Malang</option>
                </select>
            </div>
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table id="tblDashboard" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Area Operasional', 'Jumlah Transaksi', 'Total Transaksi');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($GlobalCost as $row) {
                                $this->table->add_row(
                                    $no++,
                                    $row->kendaraan_stnk,
                                    $row->kendaraan_merk,
                                    $row->umur_kendaraan
                                );

                            ?>
                            <?php }
                            echo $this->table->generate(); ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="foot">
            </div>
        </div>
        <div class="card-section">
            <div class="head">
                <p>Daftar Kendaraan</p>
            </div>
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <!-- <?php
                            $template = array('table_open' => '<table id="tblDashboard" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No','No. STNK', 'Klien', 'Merk Kendaraan', 'Umur Kendaraan', 'Area Operasional');
                            ?> -->
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                            <?php
                            $no = 1;
                            foreach ($DaftarKendaraan as $row) {
                                // $tgl = date_format(date_create($row->kendaraan_tanggal_beli), 'j M Y');
                                $this->table->add_row(
                                    $no++,
                                    $row->kendaraan_stnk,
                                    $row->kendaraan_merk,
                                    $row->umur_kendaraan,
                                    $row->pengeluaran_jenis,
                                    $row->total_transaksi
                                );

                            ?>
                            <?php }
                            echo $this->table->generate(); ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="foot">
            </div>
        </div>
    </div>
</div>