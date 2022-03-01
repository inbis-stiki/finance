<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Detail Cost Kendaraan | <?= $noSTNK?>
            </p>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-section">
                    <div class="head">
                        <p>Administrasi</p>
                    </div>
                    <div class="body" style="padding: 15px">
                        <table id="tblAdministrasi" class="table-custom">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tgl Transaksi</th>
                                    <th>Jenis Pengeluaran</th>
                                    <th>Total Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    foreach ($administrasi as $item) {
                                        $date = date_format(date_create($item->tanggal_transaksi), 'j F Y');
                                        echo '
                                            <tr>
                                                <td>'.$no++.'</td>
                                                <td>'.$date.'</td>
                                                <td>'.$item->jenis_pengeluaran.'</td>
                                                <td>Rp.'.number_format($item->total_biaya).'</td>
                                            </tr>
                                        ';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="foot">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-section">
                    <div class="head">
                        <p>Maintenance</p>
                    </div>
                    <div class="body" style="padding: 15px">
                        <table id="tblMaintenance" class="table-custom">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tgl Service</th>
                                    <th>Jenis Pengeluaran</th>
                                    <th>Jenis Sparepart</th>
                                    <th>Merek</th>
                                    <th>Nomor Seri</th>
                                    <th>Pemakaian</th>
                                    <th>Jumlah</th>
                                    <th>Total Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    foreach ($maintenance as $item) {
                                        $date = date_format(date_create($item->tanggal_service), 'j F Y');
                                        echo '
                                            <tr>
                                                <td>'.$no++.'</td>
                                                <td>'.$date.'</td>
                                                <td>'.$item->jenis_pengeluaran.'</td>
                                                <td>'.$item->jenis_sparepart.'</td>
                                                <td>'.$item->merek.'</td>
                                                <td>'.$item->nomor_seri.'</td>
                                                <td>'.number_format($item->pemakaian).'</td>
                                                <td>'.number_format($item->jumlah).'</td>
                                                <td>Rp.'.number_format($item->total_biaya).'</td>
                                            </tr>
                                        ';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="foot">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card-section">
                    <div class="head">
                        <p>Expense</p>
                    </div>
                    <div class="body" style="padding: 15px">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="bbm-tab" data-bs-toggle="tab" data-bs-target="#bbm" type="button" role="tab" aria-controls="home" aria-selected="true">BBM</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="driver-tab" data-bs-toggle="tab" data-bs-target="#driver" type="button" role="tab" aria-controls="driver" aria-selected="false">Driver</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="lain-tab" data-bs-toggle="tab" data-bs-target="#lain" type="button" role="tab" aria-controls="lain" aria-selected="false">Lain - Lain</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="myTabContent">
                            <div class="tab-pane fade show active" id="bbm" role="tabpanel" aria-labelledby="bbm-tab">
                                <table id="tblBBM" class="table-custom">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tgl Service</th>
                                            <th>Total Biaya</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($bbm as $item) {
                                                $date = date_format(date_create($item->tanggal_service), 'j F Y');
                                                echo '
                                                    <tr>
                                                        <td>'.$no++.'</td>
                                                        <td>'.$date.'</td>
                                                        <td>Rp.'.number_format($item->total_biaya).'</td>
                                                        <td>'.$item->catatan.'</td>
                                                    </tr>
                                                ';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="driver" role="tabpanel" aria-labelledby="driver-tab">
                                <table id="tblDriver" class="table-custom">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tgl Service</th>
                                            <th>Total Hari Masuk</th>
                                            <th>Total Biaya</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($driver as $item) {
                                                $date = date_format(date_create($item->tanggal_service), 'j F Y');
                                                echo '
                                                    <tr>
                                                        <td>'.$no++.'</td>
                                                        <td>'.$date.'</td>
                                                        <td>'.number_format($item->total_hari_masuk).'</td>
                                                        <td>Rp.'.number_format($item->total_biaya).'</td>
                                                    </tr>
                                                ';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="lain" role="tabpanel" aria-labelledby="lain-tab">
                                <table id="tblLain" class="table-custom">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tgl Service</th>
                                            <th>Keterangan</th>
                                            <th>Jumlah</th>
                                            <th>Total Biaya</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach ($lain as $item) {
                                                $date = date_format(date_create($item->tanggal_service), 'j F Y');
                                                echo '
                                                    <tr>
                                                        <td>'.$no++.'</td>
                                                        <td>'.$date.'</td>
                                                        <td>'.$item->keterangan.'</td>
                                                        <td>'.number_format($item->jumlah).'</td>
                                                        <td>Rp.'.number_format($item->total_biaya).'</td>
                                                    </tr>
                                                ';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="foot">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= site_url() ?>/assets/src/js/apexchart.js"></script>
<script>
    $(document).ready(function(){
        $('#tblAdministrasi').DataTable();
        $('#tblMaintenance').DataTable();
        $('#tblExpense').DataTable();
        $('#tblBBM').DataTable();
        $('#tblDriver').DataTable();
        $('#tblLain').DataTable();
    })
</script>