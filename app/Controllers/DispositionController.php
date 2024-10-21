<?php

namespace App\Controllers;

class DispositionController extends BaseController
{
    public function index()
    {
        // Get level pengguna yang sedang login
        $this->data['level'] = $this->groupModel->getGroupsForUser(user()->id);

        // Jika pengguna yang login adalah admin maka tampilkan semua disposisi
        if ($this->data['level'][0]['name'] == 'admin') {
            $this->data['dispositions'] = $this->dispositionModel
                ->select('dispositions.*, sender.name as sender,  recipient.name as recipient')
                ->join('users as sender', 'sender.id = sender_id')
                ->join('users as recipient', 'recipient.id = recipient_id')
                ->get()->getResultArray();
        }
        // Jika pengguna yang login adalah pimpinan maka tampilkan disposisi berdasarkan id pengirim disposisi
        else if ($this->data['level'][0]['name'] == 'pimpinan') {
            $this->data['dispositions'] = $this->dispositionModel
                ->select('dispositions.*, sender.name as sender,  recipient.name as recipient')
                ->join('users as sender', 'sender.id = sender_id')
                ->join('users as recipient', 'recipient.id = recipient_id')
                ->where('dispositions.sender_id', user()->id)
                ->get()->getResultArray();
        }

        return view('disposition/index', $this->data);
    }

    public function create($id_surat)
    {
        // Id surat yang akan di disposisi
        $this->data['id_surat'] = $id_surat;

        // Get data pengguna
        $this->data['users'] = $this->userModel
            ->select('users.id, users.name, auth_groups.name as role')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
            ->where('auth_groups.name !=', 'pimpinan') // Pengecualian
            ->get()->getResultArray();

        return view('disposition/create', $this->data);
    }

    public function store($id_surat)
    {
        // Validasi data yang akan disimpan
        if (!$this->validate([
            'recipient_id' => 'required|integer',
            'instruction'  => 'required'
        ])) {
            return redirect()->back()->withInput();
        };

        $disposition = [
            'letter_id'    => $id_surat,
            'sender_id'    => user()->id,
            'recipient_id' => $this->request->getPost('recipient_id'),
            'instruction'  => $this->request->getPost('instruction')
        ];

        if ($this->dispositionModel->save($disposition)) {
            // Alert jika data disposisi berhasil
            $this->session->setFlashdata('success', 'Disposisi surat berhasil.');
        } else {
            // Alert jika data disposisi gagal
            $this->session->setFlashdata('error', 'Disposisi surat gagal.');
        }

        return redirect()->to('disposisi');
    }

    public function show($id)
    {
        // Get data disposisi berdasarkan id
        $this->data['disposition'] = $this->dispositionModel
            ->select('*, dispositions.status, senders.name as sender, recipients.name as recipient')
            ->join('letters', 'letters.id = dispositions.letter_id')
            ->join('users as senders', 'senders.id = dispositions.sender_id')
            ->join('users as recipients', 'recipients.id = dispositions.recipient_id')
            ->where('dispositions.id', $id)
            ->first();

        // Get extensi file
        $filePath = WRITEPATH . 'uploads/' . $this->data['disposition']['letter_file'];
        $fileInfo = pathinfo($filePath);
        $this->data['fileExtension'] = strtolower($fileInfo['extension']);

        return view('disposition/show', $this->data);
    }

    public function forward($id)
    {
        $disposition = $this->dispositionModel->find($id);

        // Perbarui status disposisi
        $disposition['status'] = 'Completed';
        if ($this->dispositionModel->update($id, $disposition)) {
            // Alert jika status disposisi berhasil diperbarui
            $this->session->setFlashdata('success', 'Disposisi surat berhasil diteruskan.');
        } else {
            // Alert jika status disposisi gagal diperbarui
            $this->session->setFlashdata('error', 'Disposisi surat gagal diteruskan.');
        }

        return redirect()->to('disposisi');
    }

    public function delete($id)
    {
        $this->dispositionModel->delete($id);
        return redirect()->back();
    }
}
