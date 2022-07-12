<?php

namespace App\Controllers;

use App\Models\JadwalImunisasiModel;
use App\Models\FaskesModel;
use App\Models\ArtikelModel;

class LandingPage extends BaseController
{
    private $_jadwal_imunisasi_model, $_faskes_model, $_artikel_model, $_artikel_kategori_model;

    public function __construct()
    {
        $this->_jadwal_imunisasi_model = new JadwalImunisasiModel();
        $this->_faskes_model = new FaskesModel();
        $this->_artikel_model = new ArtikelModel();
    }
    public function index()
    {
        $data_jadwal_imunisasi = $this->_jadwal_imunisasi_model->orderBy('jadwal_imunisasi_id', 'DESC')->paginate(4);
        $data_faskes = $this->_faskes_model->getFaskes();
        $data_artikel = $this->_artikel_model->orderBy('artikel_id', 'DESC')->paginate(3);

        $data = [
            'data_jadwal_imunisasi' => $data_jadwal_imunisasi,
            'data_faskes' => $data_faskes,
            'data_artikel' => $data_artikel
        ];

        // d($data_artikel);
        return view('pagesLanding/beranda', $data);
    }
    public function detail($slug)
    {
        $data_artikel = $this->_artikel_model->getArtikel($slug);
        // dd($data_artikel);
        $data = [
            'title' => 'fsefsef',
            'data_artikel' => $data_artikel
        ];
        return view('pagesLanding/detail_artikel_berita', $data);
    }
    public function tentang()
    {


        return view('pagesLanding/tentang');
    }
}
