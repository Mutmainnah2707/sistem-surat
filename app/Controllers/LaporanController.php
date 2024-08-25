<?php

namespace App\Controllers;

use App\Models\SuratMasukModel;
use App\Models\SuratKeluarModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanController extends BaseController
{
    public function masuk()
    {
        $suratMasukModel = new SuratMasukModel();
        $data['surat_masuk'] = $suratMasukModel->getAllSuratMasuk();
        
        return view('admin/laporan/masuk', $data);
    }

    public function keluar()
{
    $suratKeluarModel = new SuratKeluarModel();
    
    // Melakukan join antara surat_keluar dan surat_masuk berdasarkan id_surat
    $data['surat_keluar'] = $suratKeluarModel
        ->select('surat_keluar.*, surat_masuk.status') // Pilih semua dari surat_keluar dan status dari surat_masuk
        ->join('surat_masuk', 'surat_masuk.id_surat = surat_keluar.id_surat') // Join tabel
        ->findAll();

    return view('admin/laporan/keluar', $data);
}


    public function download($filename)
    {
        $filePath = WRITEPATH . 'uploads/' . $filename; // Sesuaikan dengan lokasi file Anda

        if (file_exists($filePath)) {
            return $this->response->download($filePath, null);
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }
    }
    public function printSuratMasuk()
    {
        $suratMasukModel = new SuratMasukModel();
        $data['surat_masuk'] = $suratMasukModel->findAll();

        $html = view('admin/laporan/print_surat_masuk', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Laporan_Surat_Masuk.pdf', array("Attachment" => false));
    }
    public function printSuratKeluar()
    {
        $suratKeluarModel = new SuratKeluarModel();
        $surat_keluar = $suratKeluarModel->findAll();

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        // Load View dan kirim data surat keluar
        $html = view('admin/laporan/print_surat_keluar', ['surat_keluar' => $surat_keluar]);

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output file PDF
        $dompdf->stream('Laporan_Surat_Keluar.pdf', ["Attachment" => 0]);
    }
}
