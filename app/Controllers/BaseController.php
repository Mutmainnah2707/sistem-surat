<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SuratMasukModel;

class BaseController extends Controller
{
    protected $suratMasukModel;
    protected $jumlahBelumDibaca;

    public function __construct()
    {
        $this->suratMasukModel = new SuratMasukModel();

        // Menghitung jumlah surat masuk yang belum dibaca
        $this->jumlahBelumDibaca = $this->suratMasukModel->where('status', 0)
                                                         ->where('tujuan_surat', 'Satker')
                                                         ->countAllResults();
    }

    protected function loadView($view, $data = [])
    {
        $data['jumlahBelumDibaca'] = $this->jumlahBelumDibaca;
        return view($view, $data);
    }
}

?>
