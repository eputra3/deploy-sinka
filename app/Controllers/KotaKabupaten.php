<?php

namespace App\Controllers;

use App\Models\KotaKabupatenModel;
use App\Models\KecamatanModel;

define('_TITLE', 'Data Master Kota dan Kabupaten');

class KotaKabupaten extends BaseController
{
    private $_kota_kabupaten_model;
    // $_kecamatan_model;
    private $_defaultImg;
    public function __construct()
    {
        $this->_kota_kabupaten_model = new KotaKabupatenModel();
        // $this->_kecamatan_model = new KecamatanModel();
        $this->_defaultImg = "default-img-placeholder.png";
    }
    public function index()
    {
        // $data['title'] = 'Daftar Artikel';
        $data_kota_kabupaten = $this->_kota_kabupaten_model->getKotaKabupaten();
        // dd($data_kota_kabupaten);
        $data = [
            'title' => _TITLE,
            'data_kota_kabupaten' => $data_kota_kabupaten
        ];
        // d($data_kota_kabupaten);
        return view('alamat/kota_kabupaten/index', $data);
    }
    public function detail($slug)
    {
        $data_kota_kabupaten = $this->_kota_kabupaten_model->getKotaKabupaten($slug);
        $data = [
            'title' => _TITLE,
            'data_kota_kabupaten' => $data_kota_kabupaten
        ];
        // d($data_kota_kabupaten);
        return view('alamat/kota_kabupaten/detail', $data);
    }
    public function buatBaru()
    {
        $data = [
            'title' => _TITLE,
            // 'artikel_kategori' => $this->_artikel_kategori_model->orderby('nama_kategori')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        // dd($artikel_kategori_model->findAll());
        return view('alamat/kota_kabupaten/buatBaru', $data);
    }
    public function simpan()
    {
        // Validasi Data
        if (!$this->validate([
            'nama_kota_kabupaten' => [
                'rules' => 'required|is_unique[kota_kabupaten.nama_kota_kabupaten]',
                'label' => 'Nama Kota/Kabupaten',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            'gambar_kota_kabupaten' => [
                'rules' => 'max_size[gambar_kota_kabupaten,1024]|is_image[gambar_kota_kabupaten]|mime_in[gambar_kota_kabupaten,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/kota-kabupaten-buat-baru')->withInput();
        }

        $file_gambar_kota_kabupaten = $this->request->getFile('gambar_kota_kabupaten');
        if ($file_gambar_kota_kabupaten->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_kota_kabupaten->getRandomName();
            $file_gambar_kota_kabupaten->move('img', $nama_file);
        }
        // dd($file_artikel_gambar_kota_kabupaten);

        // dd($this->request->getVar());
        $slug = url_title($this->request->getVar('nama_kota_kabupaten'), '-', true);
        if ($this->_kota_kabupaten_model->save([
            'nama_kota_kabupaten' => $this->request->getVar('nama_kota_kabupaten'),
            'slug' => $slug,
            'gambar_kota_kabupaten' => $nama_file,
            // 'artikel_kategori_id' => $this->request->getVar('artikel_kategori_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil ditambahkan!');
        } else session()->setFlashdata('eror', 'Data gagal ditambahkan!');
        return redirect()->to('/kota-kabupaten');
    }

    public function ubah($slug)
    {
        $data = [
            "title" => _TITLE,
            "result" => $this->_kota_kabupaten_model->getKotaKabupaten($slug),
            // 'kecamatan' => $this->_kecamatan_model->orderby('kecamatan')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('alamat/kota_kabupaten/ubah', $data);
    }
    public function perbaharuiData($id)
    {
        $slug_lama = $this->request->getVar('slug_lama');
        $dataKotaKabuaptenLama = $this->_kota_kabupaten_model->getKotaKabupaten($slug_lama);
        if ($dataKotaKabuaptenLama['nama_kota_kabupaten'] === $this->request->getVar('nama_kota_kabupaten')) {
            $rule_nama_kota_kabupaten = 'required';
        } else {
            $rule_nama_kota_kabupaten = 'required|is_unique[kota_kabupaten.nama_kota_kabupaten]';
        }

        // Validasi Data
        if (!$this->validate([
            'nama_kota_kabupaten' => [
                'rules' => $rule_nama_kota_kabupaten,
                'label' => 'Nama Kota/Kabupaten',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'slug' => 'required',
            'gambar_kota_kabupaten' => [
                'rules' => 'max_size[gambar_kota_kabupaten,1024]|is_image[gambar_kota_kabupaten]|mime_in[gambar_kota_kabupaten,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('kota-kabupaten-ubah/' . $slug_lama)->withInput();
        }

        // Script untuk mendapatkan gambar artikel
        $file_gambar_kota_kabupaten = $this->request->getFile('gambar_kota_kabupaten');
        if ($file_gambar_kota_kabupaten->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_kota_kabupaten->getRandomName();
            $file_gambar_kota_kabupaten->move('img', $nama_file);
            $file_gambar_kota_kabupaten_lama = $dataKotaKabuaptenLama['gambar_kota_kabupaten'];

            if ($file_gambar_kota_kabupaten_lama != $this->_defaultImg) {
                unlink('img/' . $file_gambar_kota_kabupaten_lama);
            }
        }

        $slug = url_title($this->request->getVar('nama_kota_kabupaten'), '-', true);
        if ($this->_kota_kabupaten_model->save([
            'kota_kabupaten_id' => $id,
            'nama_kota_kabupaten' => $this->request->getVar('nama_kota_kabupaten'),
            // 'isi' => $this->request->getVar('isi'),
            'slug' => $slug,
            'gambar_kota_kabupaten' => $nama_file,
            // 'author_user_id' => $this->request->getVar('author_user_id'),
            // 'artikel_kategori_id' => $this->request->getVar('artikel_kategori_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil diperbaharui!');
        } else session()->setFlashdata('eror', 'Data gagal diperbaharui!');
        return redirect()->to('/kota-kabupaten');
    }
    public function hapus($id)
    {
        $dataKotaKabuaptenLama = $this->_kota_kabupaten_model->where(['kota_kabupaten_id' => $id])->first();
        $file_gambar_kota_kabupaten_lama = $dataKotaKabuaptenLama['gambar_kota_kabupaten'];
        $this->_kota_kabupaten_model->delete($id);
        session()->setFlashdata('sukses', 'Data berhasil dihapus!');
        if ($file_gambar_kota_kabupaten_lama != $this->_defaultImg) {
            unlink('img/' . $file_gambar_kota_kabupaten_lama);
        }
        return redirect()->to('/kota-kabupaten');
    }
}
