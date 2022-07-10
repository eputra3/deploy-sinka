<?php

namespace App\Controllers;

use App\Models\FaskesModel;
// use App\Models\IdentitasModel;
// use App\Models\AyahModel;
// use App\Models\IbuModel;
use App\Models\KotaKabupatenModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanDesaModel;

define('_TITLE', 'Data Faskes');

class Faskes extends BaseController
{
    private $_faskes_model, $_ayah_model, $_ibu_model,  $_kota_kabupaten_model, $_kecamatan_model, $_kelurahan_desa_model;
    private $_defaultImg;
    public function __construct()
    {
        $this->_faskes_model = new FaskesModel();
        // $this->_ayah_model = new AyahModel();
        // $this->_ibu_model = new IbuModel();
        $this->_kota_kabupaten_model = new KotaKabupatenModel();
        $this->_kecamatan_model = new KecamatanModel();
        $this->_kelurahan_desa_model = new KelurahanDesaModel();
        $this->_defaultImg = "default-img-placeholder.png";

        $this->kotakabupatenModel = new KotaKabupatenModel();
    }
    public function index()
    {
        // $data['title'] = 'Daftar Artikel';
        $data_faskes = $this->_faskes_model->getFaskes();

        // d($data);
        $data = [
            'title' => _TITLE,
            'data_faskes' => $data_faskes,
        ];
        // d($data);
        return view('faskes/index', $data);
    }
    public function detail($slug_faskes)
    {
        $data_faskes = $this->_faskes_model->getFaskes($slug_faskes);
        $data_kota_kabupaten = $this->_kota_kabupaten_model->getKotaKabupaten();
        $data_kecamatan = $this->_kecamatan_model->getKecamatan();
        $data_kelurahan_desa = $this->_kelurahan_desa_model->getKelurahanDesa();
        // dd($data_faskes);
        $data = [
            'title' => _TITLE,
            'data_faskes' => $data_faskes,
            'data_kota_kabupaten' => $data_kota_kabupaten,
            'data_kecamatan' => $data_kecamatan,
            'data_kelurahan_desa' => $data_kelurahan_desa,
        ];
        // d($data);
        return view('faskes/detail', $data);
    }
    public function buatBaru()
    {
        $data = [
            'title' => _TITLE,
            // 'ayah' => $this->_ayah_model->orderby('nama_ayah')->findAll(),
            // 'ibu' => $this->_ibu_model->orderby('nama_ibu')->findAll(),
            'kota_kabupaten' => $this->kotakabupatenModel->orderBy('nama_kota_kabupaten', 'ASC')->findAll(),
            'validation' => \Config\Services::validation()

        ];
        // d($identitas_model->findAll());
        return view('faskes/buatBaru', $data);
    }
    public function action()
    {
        if ($this->request->getVar('action')) {
            $action = $this->request->getVar('action');

            if ($action == 'get_kecamatan') {
                $kecamatanModel = new KecamatanModel();
                $kecamatandata = $kecamatanModel->where('kota_kabupaten_id', $this->request->getVar('kota_kabupaten_id'))->findAll();

                echo json_encode($kecamatandata);
            }

            if ($action == 'get_kelurahan_desa') {
                $kelurahandesaModel = new KelurahanDesaModel();
                $kelurahandesadata = $kelurahandesaModel->where('kecamatan_id', $this->request->getVar('kecamatan_id'))->findAll();

                echo json_encode($kelurahandesadata);
            }
        }
    }
    public function simpan()
    {
        // Validasi Data
        if (!$this->validate([
            'nama_faskes' => [
                'rules' => 'required|is_unique[faskes.nama_faskes]',
                'label' => 'Nama Anak',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'isi' => 'required',
            'gambar_faskes' => [
                'rules' => 'max_size[gambar_faskes,1024]|is_image[gambar_faskes]|mime_in[gambar_faskes,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/faskes-buat-baru')->withInput();
        }

        $file_gambar_faskes = $this->request->getFile('gambar_faskes');
        if ($file_gambar_faskes->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_faskes->getRandomName();
            $file_gambar_faskes->move('img', $nama_file);
        }
        // dd($file_gambar_faskes);

        // dd($this->request->getVar());
        $slug_faskes = url_title($this->request->getVar('nama_faskes'), '-', true);
        if ($this->_faskes_model->save([
            'slug_faskes' => $slug_faskes,
            'nama_faskes' => $this->request->getVar('nama_faskes'),
            'gambar_faskes' => $nama_file,
            'lat_faskes' => $this->request->getVar('lat_faskes'),
            'lon_faskes' => $this->request->getVar('lon_faskes'),
            'kota_kabupaten' => $this->request->getVar('kota_kabupaten'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kelurahan_desa' => $this->request->getVar('kelurahan_desa'),
            'no_hp_faskes' => $this->request->getVar('no_hp_faskes'),
            'alamat_faskes' => $this->request->getVar('alamat_faskes'),
            'author_user_id' => $this->request->getVar('author_user_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil ditambahkan!');
        } else session()->setFlashdata('eror', 'Data gagal ditambahkan!');
        return redirect()->to('/faskes');
    }

    public function ubah($slug_faskes)
    {
        $data = [
            "title" => _TITLE,
            "result" => $this->_faskes_model->getFaskes($slug_faskes),
            'kota_kabupaten' => $this->kotakabupatenModel->orderBy('nama_kota_kabupaten', 'ASC')->findAll(),
            // 'kota_kabupaten' => $this->_identitas_model->orderby('nama_kota_kabupaten')->findAll(),
            'kecamatan' => $this->_kecamatan_model->orderby('nama_kecamatan')->findAll(),
            'kelurahan_desa' => $this->_kelurahan_desa_model->orderby('nama_kelurahan_desa')->findAll(),
            // 'ayah' => $this->_ayah_model->orderby('nama_ayah')->findAll(),
            // 'ibu' => $this->_ibu_model->orderby('nama_ibu')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('faskes/ubah', $data);
    }
    public function perbaharuiData($id)
    {
        $slug_faskes_lama = $this->request->getVar('slug_faskes_lama');
        $dataFaskesLama = $this->_faskes_model->getFaskes($slug_faskes_lama);
        if ($dataFaskesLama['nama_faskes'] === $this->request->getVar('nama_faskes')) {
            $rule_nama_faskes = 'required';
        } else {
            $rule_nama_faskes = 'required|is_unique[faskes.nama_faskes]';
        }

        // Validasi Data
        if (!$this->validate([
            'nama_faskes' => [
                'rules' => $rule_nama_faskes,
                'label' => 'nama_faskes',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'isi' => 'required',
            // 'slug_faskes' => 'required',
            'gambar_faskes' => [
                'rules' => 'max_size[gambar_faskes,1024]|is_image[gambar_faskes]|mime_in[gambar_faskes,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/faskes-ubah/' . $slug_faskes_lama)->withInput();
        }

        // Script untuk mendapatkan gambar artikel
        $file_gambar_faskes = $this->request->getFile('gambar_faskes');
        if ($file_gambar_faskes->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_faskes->getRandomName();
            $file_gambar_faskes->move('img', $nama_file);
            $file_gambar_faskes_lama = $dataFaskesLama['gambar_faskes'];

            if ($file_gambar_faskes_lama != $this->_defaultImg) {
                unlink('img/' . $file_gambar_faskes_lama);
            }
        }

        $slug_faskes = url_title($this->request->getVar('nama_faskes'), '-', true);
        if ($this->_faskes_model->save([
            'faskes_id' => $id,
            'slug_faskes' => $slug_faskes,
            'nama_faskes' => $this->request->getVar('nama_faskes'),
            'gambar_faskes' => $nama_file,
            'lat_faskes' => $this->request->getVar('lat_faskes'),
            'lon_faskes' => $this->request->getVar('lon_faskes'),
            'kota_kabupaten' => $this->request->getVar('kota_kabupaten'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kelurahan_desa' => $this->request->getVar('kelurahan_desa'),
            'no_hp_faskes' => $this->request->getVar('no_hp_faskes'),
            'alamat_faskes' => $this->request->getVar('alamat_faskes'),
            'author_user_id' => $this->request->getVar('author_user_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil diperbaharui!');
        } else session()->setFlashdata('eror', 'Data gagal diperbaharui!');
        return redirect()->to('/faskes');
    }
    public function hapus($id)
    {
        $dataFaskesLama = $this->_faskes_model->where(['faskes_id' => $id])->first();
        $file_gambar_faskes_lama = $dataFaskesLama['gambar_faskes'];

        $this->_faskes_model->delete($id);
        session()->setFlashdata('sukses', 'Data berhasil dihapus!');

        if ($file_gambar_faskes_lama != $this->_defaultImg) {
            unlink('img/' . $file_gambar_faskes_lama);
        }
        return redirect()->to('/faskes');
    }
}
