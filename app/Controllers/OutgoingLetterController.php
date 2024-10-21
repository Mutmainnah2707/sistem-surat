<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class OutgoingLetterController extends BaseController
{
    public function index()
    {
        // Ambil data surat, data pengirim surat dan data penerima surat (berdasarkan id pengguna yg sedang login)
        $this->data['outgoingletters'] = $this->letterModel
            ->select('letters.*, sender.name as sender_name, receiver.name as receiver_name')
            ->join('users as sender', 'sender.id = letters.user_id')
            ->join('letter_recipients', 'letter_recipients.letter_id = letters.id', 'left')
            ->join('users as receiver', 'receiver.id = letter_recipients.user_id', 'left')
            ->where('sender.id', user()->id)
            ->get()->getResultArray();

        return view('letter/outgoing/index', $this->data);
    }

    public function create()
    {
        // Get data pengguna
        if (in_groups('admin')) {
            // Get data pengguna yang memiliki role satker dan penpon
            $this->data['users'] = $this->userModel
                ->select('users.id, users.name, auth_groups.name as role')
                ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
                ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
                ->where('auth_groups.name', 'satker')
                ->orWhere('auth_groups.name', 'penpon')
                ->get()->getResultArray();
        } else if (in_groups('satker')) {
            // Get data pengguna yang memiliki role satker
            $this->data['users'] = $this->userModel
                ->select('users.id, users.name, auth_groups.name as role')
                ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
                ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
                ->where('auth_groups.name', 'satker')
                ->get()->getResultArray();
        }

        return view('letter/outgoing/create', $this->data);
    }

    public function store()
    {
        // Validasi data yang akan disimpan
        if (!$this->validate([
            // letter table validation
            'letter_from'   => 'required',
            'letter_date'   => 'required|valid_date',
            'letter_number' => 'required',
            'subject'       => 'required',
            'letter_file'   => 'uploaded[letter_file]|mime_in[letter_file,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|ext_in[letter_file,pdf,doc,docx]|max_size[letter_file,2048]',
            'status'        => 'required|alpha',

            // letter_recipient table validaton
            'receiver'      => 'required',
        ])) {
            return redirect()->back()->withInput();
        };

        // Kelola file surat
        $letterFile = $this->request->getFile('letter_file');
        $fileName = $letterFile->getRandomName();
        $letterFile->move(WRITEPATH . 'uploads', $fileName);

        // Tampung data surat ke dalam variabel
        $letter = [
            'user_id'       => user()->id, // Pengirim surat
            'letter_from'   => $this->request->getPost('letter_from'),
            'letter_date'   => $this->request->getPost('letter_date'),
            'letter_number' => $this->request->getPost('letter_number'),
            'subject'       => $this->request->getPost('subject'),
            'letter_file'   => $fileName,
            'status'        => $this->request->getPost('status')
        ];

        // Simpan data surat
        $this->letterModel->save($letter);

        // Jika status surat adalah Final
        if ($letter['status'] === 'Final') {
            // Simpan data penerima surat ke dalam variabel
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
                // Alert jika surat gagal teririm
                $this->session->setFlashdata('error', 'Surat gagal terkirim.');
            }
        } else {
            // Alert jika status surat adalah Draft
            $this->session->setFlashdata('info', 'Data surat status draft.');
        }

        return redirect()->to('surat-keluar');
    }

    public function show($id)
    {
        // Get data surat berdasarkan id surat
        $this->data['letter'] = $this->letterModel->where('id', $id)->first();

        // Get extensi file
        $filePath = WRITEPATH . 'uploads/' . $this->data['letter']['letter_file'];
        $fileInfo = pathinfo($filePath);
        $this->data['fileExtension'] = strtolower($fileInfo['extension']);

        return view('letter/incoming/show', $this->data);
    }

    public function edit($id)
    {
        // Get data surat berdasarkan id surat
        $this->data['letter'] = $this->letterModel->find($id);

        // Get data pengguna
        if (in_groups('admin')) {
            // Get data pengguna yang memiliki role satker dan penpon
            $this->data['users'] = $this->userModel
                ->select('users.id, users.name, auth_groups.name as role')
                ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
                ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
                ->where('auth_groups.name', 'satker')
                ->orWhere('auth_groups.name', 'penpon')
                ->get()->getResultArray();
        } else if (in_groups('satker')) {
            // Get data pengguna yang memiliki role satker
            $this->data['users'] = $this->userModel
                ->select('users.id, users.name, auth_groups.name as role')
                ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
                ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
                ->where('auth_groups.name', 'satker')
                ->get()->getResultArray();
        }

        return view('letter/outgoing/edit', $this->data);
    }

    public function update($id)
    {
        // Validasi data yang akan diperbarui
        if (!$this->validate([
            // letter table validation
            'letter_from'   => 'required',
            'letter_date'   => 'required|valid_date',
            'letter_number' => 'required',
            'subject'       => 'required',
            // 'letter_file'   => 'uploaded[letter_file]|mime_in[letter_file,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|ext_in[letter_file,pdf,doc,docx]|max_size[letter_file,2048]',
            'status'        => 'required|alpha',

            // letter_recipient table validaton
            'receiver'      => 'required',
        ])) {
            return redirect()->back()->withInput();
        };

        // Tampung file surat ke dalam variabel
        $letterFile = $this->request->getFile('letter_file');

        // Jika user mengupload file surat dan file belum dipindah
        if ($letterFile->isValid() && !$letterFile->hasMoved()) {
            // Kelola file surat
            $fileName = $letterFile->getRandomName();
            $letterFile->move(WRITEPATH . 'uploads', $fileName);

            // Tampung nama file surat ke dalam variabel
            $letter = ['letter_file' => $fileName];
        }

        // Tampung data surat ke dalam variabel
        $letter['user_id']       = user()->id; // Pengirim surat
        $letter['letter_from']   = $this->request->getPost('letter_from');
        $letter['letter_date']   = $this->request->getPost('letter_date');
        $letter['letter_number'] = $this->request->getPost('letter_number');
        $letter['subject']       = $this->request->getPost('subject');
        $letter['status']        = $this->request->getPost('status');

        // Perbarui data surat berdasarkan id
        $this->letterModel->update($id, $letter);

        // Jika status surat adalah Final
        if ($letter['status'] === 'Final') {
            // Tampung data penerima surat ke dalam variabel
            $letter_recipient = [
                'letter_id'     => $id,
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
            // Alert jika status surat adalah Draft
            $this->session->setFlashdata('info', 'Data surat status draft.');
        }

        return redirect()->to('surat-keluar');
    }

    public function delete($id)
    {
        // Hapus file surat yang tersimpan di folder writable/uploads
        $data['letter'] = $this->letterModel->find($id);
        unlink(WRITEPATH . 'uploads/' . $data['letter']['letter_file']);

        // Hapus data surat
        if ($this->letterModel->delete($id)) {
            // Alert jika surat berhasil dihapus
            $this->session->setFlashdata('success', 'Data surat berhasil dihapus.');
        } else {
            // Alert jika surat gagal dihapus
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

    public function download($fileName)
    {
        $filePath = WRITEPATH . 'uploads/' . $fileName;

        if (file_exists($filePath)) {
            return $this->response->download($filePath, null);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('File not found');
        }
    }
}
