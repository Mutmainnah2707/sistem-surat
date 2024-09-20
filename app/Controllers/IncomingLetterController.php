<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class IncomingLetterController extends BaseController
{
    public function index()
    {
        // Get data surat masuk berdasarkan id pengguna yang sedang login
        $this->data['incomingLetters'] = $this->letterRecipientModel
            ->select('*, letter_recipients.received_date, receivers.name as receiver')
            ->join('letters', 'letters.id = letter_recipients.letter_id')
            ->join('users as receivers', 'receivers.id = letter_recipients.user_id')
            ->where('letter_recipients.user_id', user()->id)
            ->get()->getResultArray();

        return view('letter/incoming/index', $this->data);
    }

    public function create()
    {
        // Get data pengguna yang memiliki role satker
        $this->data['satkers'] = $this->userModel
            ->select('users.id, users.name, auth_groups.name as role')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('auth_groups.name', 'satker')
            ->get()->getResultArray();

        return view('letter/incoming/create', $this->data);
    }

    public function store()
    {
        // Validasi data yang akan disimpan
        if (!$this->validate([
            // letter table validation
            'letter_from'   => 'required',
            'received_date' => 'required|valid_date',
            'letter_date'   => 'required|valid_date',
            'letter_number' => 'required',
            'subject'       => 'required',
            'letter_file'   => 'uploaded[letter_file]|mime_in[letter_file,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|ext_in[letter_file,pdf,doc,docx]|max_size[letter_file,2048]',

            // letter_recipient table validaton
            'receiver'      => 'required',
        ])) {
            return redirect()->back()->withInput();
        };

        // Tampung file surat ke dalam variabel
        $letterFile = $this->request->getFile('letter_file');

        // Kelola file surat
        $fileName = $letterFile->getRandomName();
        $letterFile->move(WRITEPATH . 'uploads', $fileName);

        // Tampung data surat ke dalam variabel
        $letter = [
            'user_id'       => user()->id, // Pengirim surat
            'letter_from'   => $this->request->getPost('letter_from'),
            'received_date' => $this->request->getPost('received_date'),
            'letter_date'   => $this->request->getPost('letter_date'),
            'letter_number' => $this->request->getPost('letter_number'),
            'subject'       => $this->request->getPost('subject'),
            'letter_file'   => $fileName,
            'status'        => 'Final'
        ];

        // Simpan data surat
        if ($this->letterModel->save($letter)) {
            // Tampung data penerima surat ke dalam variabel
            $letter_recipient = [
                'letter_id'     => $this->letterModel->insertID(), // Get id surat yang baru saja disimpan
                'user_id'       => $this->request->getPost('receiver'),
                'received_date' => Time::now()
            ];

            // Simpan data penerima surat
            if ($this->letterRecipientModel->save($letter_recipient)) {
                // Alert jika surat sudah terkirim
                $this->session->setFlashdata('success', 'Surat sudah terkirim.');
            } else {
                // Alert jika surat gagal terkirim
                $this->session->setFlashdata('error', 'Surat gagal terkirim.');
            }
        } else {
            // Alert jika surat gagal disimpan
            $this->session->setFlashdata('error', 'Data surat gagal disimpan.');
        }

        return redirect()->to('surat-masuk');
    }

    public function show($id)
    {
        // Get data surat berdasarkan id
        $this->data['letter'] = $this->letterModel->where('id', $id)->first();

        // Get extensi file
        $filePath = WRITEPATH . 'uploads/' . $this->data['letter']['letter_file'];
        $fileInfo = pathinfo($filePath);
        $this->data['fileExtension'] = strtolower($fileInfo['extension']);

        // Get data penerima surat berdasarkan id surat dan id pengguna yang sedang login
        $data['letter_recipient'] = $this->letterRecipientModel
            ->where('letter_id', $this->data['letter']['id'])
            ->where('user_id', user()->id)
            ->first();

        // Ubah status belum dibaca menjadi sudah dibaca
        $this->letterRecipientModel->update($data['letter_recipient']['id'], ['is_read' => 1]);

        return view('letter/incoming/show', $this->data);
    }

    public function edit($id)
    {
        // Belum diisi
    }

    public function update($id)
    {
        // Belum diisi
    }

    public function delete($id)
    {
        // Get data penerima surat berdasarkan id surat dan id pengguna yang sedang login
        $data['letterRecipient'] = $this->letterRecipientModel
            ->where('letter_id', $id)
            ->where('user_id', user()->id)
            ->first();

        // Hapus data penerima surat
        if ($this->letterRecipientModel->delete($data['letterRecipient']['id'])) {
            // Alert jika data surat berhasil dihapus
            $this->session->setFlashdata('success', 'Data surat berhasil dihapus.');
        } else {
            // Alert jika data surat gagal dihapus
            $this->session->setFlashdata('error', 'Data surat gagal dihapus.');
        }

        return redirect()->back();
    }

    public function viewPdf($fileName)
    {
        $path = WRITEPATH . 'uploads/' . $fileName;

        if (!file_exists($path)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("File PDF tidak ditemukan: " . $fileName);
        }

        $this->response->setHeader('Content-Type', 'application/pdf');
        return $this->response->setBody(file_get_contents($path));
    }
}
