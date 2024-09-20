<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AjaxController extends BaseController
{
    public function notification()
    {
        // Get data surat masuk berdasarkan id user yang sedang login
        $data['incomingLetter'] = $this->letterRecipientModel
            ->select('*, sender.name as sender, receiver.name as receiver, letter_recipients.received_date as receive')
            ->join('letters', 'letters.id = letter_recipients.letter_id') // Get incoming letter
            ->join('users as sender', 'sender.id = letters.user_id') // Get sender
            ->join('users as receiver', 'receiver.id = letter_recipients.user_id') // Get receiver
            ->where('letter_recipients.user_id', user()->id)->where('is_read', 0)
            ->get()->getResultArray();

        // Get jumlah surat masuk yang belum dibaca oleh pengguna yang sedang login
        $data['countIsRead'] = count($data['incomingLetter']);

        if ($data) {
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $data
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }
}
