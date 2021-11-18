<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
        <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Master Sparepart
            </p>
            <button type="button" class="btn-table" data-bs-toggle="modal" data-bs-target="#add_masterSparepart">Add</button>
        </div>
        <div class="card-section">
            <div class="body">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <?php
                            $template = array('table_open' => '<table class="table-custom">');
                            $this->table->set_template($template);
                            $this->table->set_heading('No', 'Jenis Sparepart', 'Ideal Pemakaian', 'Action');
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $no = 1;
                            foreach ($Sparepart as $row) {
                                if ($row->sparepart_bulan > 0) {
                                    $this->table->add_row(
                                        $no++,
                                        $row->sparepart_nama,
                                        $row->sparepart_bulan . ' Bulan',
<<<<<<< Updated upstream
                                        '<button type="button" class="btn-table green" data-bs-toggle="modal" data-bs-target="#edit_masterSparepart">
=======
                                        '<button type="button" class="btn-table green edit_masterSparepart" data-bs-toggle="modal" data-bs-target="#edit_masterSparepart' . $row->sparepart_id . '">
>>>>>>> Stashed changes
                                            Edit
                                        </button>'
                                    );
                                } else {
                                    $this->table->add_row(
                                        $no++,
                                        $row->sparepart_nama,
                                        $row->sparepart_km . ' Km',
<<<<<<< Updated upstream
                                        '<button type="button" class="btn-table green" data-bs-toggle="modal" data-bs-target="#edit_masterSparepart">
=======
                                        '<button type="button" class="btn-table green edit_masterSparepart" data-bs-toggle="modal" data-bs-target="#edit_masterSparepart' . $row->sparepart_id . '">
>>>>>>> Stashed changes
                                            Edit
                                        </button>'
                                    );
                                }

                            ?>
                            <?php }
                            echo $this->table->generate(); ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="foot">
        </div>
    </div>
</div>
</div>