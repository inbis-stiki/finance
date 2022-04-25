<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <!-- <p class="mb-0 fs-5 font-w-500 color-darker">
                Master Sparepart
            </p> -->
            <button type="button" class="btn-table green" data-bs-toggle="modal" data-bs-target="#add_masterSparepart">Tambah</button>
        </div>
        <div class="card-section">
            <div class="head">
                <p>Master Sparepart</p>
            </div>
            <div class="body" style="padding: 15px;">
                <?php
                $template = array('table_open' => '<table id="tableSparepart" class="table-custom">');
                $this->table->set_template($template);
                $this->table->set_heading('No', 'Nama Sparepart', 'Jenis Sparepart', 'Ukuran', 'Ideal Pemakaian', 'Keterangan', 'Aksi');

                $no = 1;
                foreach ($Sparepart as $row) {
                    if ($row->sparepart_bulan > 0) {
                        $this->table->add_row(
                            $no++,
                            $row->sparepart_nama,
                            $row->sparepart_jenis,
                            $row->sparepart_ukuran,
                            $row->sparepart_bulan . ' Bulan',
                            $row->sparepart_detail,
                            '<button type="button" data-id="' . $row->sparepart_id . '" data-nama="' . $row->sparepart_nama . '" data-jenis="' . $row->sparepart_jenis . '" data-km="' . $row->sparepart_km . '" data-bulan="' . $row->sparepart_bulan . '" data-ukuran="' . $row->sparepart_ukuran . '" data-detail="' . $row->sparepart_detail . '" class="btn-table edit_masterSparepart btnEdit" data-bs-toggle="modal" data-bs-target="#edit_masterSparepart">
                                            <span class="iconify-inline" data-icon="bx:bx-edit" data-width="20" data-height="20"></span>
                                        </button>
                                        <button type="button" data-id="' . $row->sparepart_id . '" data-nama="' . $row->sparepart_nama . '" data-jenis="' . $row->sparepart_jenis . '" data-km="' . $row->sparepart_km . '" data-bulan="' . $row->sparepart_bulan . '" class="btn-table red hapus_masterSparepart btnEdit" data-bs-toggle="modal" data-bs-target="#hapus_masterSparepart">
                                            <span class="iconify-inline" data-icon="carbon:trash-can"data-width="20" data-height="20"></span>
                                        </button>'
                        );
                    } else {
                        $this->table->add_row(
                            $no++,
                            $row->sparepart_nama,
                            $row->sparepart_jenis,
                            $row->sparepart_ukuran,
                            $row->sparepart_km . ' Km',
                            $row->sparepart_detail,
                            '<button type="button" data-id="' . $row->sparepart_id . '" data-nama="' . $row->sparepart_nama . '" data-jenis="' . $row->sparepart_jenis . '" data-km="' . $row->sparepart_km . '" data-bulan="' . $row->sparepart_bulan . '" data-ukuran="' . $row->sparepart_ukuran . '" data-detail="' . $row->sparepart_detail . '" class="btn-table edit_masterSparepart btnEdit" data-bs-toggle="modal" data-bs-target="#edit_masterSparepart">
                                            <span class="iconify-inline" data-icon="bx:bx-edit" data-width="20" data-height="20"></span>
                                        </button>
                                        <button type="button" data-id="' . $row->sparepart_id . '" data-nama="' . $row->sparepart_nama . '" data-jenis="' . $row->sparepart_jenis . '" data-km="' . $row->sparepart_km . '" data-bulan="' . $row->sparepart_bulan . '" class="btn-table red hapus_masterSparepart btnEdit" data-bs-toggle="modal" data-bs-target="#hapus_masterSparepart">
                                            <span class="iconify-inline" data-icon="carbon:trash-can"data-width="20" data-height="20"></span>
                                        </button>'
                        );
                    }
                }
                echo $this->table->generate(); ?>
            </div>
            <div class="foot">
            </div>
        </div>
        <!-- Modal Edit Sparepart -->
        <div class="modal fade" id="edit_masterSparepart" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Ubah Data Sparepart</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('master/sparepart/update'); ?>
                        <div class="pb-4">

                            <div class="d-flex flex-column my-2 w-100">
                                <label class="font-w-400 my-2 color-secondary">Nama Sparepart</label>
                                <input type="text" class="login-input regular" name="nama2" value="" required>
                                <input type="hidden" id="sparepart_id" name="sparepart_id" value="">
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="font-w-400 my-2 color-secondary">Jenis Sparepart</label>
                                <select class="login-input regular" name="jenis2" id="edt_jenis">
                                    <?php foreach ($Jenis as $row) { ?>
                                        <option value="<?= $row->dropdown_list ?>"><?= $row->dropdown_list ?></option>
                                    <?php } ?>
                                </select>
                                <!-- <input type="text" class="login-input regular" name="jenis2" value="" required> -->
                                <input type="hidden" id="sparepart_id" name="sparepart_id" value="">
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Ukuran</label>
                                <input type="text" class="login-input regular" name="ukuran2" placeholder="" required>
                            </div>
                            <div class="row m-0 p-0 w-full">
                                <label class="font-w-400 my-2 color-secondary ps-0">Ideal Penggantian</label>
                                <div class="col-6 ps-0 d-flex flex-row align-items-center">
                                    <div class="d-flex flex-row align-items-center radio-wrapper">
                                        <input type="radio" id="km2" value="km2" name="ideal2" class="pilih2" checked>
                                        <label for="km2" class="font-w-500 ms-2 me-3">Kilometer</label>
                                    </div>
                                    <input type="number" onkeypress="return isNumberKey(event)" name="km-txt2" id="pilihkm" class="login-input regular" min="0" value="">
                                </div>
                                <div class="col-6 pe-0 d-flex flex-row align-items-center">
                                    <div class="d-flex flex-row align-items-center radio-wrapper">
                                        <input type="radio" id="bulan2" value="bulan" name="ideal2" class="pilih2">
                                        <label for="bulan2" class="font-w-500 ms-2 me-3">Bulan</label>
                                    </div>
                                    <input type="number" onkeypress="return isNumberKey(event)" name="bulan-txt2" id="pilihbln" class="login-input regular" min="0" value="" disabled>
                                </div>
                            </div>
                            <div class="d-flex flex-column my-2 w-100">
                                <label class="my-2 color-secondary">Keterangan</label>
                                <textarea name="detail2" id="" cols="30" class="login-input" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="d-flex flex-row">
                            <button type="submit" class="btn-table submit-modal ms-1">Simpan</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Hapus Sparepart -->
        <div class="modal fade" id="hapus_masterSparepart" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-2">
                    <div class="modal-header">
                        <p class="font-w-700 color-darker mb-0">Hapus Sparepart</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body fs-14px pt-0 d-flex flex-column">
                        <?= form_open_multipart('master/sparepart/destroy'); ?>
                        <div class="pb-4">
                            <div class="d-flex flex-column my-2 w-100">
                                <p class="font-w-700 color-darker mb-0">Apakah anda yakin menghapus data ini ?</p>
                                <input type="hidden" id="sparepart_id" name="sparepart_id" value="">
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
        <script>
            $('#tableSparepart tbody').on('click', '.btnEdit', function() {
                const id = $(this).data('id')
                const nama = $(this).data('nama')
                const jenis = $(this).data('jenis')
                const km = $(this).data('km')
                const bulan = $(this).data('bulan')
                const ukuran = $(this).data('ukuran')
                const detail = $(this).data('detail')

                $('input[name=nama2]').val(nama);
                $('input[name=jenis2]').val(jenis);
                $('input[name=sparepart_id]').val(id);
                $('input[name=ukuran2]').val(ukuran);
                $('textarea[name=detail2]').html(detail);
                $('#edt_jenis').val(jenis).change();

                if (km != "") {
                    $('#km2').prop('checked', true)
                    $('#pilihkm').attr('disabled', false);
                    $('#pilihbln').attr('disabled', true);

                    $('#pilihkm').val(km);
                    $('#pilihbln').val("");

                } else {
                    $('#bulan2').prop('checked', true)
                    $('#pilihbln').attr('disabled', false);
                    $('#pilihkm').attr('disabled', true);

                    $('#pilihbln').val(bulan);
                    $('#pilihkm').val("");
                }
            })

            $('.pilih2').click(function() {
                const inputann = $(this).val()
                if (inputann == "km2") {
                    $('#pilihkm').attr('disabled', false)
                    $('#pilihbln').attr('disabled', true)
                } else {
                    $('#pilihkm').attr('disabled', true)
                    $('#pilihbln').attr('disabled', false)
                }
            })

            function isNumberKey(evt) {
                var charCode = (evt.which) ? evt.which : evt.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }

            $(document).ready(function() {
                $('#tableSparepart').DataTable();
            })
        </script>
        <div class="foot">
        </div>
    </div>
</div>
</div>