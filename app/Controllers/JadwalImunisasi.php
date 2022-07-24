<?php

namespace App\Controllers;

use App\Models\JadwalImunisasiModel;
use App\Models\JenisImunisasiModel;
use App\Models\KotaKabupatenModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanDesaModel;
use App\Models\FaskesModel;

define('_TITLE', 'Data Jadwal Imunisasi');

class JadwalImunisasi extends BaseController
{
    private $_jadwal_imunisasi_model, $_jenis_imunisasi_model, $_faskes_model;
    private $_defaultImg;
    public function __construct()
    {
        $this->_jadwal_imunisasi_model = new JadwalImunisasiModel();
        $this->_jenis_imunisasi_model = new JenisImunisasiModel();
        $this->_faskes_model = new FaskesModel();
        $this->_defaultImg = "default-img-placeholder.png";

        $this->kotakabupatenModel = new KotaKabupatenModel();
        // $this->kecamatanModel = new KecamatanModel();
        // $this->kelurahandesaModel = new KelurahanDesaModel();
    }
    public function index()
    {
        // $data['title'] = 'Daftar Artikel';
        $data_jadwal_imunisasi = $this->_jadwal_imunisasi_model->getJadwalImunisasi();
        // dd($data_jadwal_imunisasi);
        $data = [
            'title' => _TITLE,
            'data_jadwal_imunisasi' => $data_jadwal_imunisasi
        ];
        // d($data_jadwal_imunisasi);   
        return view('jadwal_imunisasi/index', $data);
    }
    public function detail($slug_jadwal_imunisasi)
    {
        $data_jadwal_imunisasi = $this->_jadwal_imunisasi_model->getJadwalImunisasi($slug_jadwal_imunisasi);
        // dd($data_jadwal_imunisasi);
        $data = [
            'title' => _TITLE,
            'data_jadwal_imunisasi' => $data_jadwal_imunisasi
        ];
        return view('jadwal_imunisasi/detail', $data);
    }
    public function buatBaru()
    {
        // $kotakabupatenModel = new KotaKabupatenModel();
        // $_jenis_imunisasi_model = new JenisImunisasiModel();
        // $data['title'] = 'Dropdown Alamat';
        // $data['kota_kabupaten'] = $kotakabupatenModel->orderBy('nama_kota_kabupaten', 'ASC')->findAll();
        // $data['jenis_imunisasi'] = $_jenis_imunisasi_model->orderBy('nama_jenis_imunisasi')->findAll();
        // $data['validation'] = \Config\Services::validation();


        $data = [
            'title' => _TITLE,
            'jenis_imunisasi' => $this->_jenis_imunisasi_model->orderby('nama_jenis_imunisasi')->findAll(),
            'kota_kabupaten' => $this->kotakabupatenModel->orderBy('nama_kota_kabupaten', 'ASC')->findAll(),
            'faskes' => $this->_faskes_model->orderBy('nama_faskes')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        // dd($data);
        return view('jadwal_imunisasi/buatBaru', $data);
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
            'nama_jadwal_imunisasi' => [
                'rules' => 'required|is_unique[jadwal_imunisasi.nama_jadwal_imunisasi]',
                'label' => 'nama_jadwal_imunisasi',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'isi' => 'required',
            'gambar_jadwal_imunisasi' => [
                'rules' => 'max_size[gambar_jadwal_imunisasi,1024]|is_image[gambar_jadwal_imunisasi]|mime_in[gambar_jadwal_imunisasi,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/jadwal-imunisasi-buat-baru')->withInput();
        }

        $file_gambar_jadwal_imunisasi = $this->request->getFile('gambar_jadwal_imunisasi');
        if ($file_gambar_jadwal_imunisasi->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_jadwal_imunisasi->getRandomName();
            $file_gambar_jadwal_imunisasi->move('img', $nama_file);
        }
        // dd($file_gambar_jadwal_imunisasi);

        // dd($this->request->getVar());
        $slug_jadwal_imunisasi = url_title($this->request->getVar('nama_jadwal_imunisasi'), '-', true);
        if ($this->_jadwal_imunisasi_model->save([
            'slug_jadwal_imunisasi' => $slug_jadwal_imunisasi,
            'nama_jadwal_imunisasi' => $this->request->getVar('nama_jadwal_imunisasi'),
            'jenis_imunisasi' => $this->request->getVar('jenis_imunisasi'),
            'deskripsi_jadwal_imunisasi' => $this->request->getVar('deskripsi_jadwal_imunisasi'),
            'lokasi_faskes_jadwal_imunisasi' => $this->request->getVar('lokasi_faskes_jadwal_imunisasi'),
            'tanggal_jadwal_imunisasi' => $this->request->getVar('tanggal_jadwal_imunisasi'),
            'waktu_jadwal_imunisasi' => $this->request->getVar('waktu_jadwal_imunisasi'),
            'gambar_jadwal_imunisasi' => $nama_file,
            'author_user_id' => $this->request->getVar('author_user_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil ditambahkan!');
        } else session()->setFlashdata('eror', 'Data gagal ditambahkan!');
        return redirect()->to('/jadwal-imunisasi');
    }

    public function ubah($slug_jadwal_imunisasi)
    {
        $data = [
            "title" => _TITLE,
            "result" => $this->_jadwal_imunisasi_model->getJadwalImunisasi($slug_jadwal_imunisasi),
            'jenis_imunisasi' => $this->_jenis_imunisasi_model->orderby('nama_jenis_imunisasi')->findAll(),
            'faskes' => $this->_faskes_model->orderby('nama_faskes')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('jadwal_imunisasi/ubah', $data);
    }
    public function perbaharuiData($id)
    {
        $slug_jadwal_imunisasi_lama = $this->request->getVar('slug_jadwal_imunisasi_lama');
        $dataJadwalImunisasiLama = $this->_jadwal_imunisasi_model->getJadwalImunisasi($slug_jadwal_imunisasi_lama);
        if ($dataJadwalImunisasiLama['nama_jadwal_imunisasi'] === $this->request->getVar('nama_jadwal_imunisasi')) {
            $rule_nama_jadwal_imunisasi = 'required';
        } else {
            $rule_nama_jadwal_imunisasi = 'required|is_unique[jadwal_imunisasi.nama_jadwal_imunisasi]';
        }

        // Validasi Data
        if (!$this->validate([
            'nama_jadwal_imunisasi' => [
                'rules' => $rule_nama_jadwal_imunisasi,
                'label' => 'nama_jadwal_imunisasi',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'isi' => 'required',
            // 'slug_jadwal_imunisasi' => 'required',
            'gambar_jadwal_imunisasi' => [
                'rules' => 'max_size[gambar_jadwal_imunisasi,1024]|is_image[gambar_jadwal_imunisasi]|mime_in[gambar_jadwal_imunisasi,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/jadwal-imunisasi-ubah/' . $slug_jadwal_imunisasi_lama)->withInput();
        }

        // Script untuk mendapatkan gambar artikel
        $file_gambar_jadwal_imunisasi = $this->request->getFile('gambar_jadwal_imunisasi');
        if ($file_gambar_jadwal_imunisasi->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_jadwal_imunisasi->getRandomName();
            $file_gambar_jadwal_imunisasi->move('img', $nama_file);
            $file_gambar_jadwal_imunisasi_lama = $dataJadwalImunisasiLama['gambar_jadwal_imunisasi'];

            if ($file_gambar_jadwal_imunisasi_lama != $this->_defaultImg) {
                unlink('img/' . $file_gambar_jadwal_imunisasi_lama);
            }
        }

        $slug_jadwal_imunisasi = url_title($this->request->getVar('nama_jadwal_imunisasi'), '-', true);
        if ($this->_jadwal_imunisasi_model->save([
            'jadwal_imunisasi_id' => $id,
            'slug_jadwal_imunisasi' => $slug_jadwal_imunisasi,
            'nama_jadwal_imunisasi' => $this->request->getVar('nama_jadwal_imunisasi'),
            'jenis_imunisasi' => $this->request->getVar('jenis_imunisasi'),
            'deskripsi_jadwal_imunisasi' => $this->request->getVar('deskripsi_jadwal_imunisasi'),
            'lokasi_faskes_jadwal_imunisasi' => $this->request->getVar('lokasi_faskes_jadwal_imunisasi'),
            'tanggal_jadwal_imunisasi' => $this->request->getVar('tanggal_jadwal_imunisasi'),
            'waktu_jadwal_imunisasi' => $this->request->getVar('waktu_jadwal_imunisasi'),
            'gambar_jadwal_imunisasi' => $nama_file,
            'author_user_id' => $this->request->getVar('author_user_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil diperbaharui!');
        } else session()->setFlashdata('eror', 'Data gagal diperbaharui!');
        return redirect()->to('/jadwal-imunisasi');
    }
    public function hapus($id)
    {
        $dataJadwalImunisasiLama = $this->_jadwal_imunisasi_model->where(['jadwal_imunisasi_id' => $id])->first();
        $file_gambar_jadwal_imunisasi_lama = $dataJadwalImunisasiLama['gambar_jadwal_imunisasi'];

        $this->_jadwal_imunisasi_model->delete($id);
        session()->setFlashdata('sukses', 'Data berhasil dihapus!');

        if ($file_gambar_jadwal_imunisasi_lama != $this->_defaultImg) {
            unlink('img/' . $file_gambar_jadwal_imunisasi_lama);
        }
        return redirect()->to('/jadwal-imunisasi');
        // }
    }
}
