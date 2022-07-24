<?php

namespace App\Controllers;

use App\Models\ArtikelKategoriModel;
// use App\Models\KecamatanModel;

define('_TITLE', 'Data Master Kategori Artikel');

class ArtikelKategori extends BaseController
{
    private $_artikel_kategori_model;
    // $_kecamatan_model;
    private $_defaultImg;
    public function __construct()
    {
        $this->_artikel_kategori_model = new ArtikelKategoriModel();
        // $this->_kecamatan_model = new KecamatanModel();
        $this->_defaultImg = "default-img-placeholder.png";
    }
    public function index()
    {
        // $data['title'] = 'Daftar Artikel';
        $data_artikel_kategori = $this->_artikel_kategori_model->getArtikelKategori();
        // dd($data_artikel_kategori);
        $data = [
            'title' => _TITLE,
            'data_artikel_kategori' => $data_artikel_kategori
        ];
        // d($data_artikel_kategori);
        return view('artikel_kategori/index', $data);
    }
    public function detail($slug_artikel_kategori)
    {
        $data_artikel_kategori = $this->_artikel_kategori_model->getArtikelKategori($slug_artikel_kategori);
        $data = [
            'title' => _TITLE,
            'data_artikel_kategori' => $data_artikel_kategori
        ];
        // d($data_artikel_kategori);
        return view('artikel_kategori/detail', $data);
    }
    public function buatBaru()
    {
        $data = [
            'title' => _TITLE,
            // 'artikel_kategori' => $this->_artikel_kategori_model->orderby('nama_kategori')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        // dd($artikel_kategori_model->findAll());
        return view('artikel_kategori/buatBaru', $data);
    }
    public function simpan()
    {
        // Validasi Data
        if (!$this->validate([
            'nama_artikel_kategori' => [
                'rules' => 'required|is_unique[artikel_kategori.nama_artikel_kategori]',
                'label' => 'Nama Artikel Kategori',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            'gambar_artikel_kategori' => [
                'rules' => 'max_size[gambar_artikel_kategori,1024]|is_image[gambar_artikel_kategori]|mime_in[gambar_artikel_kategori,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/artikel-kategori-buat-baru')->withInput();
        }

        $file_gambar_artikel_kategori = $this->request->getFile('gambar_artikel_kategori');
        if ($file_gambar_artikel_kategori->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_artikel_kategori->getRandomName();
            $file_gambar_artikel_kategori->move('img', $nama_file);
        }
        // dd($file_artikel_gambar_artikel_kategori);

        // dd($this->request->getVar());
        $slug_artikel_kategori = url_title($this->request->getVar('nama_artikel_kategori'), '-', true);
        if ($this->_artikel_kategori_model->save([
            'nama_artikel_kategori' => $this->request->getVar('nama_artikel_kategori'),
            'slug_artikel_kategori' => $slug_artikel_kategori,
            'gambar_artikel_kategori' => $nama_file,
            'artikel_kategori_id' => $this->request->getVar('artikel_kategori_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil ditambahkan!');
        } else session()->setFlashdata('eror', 'Data gagal ditambahkan!');
        return redirect()->to('/artikel-kategori');
    }

    public function ubah($slug_artikel_kategori)
    {
        $data = [
            "title" => _TITLE,
            "result" => $this->_artikel_kategori_model->getArtikelKategori($slug_artikel_kategori),
            // 'kecamatan' => $this->_kecamatan_model->orderby('kecamatan')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('artikel_kategori/ubah', $data);
    }
    public function perbaharuiData($id)
    {
        $slug_artikel_kategori_lama = $this->request->getVar('slug_artikel_kategori_lama');
        $dataArtikelKategoriLama = $this->_artikel_kategori_model->getArtikelKategori($slug_artikel_kategori_lama);
        if ($dataArtikelKategoriLama['nama_artikel_kategori'] === $this->request->getVar('nama_artikel_kategori')) {
            $rule_nama_artikel_kategori = 'required';
        } else {
            $rule_nama_artikel_kategori = 'required|is_unique[artikel_kategori.nama_artikel_kategori]';
        }

        // Validasi Data
        if (!$this->validate([
            'nama_artikel_kategori' => [
                'rules' => $rule_nama_artikel_kategori,
                'label' => 'Nama Artikel Kategori',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'slug_artikel_kategori' => 'required',
            'gambar_artikel_kategori' => [
                'rules' => 'max_size[gambar_artikel_kategori,1024]|is_image[gambar_artikel_kategori]|mime_in[gambar_artikel_kategori,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/artikel-kategori-ubah/' . $slug_artikel_kategori_lama)->withInput();
        }

        // Script untuk mendapatkan gambar artikel
        $file_gambar_artikel_kategori = $this->request->getFile('gambar_artikel_kategori');
        if ($file_gambar_artikel_kategori->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_artikel_kategori->getRandomName();
            $file_gambar_artikel_kategori->move('img', $nama_file);
            $file_gambar_artikel_kategori_lama = $dataArtikelKategoriLama['gambar_artikel_kategori'];

            if ($file_gambar_artikel_kategori_lama != $this->_defaultImg) {
                unlink('img/' . $file_gambar_artikel_kategori_lama);
            }
        }

        $slug_artikel_kategori = url_title($this->request->getVar('nama_artikel_kategori'), '-', true);
        if ($this->_artikel_kategori_model->save([
            'artikel_kategori_id' => $id,
            'nama_artikel_kategori' => $this->request->getVar('nama_artikel_kategori'),
            // 'isi' => $this->request->getVar('isi'),
            'slug_artikel_kategori' => $slug_artikel_kategori,
            'gambar_artikel_kategori' => $nama_file,
            // 'author_user_id' => $this->request->getVar('author_user_id'),
            // 'artikel_kategori_id' => $this->request->getVar('artikel_kategori_id')
        ])) {
            session()->setFlashdata('success', 'Data berhasil diperbaharui!');
        } else session()->setFlashdata('error', 'Data gagal diperbaharui!');
        return redirect()->to('/artikel-kategori');
    }
    public function hapus($id)
    {
        $dataArtikelKategoriLama = $this->_artikel_kategori_model->where(['artikel_kategori_id' => $id])->first();
        $file_gambar_artikel_kategori_lama = $dataArtikelKategoriLama['gambar_artikel_kategori'];
        $this->_artikel_kategori_model->delete($id);
        session()->setFlashdata('sukses', 'Data berhasil dihapus!');
        if ($file_gambar_artikel_kategori_lama != $this->_defaultImg) {
            unlink('img/' . $file_gambar_artikel_kategori_lama);
        }
        return redirect()->to('/artikel-kategori');
    }
}
