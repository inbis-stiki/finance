    
    <?php
    
        $this->load->view('_components/modal');

    ?>

    <!-- PLACE <SCRIPT> TAG HERE  -->

    <!-- Bootstrap 5.0.2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <script src="<?= site_url()?>/assets/src/js/style.js"></script>

    <!-- Datatables -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <!-- Master Region -->
    <script type="text/javascript">
        var table = $('#example');
        var modal = $('#add_masterRegion');
        var formRegion = $('#formRegion');
        var modalTitleRegion = $('#modalTitleRegion');
        var btnSaveRegion = $('#btnSaveRegion');
        $(document).ready(function() {
            loadData(); 
        } );

        function loadData() {
            table.DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?php echo site_url('admin/Master_region/get_data_region/') ?>",
                    "type": "POST"
                },
                "columnDefs": [
                {
                    "targets": [ -1 ],
                    "orderable": false
                }
                ]
            });
        }
        function addRegion() {
            formRegion.get(0).reset();
            modal.modal('show');
            modalTitleRegion.text('Tambah Region');
        }
        function saveRegion(){
            btnSaveRegion.text('Sek boss');
            btnSaveRegion.attr('disabled', true);
            url = "<?php echo site_url('add_region');?>"

            $.ajax({
                type: "post",
                url: url,
                data: formRegion.serialize(),
                success: function (response) {
                    modal.modal('hide');
                    table.ajax.reload();
                }
            });
        }
    </script>
</body>
</html>