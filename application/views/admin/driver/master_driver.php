<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master Driver
            </p>
            <a href="<?= base_url('admin/tambah_driver'); ?>" class="btn-table green" type="button">Tambah</a>
            <!-- <button type="button" class="btn-table" data-bs-toggle="modal">Add</button> -->
        </div>
        <div class="card-section">
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table id="tableDriver" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Nama Driver', 'Foto Driver', 'KTP Driver', 'Alamat Driver', 'Nomor Telepon Driver', 'SIM Driver', 'Tanggal Masuk', 'Aksi');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($Driver as $row) {
                                $tanggal = date_format(date_create($row->driver_tanggalmasuk), 'j M Y');
                                $transaksiKendaraan = $this->MGeneral->get('transaksi_driverkendaraan', ['driver_nik' => $row->driver_nik, 'disabled_date' => NULL]);

                                $aksiAssign = "";
                                $kendaraan  = '-';
                                if ($transaksiKendaraan != null) {
                                    $kendaraan = '<a class="btnInfoKendaraan" data-bs-toggle="modal" data-id="' . $transaksiKendaraan[0]->kendaraan_no_rangka . '|' . $transaksiKendaraan[0]->kendaraan_stnk . '" data-bs-target="#info_kendaraan" style="color: blue;text-decoration: underline;cursor: pointer;">' . $transaksiKendaraan[0]->kendaraan_stnk . '</a>';
                                } else {
                                    $aksiAssign = '
                                        <button type="button" data-id="' . $row->driver_nik . '" class="btn-table green assign_masterDriver btnAssign" data-bs-toggle="modal" data-bs-target="#assign_masterDriver">
                                            <span class="iconify-inline" data-icon="ps:car" data-width="20" data-height="20"></span>
                                        </button>
                                    ';
                                }
                                $this->table->add_row(
                                    $no++,
                                    $row->driver_nama,
                                    '<img src="' . $row->driver_foto . '" style="width:100px">',
                                    '<img src="' . $row->driver_foto_ktp . '" style="width:100px">',
                                    $row->driver_alamat,
                                    $row->driver_telepon,
                                    implode(', ', $sims),
                                    $tanggal,

                                    '
                                    ' . $aksiAssign . '
                                    <a href="' .  base_url("master/driver/edit/" . $row->driver_nik) . '" >
                                        <button type="button" class="btn-table edit_masterDriver btnEdit">
                                            <span class="iconify-inline" data-icon="bx:bx-edit" data-width="20" data-height="20"></span>
                                        </button>
                                    </a>
                                    <button type="button" data-id="' . $row->driver_nik . '" class="btn-table red hapus_masterDriver btnHapus" data-bs-toggle="modal" data-bs-target="#hapus_masterDriver">
                                        <span class="iconify-inline" data-icon="carbon:trash-can"data-width="20" data-height="20"></span>
                                    </button>'
                                );
                            ?>
                            <?php }
                            echo $this->table->generate(); ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Hapus Driver -->
        <div class="modal fade" id="hapus_masterDriver" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Hapus Driver</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('admin/Driver/aksiHapus'); ?>
                        <div class="pb-4">
                            <div class="d-flex flex-column my-2 w-100">
                                <p class="font-w-700 color-darker mb-0">Apakah anda yakin menghapus data ini ?</p>
                                <input type="hidden" id="driver_nik" name="driver_nik" value="">
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <button type="submit" class="btn-table submit-modal ms-1">Hapus</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Assign Kendaraan -->
        <div class="modal fade" id="assign_masterDriver" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Assign Kendaraan</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('master/driver/assign'); ?>
                        <div class="pb-4">
                            <!-- <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Awal Pemakaian</label>
                                <input type="date" class="login-input regular fs-16px" name="awal" id="datepicker" value="" required>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Selesai Pemakaian</label>
                                <input type="date" class="login-input regular fs-16px" name="akhir" id="datepicker" value="" required>
                            </div> -->
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Kendaraan</label>
                                <select name="kendaraan" class="login-input regular" required>
                                    <?php
                                    foreach ($Kendaraan as $item) {
                                        $tranRemaining = $this->MGeneral->get('transaksi_driverkendaraan', ['kendaraan_no_rangka' => $item->kendaraan_no_rangka, 'kendaraan_stnk' => $item->kendaraan_stnk, 'disabled_date' => NULL]);
                                        if ($tranRemaining == null) {
                                            echo '
                                                    <option value="' . $item->kendaraan_no_rangka . '|' . $item->kendaraan_stnk . '">' . $item->kendaraan_stnk . '</option>
                                                ';
                                        }
                                    }
                                    ?>
                                </select>
                                <!-- <input type="" class="login-input regular" name="menu" value="Wilayah" disabled> -->
                            </div>

                            <input type="hidden" class="login-input regular fs-16px" name="driver_nik">
                            <button type="submit" class="btn-table submit-modal">Simpan Data</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Info Kendaraan -->
        <div class="modal fade" id="info_kendaraan" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Info Kendaraan</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <div class="pb-4">

                            <div class="row">
                                <div class="col">
                                    <div class="d-flex flex-column my-2 w-100 col-md-6">
                                        <label class="my-2 color-secondary">Foto Kendaraan</label>
                                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                            <ol class="carousel-indicators">
                                            </ol>
                                            <div class="carousel-inner">
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only"></span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                                <label class="my-2 color-secondary">Nomor Rangka</label>
                                                <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_rangka" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                                <label class="my-2 color-secondary">Nomor STNK</label>
                                                <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_stnk" value="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                                <label class="my-2 color-secondary">Merk</label>
                                                <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_merk" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                                <label class="my-2 color-secondary">Kapasitas Tangki</label>
                                                <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_kapasitas" value="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                                <label class="my-2 color-secondary">Tanggal Jatuh SIM</label>
                                                <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_tgljatuhsim" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                                <label class="my-2 color-secondary">Tanggal Jatuh KIR</label>
                                                <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_tgljatuhkir" value="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                                <label class="my-2 color-secondary">Pemilik</label>
                                                <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_pemilik" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="d-flex flex-column my-2 w-100 col-md-6">
                                                <label class="my-2 color-secondary">Umur</label>
                                                <input type="text" class="login-input regular fs-16px" name="" id="kendaraan_umur" value="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="login-input regular fs-16px" name="driver_nik">
                            <button class="btn-table submit-modal mt-5" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#tableDriver tbody').on('click', '.btnHapus', function() {
                const id = $(this).data('id')

                $('input[name=driver_nik]').val(id);
            })
            $('#tableDriver tbody').on('click', '.btnAssign', function() {
                const id = $(this).data('id')
                $('input[name=driver_nik]').val(id);
            })
            $('#tableDriver tbody').on('click', '.btnInfoKendaraan', function() {
                const id = $(this).data('id')
                $.ajax({
                    url: '<?= site_url('master/kendaraan/ajxGet') ?>',
                    method: 'post',
                    data: {
                        id
                    },
                    success: function(res) {
                        res = JSON.parse(res)
                        res['kendaraan_jenis'] = res['kendaraan_jenis'] == "Perusahaan" ? `${res['kendaraan_pt']}` : res['kendaraan_jenis'];

                        tglJatuhSim = new Date(res['kendaraan_deadlinesim']);
                        tglJatuhSim = `${tglJatuhSim.getDay()} ${getFullMonth(tglJatuhSim.getMonth())} ${tglJatuhSim.getFullYear()}`;

                        tglJatuhKIR = new Date(res['kendaraan_deadlinekir']);
                        tglJatuhKIR = `${tglJatuhKIR.getDay()} ${getFullMonth(tglJatuhKIR.getMonth())} ${tglJatuhKIR.getFullYear()}`;

                        $('#kendaraan_rangka').val(res['kendaraan_no_rangka']);
                        $('#kendaraan_stnk').val(res['kendaraan_stnk']);
                        $('#kendaraan_merk').val(res['kendaraan_merk']);
                        $('#kendaraan_pemilik').val(res['kendaraan_jenis']);
                        $('#kendaraan_tgljatuhsim').val(tglJatuhSim);
                        $('#kendaraan_tgljatuhkir').val(tglJatuhKIR);
                        $('#kendaraan_umur').val(res['umur']);
                        $('#kendaraan_kapasitas').val(res['kendaraan_kapasitas_tangki'] + " Liter");

                        let index = 0;
                        let indicators = '';
                        let carouselInner = '';
                        let status = 'active';

                        for (let i of res['kendaraan_foto']) {
                            if (index != 0) {
                                status = '';
                            }

                            indicators += `
                                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="${index}" class="${status}"></li>
                            `;

                            carouselInner += `
                                <div class="carousel-item ${status}">
                                    <img class="d-block imgItem" style="height: 312px;width: 600px;background-size: cover;" src="<?= site_url('') ?>assets/images/fotokendaraan/${i}" alt="Second slide" alt="">
                                </div>
                            `;
                            index++
                        }
                        $('.carousel-indicators').html(indicators)
                        $('.carousel-inner').html(carouselInner)
                        $('.carousel-item').zoom({
                            on: 'grab'
                        })

                        $('#boxInfoKendaraan').attr('hidden', false);
                    }
                })
            })
        </script>
        <div class="foot">
        </div>
    </div>
</div>
</div>