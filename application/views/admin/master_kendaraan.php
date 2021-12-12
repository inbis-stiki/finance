<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master Kendaraan
            </p>
            <a href="<?php echo site_url(); ?>admin/Admin/tambah_kendaraan">
                <button type="button" class="btn-table green">Tambah</button>
            </a>

        </div>
        <div class="card-section">
            <div class="body">
                <table class="table-custom" id="tblKendaraan">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'No. Rangka', 'No. STNK', 'Merk', 'Tanggal Beli', 'Umur', 'Aksi');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($Kendaraan as $row) {
                                $tgl = date_format(date_create($row->kendaraan_tanggal_beli), 'j M Y');
                                $currentDate = date("j M Y");
                                $umur = date_diff(date_create($row->kendaraan_tanggal_beli), date_create($currentDate));
                                $this->table->add_row(
                                    $no++,
                                    $row->kendaraan_no_rangka,
                                    $row->kendaraan_stnk,
                                    $row->kendaraan_merk,
                                    $tgl,
                                    $umur->format("%y") . " Tahun",
                                    '
                                    <button type="button" class="btn-table orange view_masterKendaraan" data-bs-toggle="modal" data-bs-target="#view_masterKendaraan' . $row->kendaraan_no_rangka . '" title="Foto">
                                        <span class="iconify-inline" data-icon="ic:baseline-insert-photo" data-width="20" data-height="21"></span>
                                    </button>
                                    <a href="' .  base_url("admin/ubah_kendaraan/" . $row->kendaraan_no_rangka) . '" >
                                        <button type="button" class="btn-table edit_masterKendaraan btnEdit" title="Ubah">
                                            <span class="iconify-inline" data-icon="bx:bx-edit" data-width="20" data-height="20"></span>
                                        </button>
                                    </a>'

                                );

                            ?>
                            <?php }
                            echo $this->table->generate(); ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        foreach ($Kendaraan as $i) :
            $kendaraan_no_rangka = $i->kendaraan_no_rangka;

            // $i = 0;
            $kendaraan_foto = $i->kendaraan_foto;
            $kendaraan_foto = json_decode($kendaraan_foto);
            // var_dump($kendaraan_foto);

            // if ($i++ > count($kendaraan_foto)) break;

        ?>
            <div class="modal fade" id="view_masterKendaraan<?php echo $kendaraan_no_rangka ?>" nama="view_masterKendaraan" method="POST" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content p-2">
                        <div class="modal-header">
                            <p class="font-w-700 color-darker mb-0">Foto Kendaraan</p>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row m-0 p-0 w-100">
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php $i = 0;
                                    foreach ($kendaraan_foto as $fotok) : ?>
                                        <?php if ($i == 0) : ?>
                                            <div class="carousel-item active" id="carousel1">
                                                <img class="d-block mx-auto" src="<?php echo base_url() . '/assets/images/fotokendaraan/' . $fotok ?>" width="500px" height="300px">
                                            </div>
                                        <?php else : ?>
                                            <div class="carousel-item" id="carousel2">
                                                <img class="d-block mx-auto" src="<?php echo base_url() . '/assets/images/fotokendaraan/' . $fotok ?>" width="500px" height="300px">
                                            </div>
                                    <?php endif;
                                        $i++;
                                    endforeach; ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <script type="text/javascript">
            // $('#tblRegion tbody').on('click', '.edit_masterRegion', function() {
            //     alert('oke');
            //     const region_id = $(this).data('region_id');
            //     $('#region_id').val(region_id);
            //     const region_kota = $(this).data('region_kota');
            //     $('#region_kota').val(region_id);
            // })
        </script>
        
        <!-- Image Zoom -->
        <script src="<?= site_url() ?>/assets/plugin/image-zoom/jquery.zoom.js"></script>
        <script>
            if ($ && $.fn.zoom) {
                $('#carousel1').zoom();
                $('#carousel2').zoom();
            }
        </script>

        <div class="foot">
        </div>
    </div>
</div>
</div>