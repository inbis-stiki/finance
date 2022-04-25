<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
    <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Laporan Harian
            </p>
            <a href="<?php echo site_url(); ?>" style="padding-left: 760px;">
                <button type="button" class="btn-table red">
                    <span class="iconify-inline" data-icon="uiw:file-pdf" data-width="20" data-height="20"></span>
                    <span> Cetak PDF</span>
                </button>
                <button type="button" class="btn-table green">
                    <span class="iconify-inline" data-icon="file-icons:microsoft-excel" data-width="20" data-height="20"></span>
                    <span> Cetak Excel</span>
                </button>
            </a>

        </div>
        <?php
        if (!empty($this->session->flashdata('err_msg'))) {
            echo '
                    <div class="alert alert-danger" role="alert">
                    ' . $this->session->flashdata('err_msg') . '
                    </div>
                ';
        }
        if (!empty($this->session->flashdata('succ_msg'))) {
            echo '
                    <div class="alert alert-success" role="alert">
                        ' . $this->session->flashdata('succ_msg') . '
                    </div>
                ';
        }
        ?>
        <div class="card-section">
            <div class="head">
                <p>Administrasi</p>
                <div  style="padding-left: 520px;" class="form-group">
                    <label for="">Tanggal</label>
                    <input class="form-control inptDate" type="text" style="width: 150px;">
                </div>
            </div>
            <div class="body" style="padding: 15px;" id="">
                <?php
                $template = array('table_open' => '<table id="tblHarian" class="table-custom border="0">');
                $this->table->set_template($template);
                $this->table->set_heading('No', 'Tanggal', 'Nomor Polisi', 'Pengeluaran', 'Total Biaya');
            
                echo $this->table->generate(); ?>
            </div>
            <div class="foot">
            </div>
        </div>
        </div>
        <script>
            $(document).ready(function(){
                $('.inptDate').flatpickr({
                    dateFormat: "j F Y",
                })
            })
        //     var tblHarian = $('#tblHarian').DataTable({
        //     'processing': true,
        //     'serverSide': true,
        //     'ordering': false,
        //     'searching': false,
        //     'serverMethod': 'post',
        //     'ajax': {
        //         'url':'<?= site_url('management/ajxUpdateSparepart')?>',
        //         'data': {
        //             'month': $('#filHarian1').val(),
        //             'year': $('#filHarian2').val()
        //         }
        //     },
        //     'columns': [
        //         { data: 'detail' },
        //         { data: 'detail' },
        //         { data: 'detail' },
        //         { data: 'detail' },
        //         { data: 'detail' },
        //         { data: 'detail' },
        //         { data: 'detail' },
        //         { data: 'detail' },
        //         { data: 'jumlah' }
        //     ]
        // });

            $('.filJenisBiayaSparepart').change(function(){
        const month = $('#filJenisBiayaSparepart1').val()
        const year = $('#filJenisBiayaSparepart2').val()
        $.ajax({
            url: '<?= site_url('management/ajxUpdateJenisPengeluaran')?>',
            method: 'POST',
            data: {month, year},
            success: function(res){
                res = JSON.parse(res)
                
                data = []
                categories = []

                for(let i of res){
                    data.push((i.total_jenis_pengeluaran / 1000000).toFixed(2))
                    categories.push(i.pengeluaran_group)
                }
                var updateOptions3 = {
                    chart: {
                        type: 'bar',
                        height: '300px'
                    },
                    series: [{
                        name: 'sales',
                        data
                    }],
                    colors: ['#4F48ED'],
                    xaxis: {
                        categories
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return value.toFixed(2)+" Jt";
                            }
                        },
                    },
                    dataLabels: {
                        enabled: true,
                    },
                }
                $('#chart_jenis').empty()
                var updateChart3 = new ApexCharts(document.querySelector("#chart_jenis"), updateOptions3);
                updateChart3.render();
            }
        })
    })

            function getFullMonthh (month){
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

        <div class="foot">
        </div>
    </div>
</div>
</div>