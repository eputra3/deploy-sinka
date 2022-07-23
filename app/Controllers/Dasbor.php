<?php

namespace App\Controllers;

// use App\Models\ArtikelKategoriModel;
// use App\Models\ArtikelModel;
use App\Models\DasborModel;

define('_TITLE', 'Dasbor');

class Dasbor extends BaseController
{
    private $_artikel_model, $_artikel_kategori_model, $_dasbor_model;
    private $_defaultImg;
    public function __construct()
    {
        // $this->_artikel_model = new ArtikelModel();
        // $this->_artikel_kategori_model = new ArtikelKategoriModel();
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
        $total_imunisasi_1 = $this->_dasbor_model->hitungJumlahImunisasiHepatittisB();
        $total_imunisasi_2 = $this->_dasbor_model->hitungJumlahImunisasiBcg();
        $total_imunisasi_3 = $this->_dasbor_model->hitungJumlahImunisasiPolioTetes1();
        $total_imunisasi_4 = $this->_dasbor_model->hitungJumlahImunisasiDptHbHib1();
        $total_imunisasi_5 = $this->_dasbor_model->hitungJumlahImunisasiPolioTetes2();
        $total_imunisasi_6 = $this->_dasbor_model->hitungJumlahImunisasiDptHbHib2();
        $total_imunisasi_7 = $this->_dasbor_model->hitungJumlahImunisasiPolioTetes3();
        $total_imunisasi_8 = $this->_dasbor_model->hitungJumlahImunisasiDptHbHib3();
        $total_imunisasi_9 = $this->_dasbor_model->hitungJumlahImunisasiPolioTetes4();
        $total_imunisasi_10 = $this->_dasbor_model->hitungJumlahImunisasiPolioSuntikIpv();
        $total_imunisasi_11 = $this->_dasbor_model->hitungJumlahImunisasiCampakRubelaMr();
        $total_imunisasi_12 = $this->_dasbor_model->hitungJumlahImunisasiDptHbHibLanjutan();
        $total_imunisasi_13 = $this->_dasbor_model->hitungJumlahImunisasiCampakRubelaMrLanjutan();
        $total_imunisasi_14 = $this->_dasbor_model->hitungJumlahImunisasiPcv1();
        $total_imunisasi_15 = $this->_dasbor_model->hitungJumlahImunisasiPcv2();
        $total_imunisasi_16 = $this->_dasbor_model->hitungJumlahImunisasiJapaneseEncephalitis();
        $total_imunisasi_17 = $this->_dasbor_model->hitungJumlahImunisasiPcv3();
        $total_jenis_kelamin_anak_laki = $this->_dasbor_model->hitungJumlahJenisKelaminAnakLaki();
        $total_jenis_kelamin_anak_perempuan = $this->_dasbor_model->hitungJumlahJenisKelaminAnakPerempuan();
        $total_artikel_berita = $this->_dasbor_model->hitungJumlahArtikelBerita();
        $total_riwayat_pertumbuhan = $this->_dasbor_model->hitungJumlahTotalPertumbuhan();
        $total_riwayat_imunisasi = $this->_dasbor_model->hitungJumlahTotalImunisasi();
        $total_pengguna = $this->_dasbor_model->hitungJumlahPengguna();
        $data = [
            'title' => _TITLE,
            'total_anak' => $total_anak,
            'total_ayah' => $total_ayah,
            'total_ibu' => $total_ibu,
            'total_faskes' => $total_faskes,
            'total_imunisasi_1' => $total_imunisasi_1,
            'total_imunisasi_2' => $total_imunisasi_2,
            'total_imunisasi_3' => $total_imunisasi_3,
            'total_imunisasi_4' => $total_imunisasi_4,
            'total_imunisasi_5' => $total_imunisasi_5,
            'total_imunisasi_6' => $total_imunisasi_6,
            'total_imunisasi_7' => $total_imunisasi_7,
            'total_imunisasi_8' => $total_imunisasi_8,
            'total_imunisasi_9' => $total_imunisasi_9,
            'total_imunisasi_10' => $total_imunisasi_10,
            'total_imunisasi_11' => $total_imunisasi_11,
            'total_imunisasi_12' => $total_imunisasi_12,
            'total_imunisasi_13' => $total_imunisasi_13,
            'total_imunisasi_14' => $total_imunisasi_14,
            'total_imunisasi_15' => $total_imunisasi_15,
            'total_imunisasi_16' => $total_imunisasi_16,
            'total_imunisasi_17' => $total_imunisasi_17,
            'total_jenis_kelamin_anak_laki' => $total_jenis_kelamin_anak_laki,
            'total_jenis_kelamin_anak_perempuan' => $total_jenis_kelamin_anak_perempuan,
            'total_artikel_berita' => $total_artikel_berita,
            'total_riwayat_pertumbuhan' => $total_riwayat_pertumbuhan,
            'total_riwayat_imunisasi' => $total_riwayat_imunisasi,
            'total_pengguna' => $total_pengguna,
        ];

        // d($data);

        return view('admin/dasbor', $data);
    }
}
