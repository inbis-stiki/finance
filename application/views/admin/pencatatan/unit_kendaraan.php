<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <?php echo validation_errors(); ?>
        <?= form_open_multipart('admin/Unit_kendaraan/add_kendaraan'); ?>
        <p class="mb-3 fs-5 font-w-500 color-darker">
            Transaksi Peminjaman
        </p>
        <div class="card-section">
            <div class="head">
                <p>Area Operasional</p>
            </div>
            <div class="body form">
                <div class="col-12 col-lg-12 pe-0 d-flex flex-column justify-content-between">
                    <label class="mb-3">Kendaraan</label>
                    <select name="kendaraan" class="form-control" required>

                        <option value="" disabled selected>Pilih Kendaraan</option>
                        <?php foreach ($datakendaraan as $key) : ?>
                            <option value="<?php echo $key->kendaraan_no_rangka ?>|<?php echo $key->kendaraan_stnk ?>"><?php echo $key->kendaraan_stnk ?></option>
                        <?php endforeach ?>
                    </select>
                    <label class="my-3">Kota</label>
                    <select name="kota" class="form-control" required>

                        <option value="" disabled selected>Pilih Kota</option>
                        <?php foreach ($datakota as $key) : ?>
                            <option value="<?php echo $key->region_id ?>"><?php echo $key->region_kota ?></option>
                        <?php endforeach ?>
                    </select>
                    <label class="my-3">Instansi</label>
                    <select name="instansi" class="form-control" required>

                        <option value="" disabled selected>Pilih Instansi</option>
                        <?php foreach ($datainstansi as $key) : ?>
                            <option value="<?php echo $key->client_id ?>"><?php echo $key->client_nama ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="row m-0 p-0 w-100">
                        <div class="col-12 col-lg-6 ps-0">
                            <label class="my-3">Tanggal Awal Transaksi</label>
                            <input type="date" class="login-input regular col-xl-6" name="tanggal_start" id="datepicker" required>
                        </div>
                        <div class="col-12 col-lg-6 pe-0">
                            <label class="my-3">Tanggal Akhir Transaksi</label>
                            <input type="date" class="login-input regular col-xl-6" name="tanggal_end" id="datepicker" required>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <button type="submit" class="btn-table submit-modal">
            Kirim Data
        </button>
        <?= form_close(); ?>
    </div>
</div>

<?php if ((($this->session->flashdata('sukses'))) && $this->session->flashdata('sukses') != "") { ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#success').modal('show');
        });
    </script>

<?php } ?>