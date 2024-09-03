<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SuratMasukModel;

class DashboardController extends Controller
{
    public function index()
    {
        $session = session();
        $level = $session->get('level');

        $view = '';
        $data = [
            'user' => $session->get('nama'),
            'level' => $level,
        ];

        $suratMasukModel = new SuratMasukModel();
        $jumlahBelumDibaca = $suratMasukModel->where('status', 0)->countAllResults();

        $data['jumlahBelumDibaca'] = $jumlahBelumDibaca;

        return view('dashboard/admin', $data);
    }

    public function satkerdashboard()
    {
        $session = session();
        $level = $session->get('level');

        $data = [
            'user' => $session->get('nama'),
            'level' => $level,
        ];

        $suratMasukModel = new SuratMasukModel();

        $jumlahBelumDibaca = $suratMasukModel->where('status', 0)
            ->where('tujuan_surat', 'Satker')
            ->countAllResults();

        $data['jumlahBelumDibaca'] = $jumlahBelumDibaca;

        return view('dashboard/satkerboard', $data);
    }

    public function pengurusdashboard()
    {
        $session = session();
        $level = $session->get('level');

        $data = [
            'user' => $session->get('nama'),
            'level' => $level,
        ];

        $suratMasukModel = new SuratMasukModel();

        $jumlahBelumDibaca = $suratMasukModel->where('status', 0)
            ->where('tujuan_surat', 'Pimpinan Pondok')
            ->countAllResults();

        $data['jumlahBelumDibaca'] = $jumlahBelumDibaca;

        return view('dashboard/pengurusboard', $data);
    }
}
