<div class="min-vh-100 general-padding bg-light-purple">
    <div class="p-5">
    <div class="d-flex flex-row justify-content-between align-items-center mb-4">
            <p class="mb-0 fs-5 font-w-500 color-darker">
                Laporan Transaksi
            </p>
            

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
            <div class="row">
                <div class="col">
                    <div class="card-section">
                        <div class="head">
                            <p>Harian</p>
                        </div>
                        <div class="body" style="padding: 15px 15px 0px 15px;" id="">
                            <form action="<?= site_url('admin/report/main')?>" method="POST">
                                <div class="form-group mb-3">
                                    <label for="">Jenis Transaksi</label>
                                    <select name="jenis" id="" class="form-control" required>
                                        <option value="" selected disabled>Pilih</option>
                                        <option value="1">Administrasi</option>
                                        <option value="2">Maintenance</option>
                                        <option value="3">Expense</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Tanggal</label>
                                    <input class="form-control inptDate" name="tgl" type="text" value="<?= date('j F Y')?>" required>
                                </div>
                                <input type="hidden" name="period" value="3">
                                <button style="width: 100%;" type="submit" class="btn-table red">
                                    <span class="iconify-inline" data-icon="uiw:file-pdf" data-width="20" data-height="20"></span>
                                    <span>Cetak PDF</span>
                                </button>
                            </form>
                        </div>
                        <div class="foot">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card-section">
                        <div class="head">
                            <p>Mingguan</p>
                        </div>
                        <div class="body" style="padding: 15px 15px 0px 15px;" id="">
                            <form action="<?= site_url('admin/report/main')?>" method="POST">
                                <div class="form-group mb-3">
                                    <label for="">Jenis Transaksi</label>
                                    <select name="jenis" id="" class="form-control" required>
                                        <option value="" selected disabled>Pilih</option>
                                        <option value="1">Administrasi</option>
                                        <option value="2">Maintenance</option>
                                        <option value="3">Expense</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Tanggal</label>
                                    <input class="form-control inptRange" type="text" name="tgl" value="<?= date('j F Y')." to ".date('j F Y')?>" required>
                                </div>
                                <input type="hidden" name="period" value="2">
                                <button style="width: 100%;" type="submit" class="btn-table red">
                                    <span class="iconify-inline" data-icon="uiw:file-pdf" data-width="20" data-height="20"></span>
                                    <span>Cetak PDF</span>
                                </button>
                            </form>
                        </div>
                        <div class="foot">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card-section">
                        <div class="head">
                            <p>Bulanan</p>
                        </div>
                        <div class="body" style="padding: 15px 15px 0px 15px;" id="">
                            <form action="<?= site_url('admin/report/main')?>" method="POST">
                                <div class="form-group mb-3">
                                    <label for="">Jenis Transaksi</label>
                                    <select name="jenis" id="" class="form-control" required>
                                        <option value="" selected disabled>Pilih</option>
                                        <option value="1">Administrasi</option>
                                        <option value="2">Maintenance</option>
                                        <option value="3">Expense</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Bulan</label>
                                    <input class="form-control inptMonth" name="tgl" value="<?= date('F Y')?>" type="text" required>
                                </div>
                                <input type="hidden" name="period" value="1">
                                <button style="width: 100%;" type="submit" class="btn-table red">
                                    <span class="iconify-inline" data-icon="uiw:file-pdf" data-width="20" data-height="20"></span>
                                    <span>Cetak PDF</span>
                                </button>
                            </form>
                        </div>
                        <div class="foot">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('.inptDate').flatpickr({
                    dateFormat: "j F Y",
                })
                $('.inptRange').flatpickr({
                    dateFormat: "j F Y",
                    mode: "range"
                })
                $('.inptWeek').flatpickr({
                    "plugins": [new weekSelect({})],
                    "onChange": [function(){
                        // extract the week number
                        // note: "this" is bound to the flatpickr instance
                        const weekNumber = this.selectedDates[0]
                            ? this.config.getWeek(this.selectedDates[0])
                            : null;

                        console.log(weekNumber);
                    }]
                })

                $('.inptMonth').flatpickr({
                    plugins: [
                        new monthSelectPlugin({
                        shorthand: true, //defaults to false
                        dateFormat: "F Y", //defaults to "F Y"
                        altFormat: "F Y", //defaults to "F Y"
                        theme: "dark" // defaults to "light"
                        })
                    ]
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