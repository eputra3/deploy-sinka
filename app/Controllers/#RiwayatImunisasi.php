<?php

namespace App\Controllers;

use App\Models\RiwayatImunisasiModel;
// use App\Models\IdentitasModel;
use App\Models\AnakModel;
use App\Models\JenisImunisasiModel;
use App\Models\KotaKabupatenModel;
use App\Models\FaskesModel;
use App\Models\KelurahanDesaModel;

define('_TITLE', 'Riwayat Imunisasi');

class RiwayatImunisasi extends BaseController
{
    private $_riwayat_imunisasi_model, $_anak_model, $_jenis_imunisasi_model,  $_kota_kabupaten_model, $_faskes_model, $_kelurahan_desa_model;
    private $_defaultImg;
    public function __construct()
    {
        $this->_riwayat_imunisasi_model = new RiwayatImunisasiModel();
        $this->_anak_model = new AnakModel();
        $this->_jenis_imunisasi_model = new JenisImunisasiModel();
        $this->_kota_kabupaten_model = new KotaKabupatenModel();
        $this->_faskes_model = new FaskesModel();
        $this->_kelurahan_desa_model = new KelurahanDesaModel();
        $this->_defaultImg = "default-img-placeholder.png";

        $this->kotakabupatenModel = new KotaKabupatenModel();
    }
    public function index()
    {
        // $data['title'] = 'Daftar Artikel';
        $data_riwayat_imunisasi = $this->_riwayat_imunisasi_model->getRiwayatImunisasi();

        // d($data);
        $data = [
            'title' => _TITLE,
            'data_riwayat_imunisasi' => $data_riwayat_imunisasi,
        ];
        // d($data);
        return view('riwayat_imunisasi/index', $data);
    }
    public function detail($slug_riwayat_imunisasi)
    {
        $data_riwayat_imunisasi = $this->_riwayat_imunisasi_model->getRiwayatImunisasi($slug_riwayat_imunisasi);
        $data_kota_kabupaten = $this->_kota_kabupaten_model->getKotaKabupaten();
        $data_anak = $this->_anak_model->getAnak();
        $data_jenis_imunisasi = $this->_jenis_imunisasi_model->getJenisImunisasi();
        $data_faskes = $this->_faskes_model->getFaskes();
        // dd($data_riwayat_imunisasi);
        $data = [
            'title' => _TITLE,
            'data_riwayat_imunisasi' => $data_riwayat_imunisasi,
            'data_anak' => $data_anak,
            'data_jenis_imunisasi' => $data_jenis_imunisasi,
            'data_faskes' => $data_faskes,
        ];
        // d($data);
        return view('riwayat_imunisasi/detail', $data);
    }
    public function buatBaru()
    {
        $data = [
            'title' => _TITLE,
            'anak' => $this->_anak_model->orderby('nama_anak')->findAll(),
            'jenis_imunisasi' => $this->_jenis_imunisasi_model->orderby('nama_jenis_imunisasi')->findAll(),
            'faskes' => $this->_faskes_model->orderby('nama_faskes')->findAll(),
            'kota_kabupaten' => $this->kotakabupatenModel->orderBy('nama_kota_kabupaten', 'ASC')->findAll(),
            'validation' => \Config\Services::validation()

        ];
        // d($identitas_model->findAll());
        return view('riwayat_imunisasi/buatBaru', $data);
    }
    // public function action()
    // {
    //     if ($this->request->getVar('action')) {
    //         $action = $this->request->getVar('action');

    //         if ($action == 'get_kecamatan') {
    //             $FaskesModel = new FaskesModel();
    //             $kecamatandata = $FaskesModel->where('kota_kabupaten_id', $this->request->getVar('kota_kabupaten_id'))->findAll();

    //             echo json_encode($kecamatandata);
    //         }

    //         if ($action == 'get_kelurahan_desa') {
    //             $kelurahandesaModel = new KelurahanDesaModel();
    //             $kelurahandesadata = $kelurahandesaModel->where('kecamatan_id', $this->request->getVar('kecamatan_id'))->findAll();

    //             echo json_encode($kelurahandesadata);
    //         }
    //     }
    // }
    public function simpan()
    {
        // Validasi Data
        if (!$this->validate([
            'judul_riwayat_imunisasi' => [
                'rules' => 'required|is_unique[riwayat_imunisasi.judul_riwayat_imunisasi]',
                'label' => 'Judul Riwayat Imunisasi',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'isi' => 'required',
            'gambar_riwayat_imunisasi' => [
                'rules' => 'max_size[gambar_riwayat_imunisasi,1024]|is_image[gambar_riwayat_imunisasi]|mime_in[gambar_riwayat_imunisasi,image/jpg,image/jpeg,image/png]',
                'label' => 'Gambar',
                'errors' => [
                    'max_size' => '{field} tidak boleh lebih dari 1MB',
                    'is_image' => 'Yang dipilih bukan {field}!',
                    'mime_in' => 'Yang dipilih bukan {field}!'
                ]
            ],
            'author_user_id' => 'required'
        ])) {
            // Berisi fungsi redirect jika validasi tidak memenuhi
            // dd(\Config\Services::validation()->getErrors());
            return redirect()->to('/riwayat-imunisasi-buat-baru')->withInput();
        }

        $file_gambar_riwayat_imunisasi = $this->request->getFile('gambar_riwayat_imunisasi');
        if ($file_gambar_riwayat_imunisasi->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_riwayat_imunisasi->getRandomName();
            $file_gambar_riwayat_imunisasi->move('img', $nama_file);
        }
        // dd($file_gambar_riwayat_imunisasi);

        // dd($this->request->getVar());
        $slug_riwayat_imunisasi = url_title($this->request->getVar(
            'judul_riwayat_imunisasi'
        ), '-', true);
        if ($this->_riwayat_imunisasi_model->save([
            'slug_riwayat_imunisasi' => $slug_riwayat_imunisasi,
            'judul_riwayat_imunisasi' => $this->request->getVar('judul_riwayat_imunisasi'),
            'id_anak' => $this->request->getVar('id_anak'),
            'id_jenis_imunisasi' => $this->request->getVar('id_jenis_imunisasi'),
            'id_lokasi_faskes' => $this->request->getVar('id_lokasi_faskes'),
            'tanggal_riwayat_imunisasi' => $this->request->getVar('tanggal_riwayat_imunisasi'),
            'catatan_riwayat_imunisasi' => $this->request->getVar('catatan_riwayat_imunisasi'),
            'gambar_riwayat_imunisasi' => $nama_file,
            'author_user_id' => $this->request->getVar('author_user_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil ditambahkan!');
        } else session()->setFlashdata('eror', 'Data gagal ditambahkan!');
        return redirect()->to('/riwayat-imunisasi');
    }

    public function ubah($slug_riwayat_imunisasi)
    {
        $data = [
            "title" => _TITLE,
            "result" => $this->_riwayat_imunisasi_model->getRiwayatImunisasi($slug_riwayat_imunisasi),
            'kota_kabupaten' => $this->kotakabupatenModel->orderBy('nama_kota_kabupaten', 'ASC')->findAll(),
            // 'kota_kabupaten' => $this->_identitas_model->orderby('nama_kota_kabupaten')->findAll(),
            'anak' => $this->_anak_model->orderby('nama_anak')->findAll(),
            'jenis_imunisasi' => $this->_jenis_imunisasi_model->orderby('nama_jenis_imunisasi')->findAll(),
            'faskes' => $this->_faskes_model->orderby('nama_faskes')->findAll(),
            // 'ibu' => $this->_jenis_imunisasi_model->orderby('nama_ibu')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('riwayat_imunisasi/ubah', $data);
    }
    public function perbaharuiData($id)
    {
        $slug_riwayat_imunisasi_lama = $this->request->getVar('slug_riwayat_imunisasi_lama');
        $dataRiwayatImunisasiLama = $this->_riwayat_imunisasi_model->getRiwayatImunisasi($slug_riwayat_imunisasi_lama);
        if ($dataRiwayatImunisasiLama['judul_riwayat_imunisasi'] === $this->request->getVar('judul_riwayat_imunisasi')) {
            $rule_judul_riwayat_imunisasi = 'required';
        } else {
            $rule_judul_riwayat_imunisasi = 'required|is_unique[riwayat_imunisasi.judul_riwayat_imunisasi]';
        }

        // Validasi Data
        if (!$this->validate([
            'judul_riwayat_imunisasi' => [
                'rules' => $rule_judul_riwayat_imunisasi,
                'label' => 'Judul Riwayat Imunisasi',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'isi' => 'required',
            // 'slug_riwayat_imunisasi' => 'required',
            'gambar_riwayat_imunisasi' => [
                'rules' => 'max_size[gambar_riwayat_imunisasi,1024]|is_image[gambar_riwayat_imunisasi]|mime_in[gambar_riwayat_imunisasi,image/jpg,image/jpeg,image/png]',
                'label' => 'Gambar',
                'errors' => [
                    'max_size' => '{field} tidak boleh lebih dari 1MB',
                    'is_image' => 'Yang dipilih bukan {field}!',
                    'mime_in' => 'Yang dipilih bukan {field}!'
                ]
            ],
            'author_user_id' => 'required'
        ])) {
            // Berisi fungsi redirect jika validasi tidak memenuhi
            // dd(\Config\Services::validation()->getErrors());
            return redirect()->to('/riwayat-imunisasi-ubah/' . $slug_riwayat_imunisasi_lama)->withInput();
        }

        // Script untuk mendapatkan gambar artikel
        $file_gambar_riwayat_imunisasi = $this->request->getFile('gambar_riwayat_imunisasi');
        if ($file_gambar_riwayat_imunisasi->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_riwayat_imunisasi->getRandomName();
            $file_gambar_riwayat_imunisasi->move('img', $nama_file);
            $file_gambar_riwayat_imunisasi_lama = $dataRiwayatImunisasiLama['gambar_riwayat_imunisasi'];

            if ($file_gambar_riwayat_imunisasi_lama != $this->_defaultImg) {
                unlink('img/' . $file_gambar_riwayat_imunisasi_lama);
            }
        }

        $slug_riwayat_imunisasi = url_title($this->request->getVar('judul_riwayat_imunisasi'), '-', true);
        if ($this->_riwayat_imunisasi_model->save([
            'riwayat_imunisasi_id' => $id,
            'slug_riwayat_imunisasi' => $slug_riwayat_imunisasi,
            'judul_riwayat_imunisasi' => $this->request->getVar('judul_riwayat_imunisasi'),
            'id_anak' => $this->request->getVar('id_anak'),
            'id_jenis_imunisasi' => $this->request->getVar('id_jenis_imunisasi'),
            'id_lokasi_faskes' => $this->request->getVar('id_lokasi_faskes'),
            'tanggal_riwayat_imunisasi' => $this->request->getVar('tanggal_riwayat_imunisasi'),
            'catatan_riwayat_imunisasi' => $this->request->getVar('catatan_riwayat_imunisasi'),
            'gambar_riwayat_imunisasi' => $nama_file,
            'author_user_id' => $this->request->getVar('author_user_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil diperbaharui!');
        } else session()->setFlashdata('eror', 'Data gagal diperbaharui!');
        return redirect()->to('/riwayat-imunisasi');
    }
    public function hapus($id)
    {
        $dataRiwayatImunisasiLama = $this->_riwayat_imunisasi_model->where(['riwayat_imunisasi_id' => $id])->first();
        $file_gambar_riwayat_imunisasi_lama = $dataRiwayatImunisasiLama['gambar_riwayat_imunisasi'];

        $this->_riwayat_imunisasi_model->delete($id);
        session()->setFlashdata('sukses', 'Data berhasil dihapus!');

        if ($file_gambar_riwayat_imunisasi_lama != $this->_defaultImg) {
            unlink('img/' . $file_gambar_riwayat_imunisasi_lama);
        }
        return redirect()->to('/riwayat-imunisasi');
    }
}
