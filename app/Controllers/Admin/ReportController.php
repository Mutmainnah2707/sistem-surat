<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Dompdf\Dompdf;
use Dompdf\Options;

class ReportController extends BaseController
{
    public function suratMasuk()
    {
        // Get data surat masuk
        $this->data['incomingLetters'] = $this->letterRecipientModel
            ->select('*, letter_recipients.received_date, receivers.name as receiver_name')
            ->join('letters', 'letters.id = letter_recipients.letter_id')
            ->join('users as receivers', 'receivers.id = letter_recipients.user_id')
            ->get()->getResultArray();

        return view('admin/report/incoming_letter', $this->data);
    }

    public function suratKeluar()
    {
        // Get data surat keluar
        $this->data['outgoingLetters'] = $this->letterModel
            ->select('letters.*, sender.name as sender_name, receiver.name as receiver_name')
            ->join('users as sender', 'sender.id = letters.user_id')
            ->join('letter_recipients', 'letter_recipients.letter_id = letters.id', 'left')
            ->join('users as receiver', 'receiver.id = letter_recipients.user_id', 'left')
            ->get()->getResultArray();

        return view('admin/report/outgoing_letter', $this->data);
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
        // Get data surat masuk
        $this->data['incomingLetters'] = $this->letterRecipientModel
            ->select('*, letter_recipients.received_date, receivers.name as receiver_name')
            ->join('letters', 'letters.id = letter_recipients.letter_id')
            ->join('users as receivers', 'receivers.id = letter_recipients.user_id')
            ->get()->getResultArray();

        $html = view('admin/report/print_surat_masuk', $this->data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Laporan_Surat_Masuk.pdf', array("Attachment" => false));
    }

    public function printSuratKeluar()
    {
        // Get data surat keluar
        $this->data['outgoingLetters'] = $this->letterModel
            ->select('letters.*, sender.name as sender_name, receiver.name as receiver_name')
            ->join('users as sender', 'sender.id = letters.user_id')
            ->join('letter_recipients', 'letter_recipients.letter_id = letters.id', 'left')
            ->join('users as receiver', 'receiver.id = letter_recipients.user_id', 'left')
            ->get()->getResultArray();

        $html = view('admin/report/print_surat_keluar', $this->data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Laporan_Surat_Masuk.pdf', array("Attachment" => false));
    }
}
