<?php

namespace App\Controllers;

use App\Models\AyahModel;
use App\Models\IdentitasModel;
use App\Models\PekerjaanModel;
use App\Models\IbuModel;
// use App\Models\KecamatanModel;
// use App\Models\KelurahanDesaModel;

define('_TITLE', 'Data Ayah');

class Ayah extends BaseController
{
    private $_ayah_model, $_identitas_model, $_pekerjaan_model, $_ibu_model;
    private $_defaultImg;
    public function __construct()
    {
        $this->_ayah_model = new AyahModel();
        $this->_identitas_model = new IdentitasModel();
        $this->_pekerjaan_model = new PekerjaanModel();
        $this->_ibu_model = new IbuModel();
        $this->_defaultImg = "default-idcard-placeholder.png";

        // $this->kotakabupatenModel = new KotaKabupatenModel();
    }
    public function index()
    {
        // $data['title'] = 'Daftar Artikel';
        $data_ayah = $this->_ayah_model->getAyah();

        // d($data);
        $data = [
            'title' => _TITLE,
            'data_ayah' => $data_ayah,
        ];
        // d($data);
        return view('ayah/index', $data);
    }
    public function detail($slug_ayah)
    {
        $data_ayah = $this->_ayah_model->getAyah($slug_ayah);
        // $data_identitas = $this->_identitas_model->getIdentitas();
        // $data_pekerjaan = $this->_pekerjaan_model->getPekerjaan();
        // dd($data_ayah);
        $data = [
            'title' => _TITLE,
            'data_ayah' => $data_ayah,
            // 'data_identitas' => $data_identitas,
            // 'data_pekerjaan' => $data_pekerjaan
        ];
        // d($data_ayah);
        return view('ayah/detail', $data);
    }
    public function buatBaru()
    {
        $data = [
            'title' => _TITLE,
            'identitas' => $this->_identitas_model->orderby('nama_identitas')->findAll(),
            'pekerjaan' => $this->_pekerjaan_model->orderby('nama_pekerjaan')->findAll(),
            'ibu' => $this->_ibu_model->orderby('nama_ibu')->findAll(),
            'validation' => \Config\Services::validation()

        ];
        // d($identitas_model->findAll());
        return view('ayah/buatBaru', $data);
    }
    // public function action()
    // {
    //     if ($this->request->getVar('action')) {
    //         $action = $this->request->getVar('action');

    //         if ($action == 'get_kecamatan') {
    //             $kecamatanModel = new KecamatanModel();
    //             $kecamatandata = $kecamatanModel->where('kota_kabupaten_id', $this->request->getVar('kota_kabupaten_id'))->findAll();

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
            'nama_ayah' => [
                'rules' => 'required|is_unique[ayah.nama_ayah]',
                'label' => 'Nama Ayah',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'isi' => 'required',
            'gambar_identitas_ayah' => [
                'rules' => 'max_size[gambar_identitas_ayah,1024]|is_image[gambar_identitas_ayah]|mime_in[gambar_identitas_ayah,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/ayah-buat-baru')->withInput();
        }

        $file_gambar_identitas_ayah = $this->request->getFile('gambar_identitas_ayah');
        if ($file_gambar_identitas_ayah->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_identitas_ayah->getRandomName();
            $file_gambar_identitas_ayah->move('img', $nama_file);
        }
        // dd($file_gambar_identitas_ayah);

        // dd($this->request->getVar());
        $slug_ayah = url_title($this->request->getVar('nama_ayah'), '-', true);
        if ($this->_ayah_model->save([
            'slug_ayah' => $slug_ayah,
            'identitas_ayah' => $this->request->getVar('identitas_ayah'),
            'gambar_identitas_ayah' => $nama_file,
            'nama_ayah' => $this->request->getVar('nama_ayah'),
            'tempat_lahir_ayah' => $this->request->getVar('tempat_lahir_ayah'),
            'tanggal_lahir_ayah' => $this->request->getVar('tanggal_lahir_ayah'),
            'email_ayah' => $this->request->getVar('email_ayah'),
            'no_hp_ayah' => $this->request->getVar('no_hp_ayah'),
            'pekerjaan_ayah' => $this->request->getVar('pekerjaan_ayah'),
            'penghasilan_ayah' => $this->request->getVar('penghasilan_ayah'),
            'alamat_ayah' => $this->request->getVar('alamat_ayah'),
            'istri' => $this->request->getVar('istri'),
            'jumlah_anak_ayah' => $this->request->getVar('jumlah_anak_ayah'),
            'author_user_id' => $this->request->getVar('author_user_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil ditambahkan!');
        } else session()->setFlashdata('eror', 'Data gagal ditambahkan!');
        return redirect()->to('/ayah');
    }

    public function ubah($slug_ayah)
    {
        $data = [
            "title" => _TITLE,
            "result" => $this->_ayah_model->getAyah($slug_ayah),
            'identitas' => $this->_identitas_model->orderby('nama_identitas')->findAll(),
            'pekerjaan' => $this->_pekerjaan_model->orderby('nama_pekerjaan')->findAll(),
            'ibu' => $this->_ibu_model->orderby('nama_ibu')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('ayah/ubah', $data);
    }
    public function perbaharuiData($id)
    {
        $slug_ayah_lama = $this->request->getVar('slug_ayah_lama');
        $dataAyahLama = $this->_ayah_model->getAyah($slug_ayah_lama);
        if ($dataAyahLama['nama_ayah'] === $this->request->getVar('nama_ayah')) {
            $rule_nama_ayah = 'required';
        } else {
            $rule_nama_ayah = 'required|is_unique[ayah.nama_ayah]';
        }

        // Validasi Data
        if (!$this->validate([
            'nama_ayah' => [
                'rules' => $rule_nama_ayah,
                'label' => 'nama_ayah',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'isi' => 'required',
            // 'slug_ayah' => 'required',
            'gambar_identitas_ayah' => [
                'rules' => 'max_size[gambar_identitas_ayah,1024]|is_image[gambar_identitas_ayah]|mime_in[gambar_identitas_ayah,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/ayah-ubah/' . $slug_ayah_lama)->withInput();
        }

        // Script untuk mendapatkan gambar artikel
        $file_gambar_identitas_ayah = $this->request->getFile('gambar_identitas_ayah');
        if ($file_gambar_identitas_ayah->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_identitas_ayah->getRandomName();
            $file_gambar_identitas_ayah->move('img', $nama_file);
            $file_gambar_identitas_ayah_lama = $dataAyahLama['gambar_identitas_ayah'];

            if ($file_gambar_identitas_ayah_lama != $this->_defaultImg) {
                unlink('img/' . $file_gambar_identitas_ayah_lama);
            }
        }

        $slug_ayah = url_title($this->request->getVar('nama_ayah'), '-', true);
        if ($this->_ayah_model->save([
            'ayah_id' => $id,
            'slug_ayah' => $slug_ayah,
            'identitas_ayah' => $this->request->getVar('identitas_ayah'),
            'gambar_identitas_ayah' => $nama_file,
            'nama_ayah' => $this->request->getVar('nama_ayah'),
            'tempat_lahir_ayah' => $this->request->getVar('tempat_lahir_ayah'),
            'tanggal_lahir_ayah' => $this->request->getVar('tanggal_lahir_ayah'),
            'email_ayah' => $this->request->getVar('email_ayah'),
            'no_hp_ayah' => $this->request->getVar('no_hp_ayah'),
            'pekerjaan_ayah' => $this->request->getVar('pekerjaan_ayah'),
            'penghasilan_ayah' => $this->request->getVar('penghasilan_ayah'),
            'alamat_ayah' => $this->request->getVar('alamat_ayah'),
            'istri' => $this->request->getVar('istri'),
            'jumlah_anak_ayah' => $this->request->getVar('jumlah_anak_ayah'),
            'author_user_id' => $this->request->getVar('author_user_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil diperbaharui!');
        } else session()->setFlashdata('eror', 'Data gagal diperbaharui!');
        return redirect()->to('/ayah');
    }
    public function hapus($id)
    {
        $dataAyahLama = $this->_ayah_model->where(['ayah_id' => $id])->first();
        $file_gambar_identitas_ayah_lama = $dataAyahLama['gambar_identitas_ayah'];

        $this->_ayah_model->delete($id);
        session()->setFlashdata('sukses', 'Data berhasil dihapus!');

        if ($file_gambar_identitas_ayah_lama != $this->_defaultImg) {
            unlink('img/' . $file_gambar_identitas_ayah_lama);
        }
        return redirect()->to('/ayah');
    }
}
