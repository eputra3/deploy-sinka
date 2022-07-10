<?php

namespace App\Controllers;

use App\Models\ArtikelKategoriModel;
use App\Models\ArtikelModel;
use App\Models\DasborModel;

define('_TITLE', 'Dasbor');

class Dasbor extends BaseController
{
    private $_artikel_model, $_artikel_kategori_model, $_dasbor_model;
    private $_defaultImg;
    public function __construct()
    {
        $this->_artikel_model = new ArtikelModel();
        $this->_artikel_kategori_model = new ArtikelKategoriModel();
        $this->_dasbor_model = new DasborModel();
        $this->_defaultImg = "default-img-placeholder.png";
    }
    // public function index()
    // // {
    // //     // $data['title'] = 'Daftar Artikel';
    // //     $data_artikel = $this->_artikel_model->getArtikel();
    // //     // dd($data_artikel);
    // //     $data = [
    // //         'title' => _TITLE,
    // //         'data_artikel' => $data_artikel
    // //     ];
    // //     // dd($data_artikel);
    // //     return view('artikel/index', $data);
    // // }
    public function dasbor()
    {
        $total_anak = $this->_dasbor_model->hitungJumlahAnak();
        $total_ayah = $this->_dasbor_model->hitungJumlahAyah();
        $total_ibu = $this->_dasbor_model->hitungJumlahIbu();
        $total_faskes = $this->_dasbor_model->hitungJumlahFaskes();
        $total_imunisasi_satu = $this->_dasbor_model->hitungJumlahImunisasiSatu();
        $total_jenis_kelamin_anak_laki = $this->_dasbor_model->hitungJumlahJenisKelaminAnakLaki();
        $total_jenis_kelamin_anak_perempuan = $this->_dasbor_model->hitungJumlahJenisKelaminAnakPerempuan();
        $data = [
            'title' => _TITLE,
            'total_anak' => $total_anak,
            'total_ayah' => $total_ayah,
            'total_ibu' => $total_ibu,
            'total_faskes' => $total_faskes,
            'total_imunisasi_satu' => $total_imunisasi_satu,
            'total_jenis_kelamin_anak_laki' => $total_jenis_kelamin_anak_laki,
            'total_jenis_kelamin_anak_perempuan' => $total_jenis_kelamin_anak_perempuan
        ];

        // d($data);

        return view('admin/dasbor', $data);
    }
}
