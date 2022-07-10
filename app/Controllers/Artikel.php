<?php

namespace App\Controllers;

use App\Models\ArtikelKategoriModel;
use App\Models\ArtikelModel;

define('_TITLE', 'Daftar Artikel');

class Artikel extends BaseController
{
    private $_artikel_model, $_artikel_kategori_model;
    private $_defaultImg;
    public function __construct()
    {
        $this->_artikel_model = new ArtikelModel();
        $this->_artikel_kategori_model = new ArtikelKategoriModel();
        $this->_defaultImg = "default-img-placeholder.png";
    }
    public function index()
    {
        // $data['title'] = 'Daftar Artikel';
        $data_artikel = $this->_artikel_model->getArtikel();
        // dd($data_artikel);
        $data = [
            'title' => _TITLE,
            'data_artikel' => $data_artikel
        ];
        // dd($data_artikel);
        return view('artikel/index', $data);
    }
    public function detail($slug)
    {
        $data_artikel = $this->_artikel_model->getArtikel($slug);
        // dd($data_artikel);
        $data = [
            'title' => _TITLE,
            'data_artikel' => $data_artikel
        ];
        return view('artikel/detail', $data);
    }
    public function buatBaru()
    {
        $data = [
            'title' => _TITLE,
            'artikel_kategori' => $this->_artikel_kategori_model->orderby('nama_artikel_kategori')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        // dd($artikel_kategori_model->findAll());
        return view('artikel/buatBaru', $data);
    }
    public function simpan()
    {
        // Validasi Data
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[artikel.judul]',
                'label' => 'Judul',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            'isi' => 'required',
            'gambar_artikel' => [
                'rules' => 'max_size[gambar_artikel,1024]|is_image[gambar_artikel]|mime_in[gambar_artikel,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/artikel-buat-baru')->withInput();
        }

        $file_gambar_artikel = $this->request->getFile('gambar_artikel');
        if ($file_gambar_artikel->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_artikel->getRandomName();
            $file_gambar_artikel->move('img', $nama_file);
        }
        // dd($file_gambar_artikel);

        // dd($this->request->getVar());
        $slug = url_title($this->request->getVar('judul'), '-', true);
        if ($this->_artikel_model->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'isi' => $this->request->getVar('isi'),
            'gambar_artikel' => $nama_file,
            'author_user_id' => $this->request->getVar('author_user_id'),
            'artikel_kategori_id' => $this->request->getVar('artikel_kategori_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil ditambahkan!');
        } else session()->setFlashdata('eror', 'Data gagal ditambahkan!');
        return redirect()->to('/artikel');
    }

    public function ubah($slug)
    {
        $data = [
            "title" => _TITLE,
            "result" => $this->_artikel_model->getArtikel($slug),
            'artikel_kategori' => $this->_artikel_kategori_model->orderby('nama_artikel_kategori')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('artikel/ubah', $data);
    }
    public function perbaharuiData($id)
    {
        $slug_lama = $this->request->getVar('slug_lama');
        $dataArtikelLama = $this->_artikel_model->getArtikel($slug_lama);
        if ($dataArtikelLama['judul'] === $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[artikel.judul]';
        }

        // Validasi Data
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'label' => 'Judul',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            'isi' => 'required',
            // 'slug' => 'required',
            'gambar_artikel' => [
                'rules' => 'max_size[gambar_artikel,1024]|is_image[gambar_artikel]|mime_in[gambar_artikel,image/jpg,image/jpeg,image/png]',
                'label' => 'Gambar',
                'errors' => [
                    'max_size' => '{field} tidak boleh lebih dari 1MB',
                    'is_gambar_artikel' => 'Yang dipilih bukan {field}!',
                    'mime_in' => 'Yang dipilih bukan {field}!'
                ]
            ],
            'author_user_id' => 'required'
        ])) {
            // Berisi fungsi redirect jika validasi tidak memenuhi
            // dd(\Config\Services::validation()->getErrors());
            return redirect()->to('/artikel-ubah/' . $slug_lama)->withInput();
        }

        // Script untuk mendapatkan gambar artikel
        $file_gambar_artikel = $this->request->getFile('gambar_artikel');
        if ($file_gambar_artikel->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_artikel->getRandomName();
            $file_gambar_artikel->move('img', $nama_file);
            $file_gambar_artikel_lama = $dataArtikelLama['gambar_artikel'];

            if ($file_gambar_artikel_lama != $this->_defaultImg) {
                unlink('img/' . $file_gambar_artikel_lama);
            }
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        if ($this->_artikel_model->save([
            'artikel_id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'isi' => $this->request->getVar('isi'),
            'gambar_artikel' => $nama_file,
            'author_user_id' => $this->request->getVar('author_user_id'),
            'artikel_kategori_id' => $this->request->getVar('artikel_kategori_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil diperbaharui!');
        } else session()->setFlashdata('eror', 'Data gagal diperbaharui!');
        return redirect()->to('/artikel');
    }
    public function hapus($id)
    {
        $dataArtikelLama = $this->_artikel_model->where(['artikel_id' => $id])->first();
        $file_gambar_artikel_lama = $dataArtikelLama['gambar_artikel'];

        $this->_artikel_model->delete($id);
        session()->setFlashdata('sukses', 'Data berhasil dihapus!');

        if ($file_gambar_artikel_lama != $this->_defaultImg) {
            unlink('img/' . $file_gambar_artikel_lama);
        }
        return redirect()->to('/artikel');
    }
}
