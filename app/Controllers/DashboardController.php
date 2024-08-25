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

        // Menambahkan logika untuk level 'satker'
        if ($level === 'satker') {
            $jumlahBelumDibaca = $suratMasukModel->where('status', 0)
                                                  ->where('tujuan_surat', 'Satker')
                                                  ->countAllResults();
            $view = 'dashboard/satkerboard'; 
        } elseif ($level === 'pengurus') {
            $jumlahBelumDibaca = $suratMasukModel->where('status', 0)
            ->where('tujuan_surat', 'Pimpinan Pondok')
            ->countAllResults();
            $view = 'dashboard/pengurusboard'; 
        } else {
            $view = 'dashboard/admin'; 
        }

        $data['jumlahBelumDibaca'] = $jumlahBelumDibaca;

        return view($view, $data);
    }
}
