<?php

namespace App\Controllers;

use App\Models\JenisImunisasiModel;
// use App\Models\KecamatanModel;

define('_TITLE', 'Data Master Jenis Imunisasi');

class JenisImunisasi extends BaseController
{
    private $_jenis_imunisasi_model;
    // $_kecamatan_model;
    private $_defaultImg;
    public function __construct()
    {
        $this->_jenis_imunisasi_model = new JenisImunisasiModel();
        // $this->_kecamatan_model = new KecamatanModel();
        $this->_defaultImg = "default-img-placeholder.png";
    }
    public function index()
    {
        // $data['title'] = 'Daftar Artikel';
        $data_jenis_imunisasi = $this->_jenis_imunisasi_model->getJenisImunisasi();
        // dd($data_jenis_imunisasi);
        $data = [
            'title' => _TITLE,
            'data_jenis_imunisasi' => $data_jenis_imunisasi
        ];
        // d($data_jenis_imunisasi);
        return view('jenis_imunisasi/index', $data);
    }
    public function detail($slug_jenis_imunisasi)
    {
        $data_jenis_imunisasi = $this->_jenis_imunisasi_model->getJenisImunisasi($slug_jenis_imunisasi);
        $data = [
            'title' => _TITLE,
            'data_jenis_imunisasi' => $data_jenis_imunisasi
        ];
        // d($data_jenis_imunisasi);
        return view('jenis_imunisasi/detail', $data);
    }
    public function buatBaru()
    {
        $data = [
            'title' => _TITLE,
            // 'artikel_kategori' => $this->_jenis_imunisasi_model->orderby('nama_kategori')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        // dd($artikel_kategori_model->findAll());
        return view('jenis_imunisasi/buatBaru', $data);
    }
    public function simpan()
    {
        // Validasi Data
        if (!$this->validate([
            'nama_jenis_imunisasi' => [
                'rules' => 'required|is_unique[jenis_imunisasi.nama_jenis_imunisasi]',
                'label' => 'Nama Jenis Imunisasi',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            'gambar_jenis_imunisasi' => [
                'rules' => 'max_size[gambar_jenis_imunisasi,1024]|is_image[gambar_jenis_imunisasi]|mime_in[gambar_jenis_imunisasi,image/jpg,image/jpeg,image/png]',
                'label' => 'Gambar',
                'errors' => [
                    'max_size' => '{field} tidak boleh lebih dari 1MB',
                    'is_image' => 'Yang dipilih bukan {field}!',
                    'mime_in' => 'Yang dipilih bukan {field}!'
                ]
            ]
        ])) {
            // Berisi fungsi redirect jika validasi tidak memenuhi
            // dd(\Config\Services::validation()->getErrors());
            return redirect()->to('/jenis-imunisasi-buat-baru')->withInput();
        }

        $file_gambar_jenis_imunisasi = $this->request->getFile('gambar_jenis_imunisasi');
        if ($file_gambar_jenis_imunisasi->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_jenis_imunisasi->getRandomName();
            $file_gambar_jenis_imunisasi->move('img', $nama_file);
        }
        // dd($file_artikel_gambar_jenis_imunisasi);

        // dd($this->request->getVar());
        $slug_jenis_imunisasi = url_title($this->request->getVar('nama_jenis_imunisasi'), '-', true);
        if ($this->_jenis_imunisasi_model->save([
            'nama_jenis_imunisasi' => $this->request->getVar('nama_jenis_imunisasi'),
            'slug_jenis_imunisasi' => $slug_jenis_imunisasi,
            'gambar_jenis_imunisasi' => $nama_file,
            'jenis_imunisasi_id' => $this->request->getVar('jenis_imunisasi_id'),
            'waktu_awal_tepat_jenis_imunisasi' => $this->request->getVar('waktu_awal_tepat_jenis_imunisasi'),
            'waktu_akhir_tepat_jenis_Imunisasi' => $this->request->getVar('waktu_akhir_tepat_jenis_Imunisasi'),
            'waktu_awal_telat_jenis_imunisasi' => $this->request->getVar('waktu_awal_telat_jenis_imunisasi'),
            'waktu_akhir_telat_jenis_imunisasi' => $this->request->getVar('waktu_akhir_telat_jenis_imunisasi'),
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil ditambahkan!');
        } else session()->setFlashdata('eror', 'Data gagal ditambahkan!');
        return redirect()->to('/jenis-imunisasi');
    }

    public function ubah($slug_jenis_imunisasi)
    {
        $data = [
            "title" => _TITLE,
            "result" => $this->_jenis_imunisasi_model->getJenisImunisasi($slug_jenis_imunisasi),
            // 'kecamatan' => $this->_kecamatan_model->orderby('kecamatan')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('jenis_imunisasi/ubah', $data);
    }
    public function perbaharuiData($id)
    {
        $slug_jenis_imunisasi_lama = $this->request->getVar('slug_jenis_imunisasi_lama');
        $dataArtikelKategoriLama = $this->_jenis_imunisasi_model->getJenisImunisasi($slug_jenis_imunisasi_lama);
        if ($dataArtikelKategoriLama['nama_jenis_imunisasi'] === $this->request->getVar('nama_jenis_imunisasi')) {
            $rule_nama_jenis_imunisasi = 'required';
        } else {
            $rule_nama_jenis_imunisasi = 'required|is_unique[jenis_imunisai.nama_jenis_imunisasi]';
        }

        // Validasi Data
        if (!$this->validate([
            'nama_jenis_imunisasi' => [
                'rules' => $rule_nama_jenis_imunisasi,
                'label' => 'Nama Jenis Imunisasi',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'slug_jenis_imunisasi' => 'required',
            'gambar_jenis_imunisasi' => [
                'rules' => 'max_size[gambar_jenis_imunisasi,1024]|is_image[gambar_jenis_imunisasi]|mime_in[gambar_jenis_imunisasi,image/jpg,image/jpeg,image/png]',
                'label' => 'Logo',
                'errors' => [
                    'max_size' => '{field} tidak boleh lebih dari 1MB',
                    'is_image' => 'Yang dipilih bukan {field}!',
                    'mime_in' => 'Yang dipilih bukan {field}!'
                ]
            ]
        ])) {
            // Berisi fungsi redirect jika validasi tidak memenuhi
            // dd(\Config\Services::validation()->getErrors());
            return redirect()->to('/jenis-imunisasi-ubah/' . $slug_jenis_imunisasi_lama)->withInput();
        }

        // Script untuk mendapatkan gambar artikel
        $file_gambar_jenis_imunisasi = $this->request->getFile('gambar_jenis_imunisasi');
        if ($file_gambar_jenis_imunisasi->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_jenis_imunisasi->getRandomName();
            $file_gambar_jenis_imunisasi->move('img', $nama_file);
            $file_gambar_jenis_imunisasi_lama = $dataArtikelKategoriLama['gambar_jenis_imunisasi'];

            if ($file_gambar_jenis_imunisasi_lama != $this->_defaultImg) {
                unlink('img/' . $file_gambar_jenis_imunisasi_lama);
            }
        }

        $slug_jenis_imunisasi = url_title($this->request->getVar('nama_jenis_imunisasi'), '-', true);
        if ($this->_jenis_imunisasi_model->save([
            'jenis_imunisasi_id' => $id,
            'nama_jenis_imunisasi' => $this->request->getVar('nama_jenis_imunisasi'),
            // 'isi' => $this->request->getVar('isi'),
            'slug_jenis_imunisasi' => $slug_jenis_imunisasi,
            'gambar_jenis_imunisasi' => $nama_file,
            // 'author_user_id' => $this->request->getVar('author_user_id'),
            // 'jenis_imunisasi_id' => $this->request->getVar('jenis_imunisasi_id')
            'waktu_awal_tepat_jenis_imunisasi' => $this->request->getVar('waktu_awal_tepat_jenis_imunisasi'),
            'waktu_akhir_tepat_jenis_Imunisasi' => $this->request->getVar('waktu_akhir_tepat_jenis_Imunisasi'),
            'waktu_awal_telat_jenis_imunisasi' => $this->request->getVar('waktu_awal_telat_jenis_imunisasi'),
            'waktu_akhir_telat_jenis_imunisasi' => $this->request->getVar('waktu_akhir_telat_jenis_imunisasi'),
        ])) {
            session()->setFlashdata('success', 'Data berhasil diperbaharui!');
        } else session()->setFlashdata('error', 'Data gagal diperbaharui!');
        return redirect()->to('/jenis-imunisasi');
    }
    public function hapus($id)
    {
        $dataArtikelKategoriLama = $this->_jenis_imunisasi_model->where(['jenis_imunisasi_id' => $id])->first();
        $file_gambar_jenis_imunisasi_lama = $dataArtikelKategoriLama['gambar_jenis_imunisasi'];
        $this->_jenis_imunisasi_model->delete($id);
        session()->setFlashdata('sukses', 'Data berhasil dihapus!');
        if ($file_gambar_jenis_imunisasi_lama != $this->_defaultImg) {
            unlink('img/' . $file_gambar_jenis_imunisasi_lama);
        }
        return redirect()->to('/jenis-imunisasi');
    }
}
