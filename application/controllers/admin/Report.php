<?php
// use TCPDF;
class MyPDF extends TCPDF{
    public function Header() {
        // Logo
        // $image_file = K_PATH_IMAGES.'logo_example.jpg';
        // $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->setCellMargins(0, 10, 0, 0);
        $this->Cell(0, 15, 'Laporan Transaksi '.$this->HeaderTitle, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(10);
        $this->Cell(0, 15, $this->HeaderTitle2, 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
    public function setTableConf(){
        // Colors, line width and bold font
        $this->SetFillColor(0, 112, 192);
        $this->SetTextColor(255);
        $this->SetDrawColor(56, 56, 56);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B', 10);
    }
    public function setTableAdm($header,$data) {
        $this->setTableConf();
        $this->Ln(10);
        // Header
        $w = array(10, 30, 35, 35, 50);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('', '', 10);
        // Data
        $fill = 0;
        $no = 1;
        $total = 0;
        foreach ($data as $item) {
            $total += (int)$item->total_biaya;
            $this->Cell($w[0], 6, $no++, 'L', 0, 'C', $fill);
            $this->Cell($w[1], 6, date_format(date_create($item->transaksi_tanggal), 'd/m/Y'), 'L', 0, 'C', $fill);
            $this->Cell($w[2], 6, $item->kendaraan_stnk, 'L', 0, 'C', $fill);
            $this->Cell($w[3], 6, $item->pengeluaran, 'L', 0, 'C', $fill);
            $this->Cell($w[4], 6, number_format($item->total_biaya),'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }

        $this->setTableConf();
        $this->Cell(array_sum($w), 6, "Total: Rp.".number_format($total), 1, 0, 'R', 1);
    }
    public function setTableMain($header,$data) {
        $this->setTableConf();
        $this->Ln(10);
        // Header
        $w = array(10, 30, 35, 35, 35, 35, 25, 35, 40);
        $num_headers = count($header);
        $first = 1;
        for($i = 0; $i < $num_headers; ++$i) {
            if($first++ == 1){
                $this->setCellMargins(-5, 0, 0, 0);
            }else{
                $this->setCellMargins(0, 0, 0, 0);
            }
            
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('', '', 10);
        // Data
        $fill = 0;
        $no = 1;

        $total = 0;
        foreach ($data as $item) {
            $total += (int)$item->total_biaya;
            $harga = (int)$item->total_biaya / (int)$item->jumlah;

            $cellcount = array();
            //write text first
            $startX = $this->GetX();
            $startY = $this->GetY();
            //draw cells and record maximum cellcount
            //cell height is 6 and width is 80
     
            $cellcount[] = $this->MultiCell($w[0], 6, $no++, 0, 'C',$fill,0);
            $cellcount[] = $this->MultiCell($w[1], 6, date_format(date_create($item->transaksi_tanggal), 'd/m/Y'), 0, 'C',$fill,0);
            $cellcount[] = $this->MultiCell($w[2], 6, $item->kendaraan_stnk, 0, 'C',$fill,0);
            $cellcount[] = $this->MultiCell($w[3], 6, $item->sparepart_nama, 0, 'L',$fill,0);
            $cellcount[] = $this->MultiCell($w[4], 6, $item->transaksi_detail, 0, 'L',$fill,0);
            $cellcount[] = $this->MultiCell($w[5], 6, $item->transaksi_keterangan, 0, 'L',$fill,0);
            $cellcount[] = $this->MultiCell($w[6], 6, $item->transaksi_jumlah, 0, 'C',$fill,0);
            $cellcount[] = $this->MultiCell($w[7], 6, number_format($harga), 0, 'R',$fill,0);
            $cellcount[] = $this->MultiCell($w[8], 6, number_format($item->total_biaya), 0, 'R',$fill,0);
            $this->SetXY($startX,$startY);
            
            $maxnocells = max($cellcount);
            $in = 0;
            for($i = 0; $i < 9; $i++) {
                $this->MultiCell($w[$i], $maxnocells * 6,'','LR','L',$fill,0);
                $in++;
            }

            $this->Ln();
            $fill=!$fill;
        }

        $this->setTableConf();
        $this->Cell(array_sum($w), 6, "Total: Rp.".number_format($total), 1, 0, 'R', 1);
    }
}
class Report extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('dateformat');
    }
    public function main(){
        if($_POST['jenis'] == '1'){
            $this->administrasi($_POST['period'], $_POST['tgl']);
        }else if($_POST['jenis'] == '2'){
            $this->maintenance($_POST['period'], $_POST['tgl']);
        }
    }
    public function administrasi($filter, $tgl){
        $pdf = new MyPDF('Potrait', PDF_UNIT, "A4", true, 'UTF-8', false);
        $pdf->HeaderTitle = 'Administrasi';

        $data = "";
        if($filter == '1'){
            $date  = explode(' ', $tgl);
            $month = date_create($date[0]);
            $data = $this->getDataAdm(['filter' => '1', 'month' => date_format($month, 'n'), 'year' => $date[1]]);
            $pdf->HeaderTitle2 = $tgl;
        }else if($filter == '2'){
            $date       = explode(' to ', $tgl);
            $startDate  = date_create($date[0]);
            $endDate    = date_create($date[1]);
            $data = $this->getDataAdm(['filter' => '2', 'start' => date_format($startDate, 'Y-m-d'), 'end' => date_format($endDate, 'Y-m-d')]);
            $pdf->HeaderTitle2 = date_format($startDate, 'd-m-Y')." - ".date_format($endDate, 'd-m-Y');
        }else if($filter == '3'){
            $date = date_create($tgl);
            $data = $this->getDataAdm(['filter' => '3', 'date' => date_format($date, 'Y-m-d')]);
            $pdf->HeaderTitle2 = date_format($date, 'j F Y');
        }

        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(23, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // add a page
        $pdf->AddPage();
        $header = array('No', 'Tanggal', 'Nomor Polisi', 'Pengeluaran', 'Total Biaya');
        $pdf->setTableAdm($header, $data);
        $pdf->Output('Laporan_Administrasi_Tanggal_'.$this->dateformat->getFullMonth(date('d-m-Y')).'.pdf', 'I');
    }
    public function maintenance($filter, $tgl){
        $pdf = new MyPDF('Landscape', PDF_UNIT, "A4", true, 'UTF-8', false);
        $pdf->HeaderTitle = 'Maintenance';

        $data = "";
        if($filter == '1'){
            $date  = explode(' ', $tgl);
            $month = date_create($date[0]);
            $data = $this->getDataMain(['filter' => '1', 'month' => date_format($month, 'n'), 'year' => $date[1]]);
            $pdf->HeaderTitle2 = $tgl;
        }else if($filter == '2'){
            $date       = explode(' to ', $tgl);
            $startDate  = date_create($date[0]);
            $endDate    = date_create($date[1]);
            $data = $this->getDataMain(['filter' => '2', 'start' => date_format($startDate, 'Y-m-d'), 'end' => date_format($endDate, 'Y-m-d')]);
            $pdf->HeaderTitle2 = date_format($startDate, 'd-m-Y')." - ".date_format($endDate, 'd-m-Y');
        }else if($filter == '3'){
            $date = date_create($tgl);
            $data = $this->getDataMain(['filter' => '3', 'date' => date_format($date, 'Y-m-d')]);
            $pdf->HeaderTitle2 = date_format($date, 'j F Y');
        }

        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(7, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // add a page
        $pdf->AddPage();
        $header = array('No', 'Tanggal', 'Nomor Polisi', 'Sparepart', 'Toko', 'Keterangan', 'Jumlah', 'Harga', 'Total Biaya');
        $pdf->setTableMain($header, $data);
        // $pdf->Ln(10);
        // $pdf->writeHTML($this->setTablee());
        $pdf->Output('Laporan_Maintenance_Tanggal_'.$this->dateformat->getFullMonth(date('d-m-Y')).'.pdf', 'I');
    }
    public function getDataAdm($param){
        $filter = "";
        if($param['filter'] == '1'){ // getByMonth
            $filter = '
                YEAR(t.transaksi_tanggal) = "'.$param['year'].'"
                AND MONTH(t.transaksi_tanggal) = "'.$param['month'].'"
            ';
        }else if($param['filter'] == "2"){
            $filter = '
                t.transaksi_tanggal >= "'.$param['start'].'"
                AND t.transaksi_tanggal <= "'.$param['end'].'"
            ';
        }else if($param['filter'] == "3"){
            $filter = '
                t.transaksi_tanggal = "'.$param['date'].'"
            ';
        }

        return $this->db->query('
            SELECT
                t.*,
                mjp.pengeluaran_group as jenis_pengeluaran,
                mjp.pengeluaran_jenis as pengeluaran,
                SUM(t.transaksi_jumlah) as jumlah,
                SUM(t.transaksi_total) as total_biaya
            FROM transaksi t , master_jenis_pengeluaran mjp 
            WHERE
                '.$filter.'
                AND t.id_pengeluaran = mjp.pengeluaran_id
                AND mjp.pengeluaran_group = "Administrasi"
            GROUP BY 
                t.no_rangka,
                t.kendaraan_stnk,
                mjp.pengeluaran_jenis,
                t.transaksi_tanggal
            ORDER BY t.transaksi_tanggal DESC
        ')->result();
    }
    public function getDataMain($param){
        $filter = "";
        if($param['filter'] == '1'){ // getByMonth
            $filter = '
                YEAR(t.transaksi_tanggal) = "'.$param['year'].'"
                AND MONTH(t.transaksi_tanggal) = "'.$param['month'].'"
            ';
        }else if($param['filter'] == "2"){
            $filter = '
                t.transaksi_tanggal >= "'.$param['start'].'"
                AND t.transaksi_tanggal <= "'.$param['end'].'"
            ';
        }else if($param['filter'] == "3"){
            $filter = '
                t.transaksi_tanggal = "'.$param['date'].'"
            ';
        }

        return $this->db->query('
            SELECT 
                t.* ,
                ms.* ,
                mjp.pengeluaran_group as jenis_pengeluaran,
                mjp.pengeluaran_jenis as pengeluaran,
                SUM(t.transaksi_jumlah) as jumlah,
                SUM(t.transaksi_total) as total_biaya
            FROM 
                transaksi t , 
                master_jenis_pengeluaran mjp, 
                master_sparepart ms 
            WHERE
                '.$filter.'
                AND t.id_pengeluaran = mjp.pengeluaran_id
                AND mjp.pengeluaran_group = "Maintenance"
                AND t.id_sparepart = ms.sparepart_id 
            GROUP BY 
                t.transaksi_keterangan ,
                t.id_sparepart ,
                t.no_rangka ,
                t.kendaraan_stnk ,
                t.transaksi_tanggal      
            ORDER BY t.transaksi_tanggal DESC  
        ')->result();
    }
    public function setTablee(){
        return '
            <table style="margin-top: 10px;">
                <thead>
                    <tr height="100px">
                        <th style="border: 1px solid #000;text-align: center;padding: 5px;background: #0070c0;" width="50px">No</th>
                        <th style="border: 1px solid #000;text-align: center;padding: 25px;" width="75px">Tanggal</th>
                        <th style="border: 1px solid #000;text-align: center;padding: 25px;" width="100px">Sparepart</th>
                        <th style="border: 1px solid #000;text-align: center;padding: 25px;" width="50px">Keterangan</th>
                        <th style="border: 1px solid #000;text-align: center;padding: 25px;" width="50px">Toko</th>
                        <th style="border: 1px solid #000;text-align: center;padding: 25px;" width="50px">Harga</th>
                        <th style="border: 1px solid #000;text-align: center;padding: 25px;" width="50px">Jumlah</th>
                        <th style="border: 1px solid #000;text-align: center;padding: 25px;" width="50px">Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                    </tr>
                </tbody>
            </table>
        ';
    }
}