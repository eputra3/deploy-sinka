<?php

namespace App\Controllers;

use App\Models\FaskesModel;
use App\Models\ArtikelModel;

class LandingPage extends BaseController
{
    private $_faskes_model, $_artikel_model;

    public function __construct()
    {
        $this->_faskes_model = new FaskesModel();
        $this->_artikel_model = new ArtikelModel();
    }
    public function index()
    {
        $data_faskes = $this->_faskes_model->getFaskes();
        $data_artikel = $this->_artikel_model->paginate(3);

        $data = [
            'data_faskes' => $data_faskes,
            'data_artikel' => $data_artikel
        ];

        return view('pagesLanding/beranda', $data);
    }
    public function tentang()
    {


        return view('pagesLanding/tentang');
    }
}
