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
        $this->Cell(0, 15, 'Laporan Transaksi', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
    public function setTableConf(){
        // Colors, line width and bold font
        $this->SetFillColor(0, 112, 192);
        $this->SetTextColor(255);
        $this->SetDrawColor(56, 56, 56);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B', 12);
    }
    public function setTableAdm($header,$data) {
        $this->setTableConf();
        // Header
        $w = array(20, 30, 40, 50, 40, 70);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('', '', 12);
        // Data
        $fill = 0;
        $no = 1;
        $total = 0;
        foreach ($data['adm'] as $item) {
            $total += (int)$item->total_biaya;

            $this->Cell($w[0], 6, $no++, 'L', 0, 'C', $fill);
            $this->Cell($w[1], 6, date_format(date_create($item->tanggal), 'd/m/Y'), 'L', 0, 'C', $fill);
            $this->Cell($w[2], 6, $item->nomor_polisi, 'L', 0, 'C', $fill);
            $this->Cell($w[3], 6, $item->jenis_pengeluaran, 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 6, $item->pengeluaran, 'L', 0, 'C', $fill);
            $this->Cell($w[5], 6, "Rp.".number_format($item->total_biaya),'LR', 0, 'R', $fill);
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
    }
    public function index(){
        $pdf = new MyPDF('Landscape', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // add a page
        $pdf->AddPage();
        $header = array('No', 'Tanggal', 'Nomor Polisi', 'Jenis Pengeluaran', 'Pengeluaran', 'Total Biaya');
        $data = $this->getDataByMonth(date('n'));
        $pdf->setTableAdm($header, $data);
        $pdf->Output('Tes.pdf', 'I');
    }
    public function getDataByMonth($month){
        $adm = $this->db->query('
            SELECT
                t.transaksi_tanggal as tanggal,
                t.kendaraan_stnk as nomor_polisi,
                mjp.pengeluaran_group as jenis_pengeluaran,
                mjp.pengeluaran_jenis as pengeluaran, 
                t.transaksi_total as total_biaya
            FROM transaksi t , master_jenis_pengeluaran mjp 
            WHERE
                t.id_pengeluaran = mjp.pengeluaran_id
                AND mjp.pengeluaran_group = "Administrasi"
            ORDER BY t.transaksi_tanggal DESC
        ')->result();
        $main = $this->db->query('
            SELECT
                t.*,
                mjp.pengeluaran_jenis , 
                mjp.pengeluaran_group 
            FROM transaksi t , master_jenis_pengeluaran mjp 
            WHERE
                MONTH(t.transaksi_tanggal) = "'.$month.'"
                AND t.id_pengeluaran = mjp.pengeluaran_id
                AND mjp.pengeluaran_group = "Maintenance"
        ')->result();
        $exp = $this->db->query('
            SELECT
                t.*,
                mjp.pengeluaran_jenis , 
                mjp.pengeluaran_group 
            FROM transaksi t , master_jenis_pengeluaran mjp 
            WHERE
                MONTH(t.transaksi_tanggal) = "'.$month.'"
                AND t.id_pengeluaran = mjp.pengeluaran_id
            AND mjp.pengeluaran_group = "Expense"
        ')->result();

        return ['adm' => $adm, 'main' => $main, 'exp' => $exp];
    }
}