<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
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
                            "Rp.".number_format($row->report_total_transaksi)
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
                    $this->table->set_heading('No. STNK', 'Klien', 'Merk Kendaraan', 'Umur Kendaraan', 'Area Operasional');

                    foreach ($DaftarKendaraan as $row) {
                        $currentDate = date("Y-m-d");
                        $umur = date_diff(date_create($row->kendaraan_tanggal_beli), date_create($currentDate));
                        $klien = $this->MGeneral->getKendaraanKlien(['noRangka' => $row->kendaraan_no_rangka, 'stnk' => $row->kendaraan_stnk]);

                        $this->table->add_row(
                            $row->kendaraan_stnk,
                            !empty($klien->client_nama) ? $klien->client_nama : '-',
                            $row->kendaraan_merk,
                            $umur->format("%m") . " Bulan " . $umur->format('%y') . "Tahun",
                            !empty($klien->client_region) ? $klien->client_region : '-',
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
    $(document).ready(function(){
        $('#tblGlobal').DataTable();
        $('#tblKendaraan').DataTable();
    })
</script>