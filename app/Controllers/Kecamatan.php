<?php

namespace App\Controllers;

use App\Models\KecamatanModel;
use App\Models\KotaKabupatenModel;

define('_TITLE', 'Data Master Kecamatan');

class Kecamatan extends BaseController
{
    private $_kecamatan_model, $_kota_kabupaten_model;
    private $_defaultImg;
    public function __construct()
    {
        $this->_kecamatan_model = new KecamatanModel();
        $this->_kota_kabupaten_model = new KotaKabupatenModel();
        $this->_defaultImg = "default-img-placeholder.png";
    }
    public function index()
    {
        // $data['title'] = 'Daftar Artikel';
        $data_kecamatan = $this->_kecamatan_model->getKecamatan();
        // dd($data_kecamatan);
        $data = [
            'title' => _TITLE,
            'data_kecamatan' => $data_kecamatan
        ];
        // d($data_kecamatan);
        return view('alamat/kecamatan/index', $data);
    }
    public function detail($slug_kecamatan)
    {
        $data_kecamatan = $this->_kecamatan_model->getKecamatan($slug_kecamatan);
        $data = [
            'title' => _TITLE,
            'data_kecamatan' => $data_kecamatan
        ];
        // d($data_kecamatan);
        return view('alamat/kecamatan/detail', $data);
    }
    public function buatBaru()
    {
        $data = [
            'title' => _TITLE,
            'kota_kabupaten' => $this->_kota_kabupaten_model->orderby('nama_kota_kabupaten')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        // dd($artikel_kategori_model->findAll());
        return view('alamat/kecamatan/buatBaru', $data);
    }
    public function simpan()
    {
        // Validasi Data
        if (!$this->validate([
            'nama_kecamatan' => [
                'rules' => 'required|is_unique[kecamatan.nama_kecamatan]',
                'label' => 'Nama Kecamatan',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            'gambar_kecamatan' => [
                'rules' => 'max_size[gambar_kecamatan,1024]|is_image[gambar_kecamatan]|mime_in[gambar_kecamatan,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/kecamatan-buat-baru')->withInput();
        }

        $file_gambar_kecamatan = $this->request->getFile('gambar_kecamatan');
        if ($file_gambar_kecamatan->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_kecamatan->getRandomName();
            $file_gambar_kecamatan->move('img', $nama_file);
        }
        // dd($file_artikel_gambar_kecamatan);

        // dd($this->request->getVar());
        $slug_kecamatan = url_title($this->request->getVar('nama_kecamatan'), '-', true);
        if ($this->_kecamatan_model->save([
            'nama_kecamatan' => $this->request->getVar('nama_kecamatan'),
            'slug_kecamatan' => $slug_kecamatan,
            'gambar_kecamatan' => $nama_file,
            'kota_kabupaten_id' => $this->request->getVar('kota_kabupaten_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil ditambahkan!');
        } else session()->setFlashdata('eror', 'Data gagal ditambahkan!');
        return redirect()->to('/kecamatan');
    }

    public function ubah($slug_kecamatan)
    {
        $data = [
            "title" => _TITLE,
            "result" => $this->_kecamatan_model->getKecamatan($slug_kecamatan),
            'kota_kabupaten' => $this->_kota_kabupaten_model->orderby('nama_kota_kabupaten')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('alamat/kecamatan/ubah', $data);
    }
    public function perbaharuiData($id)
    {
        $slug_kecamatan_lama = $this->request->getVar('slug_kecamatan_lama');
        $dataKecamatanLama = $this->_kecamatan_model->getKecamatan($slug_kecamatan_lama);
        if ($dataKecamatanLama['nama_kecamatan'] === $this->request->getVar('nama_kecamatan')) {
            $rule_nama_kecamatan = 'required';
        } else {
            $rule_nama_kecamatan = 'required|is_unique[kecamatan.nama_kecamatan]';
        }

        // Validasi Data
        if (!$this->validate([
            'nama_kecamatan' => [
                'rules' => $rule_nama_kecamatan,
                'label' => 'Nama Kecamatan',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'slug_kecamatan' => 'required',
            'gambar_kecamatan' => [
                'rules' => 'max_size[gambar_kecamatan,1024]|is_image[gambar_kecamatan]|mime_in[gambar_kecamatan,image/jpg,image/jpeg,image/png]',
                'label' => 'Logo',
                'errors' => [
                    'max_size' => '{field} tidak boleh lebih dari 1MB',
                    'is_gambar_kecamatan' => 'Yang dipilih bukan {field}!',
                    'mime_in' => 'Yang dipilih bukan {field}!'
                ]
            ]
        ])) {
            // Berisi fungsi redirect jika validasi tidak memenuhi
            // dd(\Config\Services::validation()->getErrors());
            return redirect()->to('kecamatan-ubah/' . $slug_kecamatan_lama)->withInput();
        }

        // Script untuk mendapatkan gambar artikel
        $file_gambar_kecamatan = $this->request->getFile('gambar_kecamatan');
        if ($file_gambar_kecamatan->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_kecamatan->getRandomName();
            $file_gambar_kecamatan->move('img', $nama_file);
            $file_gambar_kecamatan_lama = $dataKecamatanLama['gambar_kecamatan'];

            if ($file_gambar_kecamatan_lama != $this->_defaultImg) {
                unlink('img/' . $file_gambar_kecamatan_lama);
            }
        }

        $slug_kecamatan = url_title($this->request->getVar('nama_kecamatan'), '-', true);
        if ($this->_kecamatan_model->save([
            'kecamatan_id' => $id,
            'nama_kecamatan' => $this->request->getVar('nama_kecamatan'),
            // 'isi' => $this->request->getVar('isi'),
            'slug_kecamatan' => $slug_kecamatan,
            'gambar_kecamatan' => $nama_file,
            // 'author_user_id' => $this->request->getVar('author_user_id'),
            'kota_kabupaten_id' => $this->request->getVar('kota_kabupaten_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil diperbaharui!');
        } else session()->setFlashdata('eror', 'Data gagal diperbaharui!');
        return redirect()->to('/kecamatan');
    }
    public function hapus($id)
    {
        $dataKecamatanLama = $this->_kecamatan_model->where(['kecamatan_id' => $id])->first();
        $file_gambar_kecamatan_lama = $dataKecamatanLama['gambar_kecamatan'];
        $this->_kecamatan_model->delete($id);
        session()->setFlashdata('sukses', 'Data berhasil dihapus!');
        if ($file_gambar_kecamatan_lama != $this->_defaultImg) {
            unlink('img/' . $file_gambar_kecamatan_lama);
        }
        return redirect()->to('/kecamatan');
    }
}
