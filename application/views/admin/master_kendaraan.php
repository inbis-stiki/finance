<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master Kendaraan
            </p>
            <a href="<?php echo site_url(); ?>master/kendaraan/add">
                <button type="button" class="btn-table green">Tambah</button>
            </a>

        </div>
        <?php
            if(!empty($this->session->flashdata('err_msg'))){
                echo '
                    <div class="alert alert-danger" role="alert">
                    '.$this->session->flashdata('err_msg').'
                    </div>
                ';        
            }
            if(!empty($this->session->flashdata('succ_msg'))){
                echo '
                    <div class="alert alert-success" role="alert">
                        '.$this->session->flashdata('succ_msg').'
                    </div>
                ';        
            }
        ?>
        <div class="card-section">
            <div class="body">
                <table class="table-custom" id="tblKendaraan">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table id="tableKendaraan" class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Foto', 'No. Rangka', 'No. STNK', 'Merk', 'Tanggal Beli', 'Umur', 'Aksi');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($Kendaraan as $row) {
                                $tgl = date_format(date_create($row->kendaraan_tanggal_beli), 'j M Y');
                                $currentDate = date("Y-m-d");
                                $umur = date_diff(date_create($row->kendaraan_tanggal_beli), date_create($currentDate));
                                $this->table->add_row(
                                    $no++,
                                    '
                                        <button type="button" data-id="'.$row->kendaraan_no_rangka.'|'.$row->kendaraan_stnk.'" class="btn-table orange view_masterKendaraan" title="Foto">
                                            <span class="iconify-inline" data-icon="ic:baseline-insert-photo" data-width="20" data-height="21"></span>
                                        </button>
                                    ',
                                    $row->kendaraan_no_rangka,
                                    $row->kendaraan_stnk,
                                    $row->kendaraan_merk,
                                    $tgl,
                                    $umur->format("%m") . " Bulan " . $umur->format('%y') . "Tahun",
                                    '
                                    <button type="button" data-id="' . $row->kendaraan_no_rangka . '" data-stnk="' . $row->kendaraan_stnk . '" class="btn-table green stnk_masterKendaraan btnStnk" data-bs-toggle="modal" data-bs-target="#stnk_masterKendaraan">
                                        <span class="iconify-inline" data-icon="bi:credit-card" data-width="20" data-height="20"></span>
                                    </button>
                                    <a href="' .  base_url("master/kendaraan/edit/" . str_replace(" ", "_", $row->kendaraan_no_rangka)) . '" >
                                        <button type="button" class="btn-table edit_masterKendaraan btnEdit" title="Ubah">
                                            <span class="iconify-inline" data-icon="bx:bx-edit" data-width="20" data-height="20"></span>
                                        </button>
                                    </a>
                                    '

                                );

                            ?>
                            <?php }
                            echo $this->table->generate(); ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="view_masterKendaraan" nama="view_masterKendaraan" method="POST" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Foto Kendaraan</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
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
            </div>
        </div>
        <!-- Modal Assign Kendaraan -->
        <div class="modal fade" id="stnk_masterKendaraan" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Ubah Nomor STNK</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('master/kendaraan/change-stnk'); ?>
                        <div class="pb-4">
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Nomor Rangka</label>
                                <input type="text" class="login-input regular fs-16px inptNoRangka" name="" value="" disabled>
                                <input type="hidden" class="login-input regular fs-16px inptNoRangka" name="rangka" value="">
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Nomor STNK</label>
                                <input type="text" style="text-transform:uppercase" id="inptNoSTNK" class="login-input regular fs-16px" name="stnk" value="" required>
                                <input type="hidden" style="text-transform:uppercase" id="inptNoSTNKLama" class="login-input regular fs-16px" name="stnkLama" value="" required>
                            </div>
                            <input type="hidden" class="login-input regular fs-16px" name="driver_nik">
                            <button type="submit" class="btn-table submit-modal">Simpan Data</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>
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
        <script>
            $(document).ready(function(){
                $('.carousel').carousel({
                    interval: 5000
                })
                
            })
            $('#tableKendaraan tbody').on('click', '.btnStnk', function() {
                const id = $(this).data('id')
                const stnk = $(this).data('stnk')
                $('.inptNoRangka').val(id);
                $('#inptNoSTNKLama').val(stnk);
            })
            $('#tableKendaraan tbody').on('click', '.view_masterKendaraan', function() {
                const id = $(this).data('id')
                
                $.ajax({
                    url: '<?= site_url('master/kendaraan/ajxGetKendaraan')?>',
                    method: 'post',
                    data: {id},
                    success: function(res){
                        res = JSON.parse(res)
                        let index = 0;
                        let indicators = '';
                        let carouselInner = '';
                        let status = 'active';

                        for(let i of res['kendaraan_foto']){
                            if(index != 0){
                                status = '';
                            }
                            
                            indicators += `
                                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="${index}" class="${status}"></li>
                            `;

                            carouselInner += `
                                <div class="carousel-item ${status}">
                                    <img class="d-block w-100 imgItem" style="height: 450px;width: 500px;background-size: cover;" src="${i}" alt="Second slide" alt="">
                                </div>
                            `;
                            index++
                        }
                        $('.carousel-indicators').html(indicators)
                        $('.carousel-inner').html(carouselInner)
                        $('.carousel-item').zoom({
                            on: 'grab'
                        })
                        $('#view_masterKendaraan').modal('show')
                    }
                })
            })
            
        </script>

        <div class="foot">
        </div>
    </div>
</div>
</div>