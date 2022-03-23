    <?php

    $this->load->view('_components/modal');

    ?>

    <!-- PLACE <SCRIPT> TAG HERE  -->

    <!-- Bootstrap 5.0.2 JS -->
    
    <script src="<?= site_url() ?>/assets/src/js/style.js"></script>
    <script src="<?= site_url() ?>/assets/src/js/autonumeric.js"></script>
    <script src="<?= site_url() ?>/assets/plugin/image-zoom/jquery.zoom.js"></script>
    <script>
        $(document).ready(function(){
            <?php
                if($this->session->flashdata('succ_modal')){
                    echo '
                        $("#success").modal("show");
                    ';
                }
            ?>
        })
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function addCommaNumeric(evt) {
            $(evt.target).val(function(index, value) {
                return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });
        }
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
        function preventSpace(evt){
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if(charCode == 32){
            return false
            }
            return true
        }
        $(".inpt-number").autoNumeric('init', {
            aSep: '.', 
            aDec: ',',
            aForm: true,
            vMax: '999999999',
            vMin: '-999999999'
        });

        const getFullMonth = month => {
            switch (month) {
                case 0:
                    return 'Januari'
                    break;
                case 1:
                    return 'Februari'
                    break;
                case 2:
                    return 'Maret'
                    break;
                case 3:
                    return 'April'
                    break;
                case 4:
                    return 'Mei'
                    break;
                case 5:
                    return 'Juni'
                    break;
                case 6:
                    return 'Juli'
                    break;
                case 7:
                    return 'Agustus'
                    break;
                case 8:
                    return 'September'
                    break;
                case 9:
                    return 'Oktober'
                    break;
                case 10:
                    return 'November'
                    break;
                case 11:
                    return 'Desember'
                    break;
                default:
                    break;
            }
        }
    </script>
        
    </body>

    </html>
