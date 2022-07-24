<?php

namespace App\Controllers;

use App\Models\KelurahanDesaModel;
use App\Models\KecamatanModel;

define('_TITLE', 'Data Master Kelurahan dan Desa');

class KelurahanDesa extends BaseController
{
    private $_kelurahan_desa_model, $_kecamatan_model;
    private $_defaultImg;
    public function __construct()
    {
        $this->_kelurahan_desa_model = new KelurahanDesaModel();
        $this->_kecamatan_model = new KecamatanModel();
        $this->_defaultImg = "default-img-placeholder.png";
    }
    public function index()
    {
        // $data['title'] = 'Daftar Artikel';
        $data_kelurahan_desa = $this->_kelurahan_desa_model->getKelurahanDesa();
        // dd($data_kelurahan_desa);
        $data = [
            'title' => _TITLE,
            'data_kelurahan_desa' => $data_kelurahan_desa
        ];
        // d($data_kelurahan_desa);
        return view('alamat/kelurahan_desa/index', $data);
    }
    public function detail($slug_kelurahan_desa)
    {
        $data_kelurahan_desa = $this->_kelurahan_desa_model->getKelurahanDesa($slug_kelurahan_desa);
        $data = [
            'title' => _TITLE,
            'data_kelurahan_desa' => $data_kelurahan_desa
        ];
        // d($data_kelurahan_desa);
        return view('alamat/kecamatan/detail', $data);
    }
    public function buatBaru()
    {
        $data = [
            'title' => _TITLE,
            'kecamatan' => $this->_kecamatan_model->orderby('nama_kecamatan')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        // dd($artikel_kategori_model->findAll());
        return view('alamat/kelurahan_desa/buatBaru', $data);
    }
    public function simpan()
    {
        // Validasi Data
        if (!$this->validate([
            'nama_kelurahan_desa' => [
                'rules' => 'required|is_unique[kelurahan_desa.nama_kelurahan_desa]',
                'label' => 'Nama Kelurahan/Desa',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            'gambar_kelurahan_desa' => [
                'rules' => 'max_size[gambar_kelurahan_desa,1024]|is_image[gambar_kelurahan_desa]|mime_in[gambar_kelurahan_desa,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/kelurahan-desa-buat-baru')->withInput();
        }

        $file_gambar_kelurahan_desa = $this->request->getFile('gambar_kelurahan_desa');
        if ($file_gambar_kelurahan_desa->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_kelurahan_desa->getRandomName();
            $file_gambar_kelurahan_desa->move('img', $nama_file);
        }
        // dd($file_artikel_gambar_kelurahan_desa);

        // dd($this->request->getVar());
        $slug_kelurahan_desa = url_title($this->request->getVar('nama_kelurahan_desa'), '-', true);
        if ($this->_kelurahan_desa_model->save([
            'nama_kelurahan_desa' => $this->request->getVar('nama_kelurahan_desa'),
            'slug_kelurahan_desa' => $slug_kelurahan_desa,
            'gambar_kelurahan_desa' => $nama_file,
            'kecamatan_id' => $this->request->getVar('kecamatan_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil ditambahkan!');
        } else session()->setFlashdata('eror', 'Data gagal ditambahkan!');
        return redirect()->to('/kelurahan-desa');
    }

    public function ubah($slug_kelurahan_desa)
    {
        $data = [
            "title" => _TITLE,
            "result" => $this->_kelurahan_desa_model->getKelurahanDesa($slug_kelurahan_desa),
            'kecamatan' => $this->_kecamatan_model->orderby('nama_kecamatan')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('alamat/kelurahan_desa/ubah', $data);
    }
    public function perbaharuiData($id)
    {
        $slug_kelurahan_desa_lama = $this->request->getVar('slug_kelurahan_desa_lama');
        $dataKecamatanLama = $this->_kelurahan_desa_model->getKelurahanDesa($slug_kelurahan_desa_lama);
        if ($dataKecamatanLama['nama_kelurahan_desa'] === $this->request->getVar('nama_kelurahan_desa')) {
            $rule_nama_kelurahan_desa = 'required';
        } else {
            $rule_nama_kelurahan_desa = 'required|is_unique[kecamatan.nama_kelurahan_desa]';
        }

        // Validasi Data
        if (!$this->validate([
            'nama_kelurahan_desa' => [
                'rules' => $rule_nama_kelurahan_desa,
                'label' => 'Nama Kelurahan/Desa',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'slug_kelurahan_desa' => 'required',
            'gambar_kelurahan_desa' => [
                'rules' => 'max_size[gambar_kelurahan_desa,1024]|is_image[gambar_kelurahan_desa]|mime_in[gambar_kelurahan_desa,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('kelurahan-desa-ubah/' . $slug_kelurahan_desa_lama)->withInput();
        }

        // Script untuk mendapatkan gambar artikel
        $file_gambar_kelurahan_desa = $this->request->getFile('gambar_kelurahan_desa');
        if ($file_gambar_kelurahan_desa->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_kelurahan_desa->getRandomName();
            $file_gambar_kelurahan_desa->move('img', $nama_file);
            $file_gambar_kelurahan_desa_lama = $dataKecamatanLama['gambar_kelurahan_desa'];

            if ($file_gambar_kelurahan_desa_lama != $this->_defaultImg) {
                unlink('img/' . $file_gambar_kelurahan_desa_lama);
            }
        }

        $slug_kelurahan_desa = url_title($this->request->getVar('nama_kelurahan_desa'), '-', true);
        if ($this->_kelurahan_desa_model->save([
            'kecamatan_id' => $id,
            'nama_kelurahan_desa' => $this->request->getVar('nama_kelurahan_desa'),
            // 'isi' => $this->request->getVar('isi'),
            'slug_kelurahan_desa' => $slug_kelurahan_desa,
            'gambar_kelurahan_desa' => $nama_file,
            // 'author_user_id' => $this->request->getVar('author_user_id'),
            'kecamatan_id' => $this->request->getVar('kecamatan_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil diperbaharui!');
        } else session()->setFlashdata('eror', 'Data gagal diperbaharui!');
        return redirect()->to('/kelurahan_desa');
    }
    public function hapus($id)
    {
        $dataKecamatanLama = $this->_kelurahan_desa_model->where(['kelurahan_desa_id' => $id])->first();
        $file_gambar_kelurahan_desa_lama = $dataKecamatanLama['gambar_kelurahan_desa'];
        $this->_kelurahan_desa_model->delete($id);
        session()->setFlashdata('sukses', 'Data berhasil dihapus!');
        if ($file_gambar_kelurahan_desa_lama != $this->_defaultImg) {
            unlink('img/' . $file_gambar_kelurahan_desa_lama);
        }
        return redirect()->to('/kelurahan-desa');
    }
}
