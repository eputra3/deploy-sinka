<?php

namespace App\Controllers;

use App\Models\AnakModel;
// use App\Models\IdentitasModel;
use App\Models\AyahModel;
use App\Models\IbuModel;
use App\Models\KotaKabupatenModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanDesaModel;

define('_TITLE', 'Data Anak');

class Anak extends BaseController
{
    private $_anak_model, $_ayah_model, $_ibu_model,  $_kota_kabupaten_model, $_kecamatan_model, $_kelurahan_desa_model;
    private $_defaultImg;
    public function __construct()
    {
        $this->_anak_model = new AnakModel();
        $this->_ayah_model = new AyahModel();
        $this->_ibu_model = new IbuModel();
        $this->_kota_kabupaten_model = new KotaKabupatenModel();
        $this->_kecamatan_model = new KecamatanModel();
        $this->_kelurahan_desa_model = new KelurahanDesaModel();
        $this->_defaultImg = "default-img-placeholder.png";

        $this->kotakabupatenModel = new KotaKabupatenModel();
    }
    public function index()
    {
        // $data['title'] = 'Daftar Artikel';
        $data_anak = $this->_anak_model->getAnak();

        // d($data);
        $data = [
            'title' => _TITLE,
            'data_anak' => $data_anak,
        ];
        // d($data);
        return view('anak/index', $data);
    }
    public function detail($slug_anak)
    {
        $data_anak = $this->_anak_model->getAnak($slug_anak);
        $data_kota_kabupaten = $this->_kota_kabupaten_model->getKotaKabupaten();
        $data_kecamatan = $this->_kecamatan_model->getKecamatan();
        $data_kelurahan_desa = $this->_kelurahan_desa_model->getKelurahanDesa();
        // dd($data_anak);
        $data = [
            'title' => _TITLE,
            'data_anak' => $data_anak,
            'data_kota_kabupaten' => $data_kota_kabupaten,
            'data_kecamatan' => $data_kecamatan,
            'data_kelurahan_desa' => $data_kelurahan_desa,
        ];
        // d($data);
        return view('anak/detail', $data);
    }
    public function buatBaru()
    {
        $data = [
            'title' => _TITLE,
            'ayah' => $this->_ayah_model->orderby('nama_ayah')->findAll(),
            'ibu' => $this->_ibu_model->orderby('nama_ibu')->findAll(),
            'kota_kabupaten' => $this->kotakabupatenModel->orderBy('nama_kota_kabupaten', 'ASC')->findAll(),
            'validation' => \Config\Services::validation()

        ];
        // d($identitas_model->findAll());
        return view('anak/buatBaru', $data);
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
            'nama_anak' => [
                'rules' => 'required|is_unique[anak.nama_anak]',
                'label' => 'Nama Anak',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'isi' => 'required',
            'gambar_anak' => [
                'rules' => 'max_size[gambar_anak,1024]|is_image[gambar_anak]|mime_in[gambar_anak,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/anak-buat-baru')->withInput();
        }

        $file_gambar_anak = $this->request->getFile('gambar_anak');
        if ($file_gambar_anak->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_anak->getRandomName();
            $file_gambar_anak->move('img', $nama_file);
        }
        // dd($file_gambar_anak);

        // dd($this->request->getVar());
        $slug_anak = url_title($this->request->getVar('nama_anak'), '-', true);
        if ($this->_anak_model->save([
            'slug_anak' => $slug_anak,
            'nama_anak' => $this->request->getVar('nama_anak'),
            'jenis_kelamin_anak' => $this->request->getVar('jenis_kelamin_anak'),
            'gambar_anak' => $nama_file,
            'tempat_lahir_anak' => $this->request->getVar('tempat_lahir_anak'),
            'tanggal_lahir_anak' => $this->request->getVar('tanggal_lahir_anak'),
            'kota_kabupaten' => $this->request->getVar('kota_kabupaten'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kelurahan_desa' => $this->request->getVar('kelurahan_desa'),
            'alamat_anak' => $this->request->getVar('alamat_anak'),
            'ayah' => $this->request->getVar('ayah'),
            'ibu' => $this->request->getVar('ibu'),
            'author_user_id' => $this->request->getVar('author_user_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil ditambahkan!');
        } else session()->setFlashdata('eror', 'Data gagal ditambahkan!');
        return redirect()->to('/anak');
    }

    public function ubah($slug_anak)
    {
        $data = [
            "title" => _TITLE,
            "result" => $this->_anak_model->getAnak($slug_anak),
            'kota_kabupaten' => $this->kotakabupatenModel->orderBy('nama_kota_kabupaten', 'ASC')->findAll(),
            // 'kota_kabupaten' => $this->_identitas_model->orderby('nama_kota_kabupaten')->findAll(),
            'kecamatan' => $this->_kecamatan_model->orderby('nama_kecamatan')->findAll(),
            'kelurahan_desa' => $this->_kelurahan_desa_model->orderby('nama_kelurahan_desa')->findAll(),
            'ayah' => $this->_ayah_model->orderby('nama_ayah')->findAll(),
            'ibu' => $this->_ibu_model->orderby('nama_ibu')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('anak/ubah', $data);
    }
    public function perbaharuiData($id)
    {
        $slug_anak_lama = $this->request->getVar('slug_anak_lama');
        $dataAnakLama = $this->_anak_model->getAnak($slug_anak_lama);
        if ($dataAnakLama['nama_anak'] === $this->request->getVar('nama_anak')) {
            $rule_nama_anak = 'required';
        } else {
            $rule_nama_anak = 'required|is_unique[anak.nama_anak]';
        }

        // Validasi Data
        if (!$this->validate([
            'nama_anak' => [
                'rules' => $rule_nama_anak,
                'label' => 'nama_anak',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'isi' => 'required',
            // 'slug_anak' => 'required',
            'gambar_anak' => [
                'rules' => 'max_size[gambar_anak,1024]|is_image[gambar_anak]|mime_in[gambar_anak,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/anak-ubah/' . $slug_anak_lama)->withInput();
        }

        // Script untuk mendapatkan gambar artikel
        $file_gambar_anak = $this->request->getFile('gambar_anak');
        if ($file_gambar_anak->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_anak->getRandomName();
            $file_gambar_anak->move('img', $nama_file);
            $file_gambar_anak_lama = $dataAnakLama['gambar_anak'];

            if ($file_gambar_anak_lama != $this->_defaultImg) {
                unlink('img/' . $file_gambar_anak_lama);
            }
        }

        $slug_anak = url_title($this->request->getVar('nama_anak'), '-', true);
        if ($this->_anak_model->save([
            'anak_id' => $id,
            'slug_anak' => $slug_anak,
            'nama_anak' => $this->request->getVar('nama_anak'),
            'jenis_kelamin_anak' => $this->request->getVar('jenis_kelamin_anak'),
            'gambar_anak' => $nama_file,
            'tempat_lahir_anak' => $this->request->getVar('tempat_lahir_anak'),
            'tanggal_lahir_anak' => $this->request->getVar('tanggal_lahir_anak'),
            'kota_kabupaten' => $this->request->getVar('kota_kabupaten'),
            'kecamatan' => $this->request->getVar('kecamatan'),
            'kelurahan_desa' => $this->request->getVar('kelurahan_desa'),
            'alamat_anak' => $this->request->getVar('alamat_anak'),
            'ayah' => $this->request->getVar('ayah'),
            'ibu' => $this->request->getVar('ibu'),
            'author_user_id' => $this->request->getVar('author_user_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil diperbaharui!');
        } else session()->setFlashdata('eror', 'Data gagal diperbaharui!');
        return redirect()->to('/anak');
    }
    public function hapus($id)
    {
        $dataAnakLama = $this->_anak_model->where(['anak_id' => $id])->first();
        $file_gambar_anak_lama = $dataAnakLama['gambar_anak'];

        $this->_anak_model->delete($id);
        session()->setFlashdata('sukses', 'Data berhasil dihapus!');

        if ($file_gambar_anak_lama != $this->_defaultImg) {
            unlink('img/' . $file_gambar_anak_lama);
        }
        return redirect()->to('/anak');
    }
}
