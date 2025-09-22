<?php

namespace App\Http\Controllers;

use App\Models\Lappenyesuaian;
use Illuminate\Http\Request;
use App\Models\Pengguna;
use TCPDF;

class LappenyesuaianController extends Controller
{
    var $model;

    public function __construct()
    {
        $this->model = new Lappenyesuaian();
        $this->isLogin();
    }

    public function index()
    {
        $data['menu'] = 'lappenyesuaian';
        return view('lappenyesuaian.indextemp', $data);
    }

    public function cetak($jenisCetakan, $tglawal, $tglakhir)
    {
        /*
            composer require tecnickcom/tcpdf
        */

        $data['rsPembentukan'] = $this->model->getPembentukan($tglawal, $tglakhir);
        $data['tglawal'] = $tglawal;
        $data['tglakhir'] = $tglakhir;
        $view = view('lappenyesuaian.cetak', $data)->render();


        if ($jenisCetakan == 'excel') {

            // Atur header untuk file Excel
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_Pembentukan_Kecamatan.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo $view;
        } else {

            // Buat instance TCPDF
            $pdf = new TCPDF();

            // Set properti dokumen
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('TZ Developer');
            $pdf->SetTitle('Laporan Penjualan');
            $pdf->SetSubject('Laporan Penjualan');
            $pdf->SetKeywords('TCPDF, PDF, laporan, penjualan');
            $pdf->SetFont('times', '', 10);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            // Set margin halaman
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetTopMargin(5);
            // Tambahkan halaman
            $pdf->AddPage('L');

            // Tulis konten HTML ke dalam PDF
            $pdf->writeHTML($view, true, false, true, false, '');

            // Output PDF
            $pdf->Output('Laporan_Pembentukan_Kecamatan.pdf', 'I');
        }
    }
}
