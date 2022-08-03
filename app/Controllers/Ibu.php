<?php

namespace App\Controllers;

use App\Models\AyahModel;
use App\Models\IdentitasModel;
use App\Models\PekerjaanModel;
use App\Models\IbuModel;
// use App\Models\KecamatanModel;
// use App\Models\KelurahanDesaModel;

define('_TITLE', 'Data Ibu');

class Ibu extends BaseController
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
        $data_ibu = $this->_ibu_model->getIbu();

        // d($data);
        $data = [
            'title' => _TITLE,
            'data_ibu' => $data_ibu,
        ];
        // d($data);
        return view('ibu/index', $data);
    }
    public function detail($slug_ibu)
    {
        $data_ibu = $this->_ibu_model->getIbu($slug_ibu);
        // $data_identitas = $this->_identitas_model->getIdentitas();
        // $data_pekerjaan = $this->_pekerjaan_model->getPekerjaan();
        // dd($data_ibu);
        $data = [
            'title' => _TITLE,
            'data_ibu' => $data_ibu,
            // 'data_identitas' => $data_identitas,
            // 'data_pekerjaan' => $data_pekerjaan
        ];
        // d($data_ibu);
        return view('ibu/detail', $data);
    }
    public function buatBaru()
    {
        $data = [
            'title' => _TITLE,
            'identitas' => $this->_identitas_model->orderby('nama_identitas')->findAll(),
            'pekerjaan' => $this->_pekerjaan_model->orderby('nama_pekerjaan')->findAll(),
            'ayah' => $this->_ayah_model->orderby('nama_ayah')->findAll(),
            'validation' => \Config\Services::validation()

        ];
        // d($identitas_model->findAll());
        return view('ibu/buatBaru', $data);
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
            'nama_ibu' => [
                'rules' => 'required|is_unique[ibu.nama_ibu]',
                'label' => 'Nama Ibu',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'isi' => 'required',
            'gambar_identitas_ibu' => [
                'rules' => 'max_size[gambar_identitas_ibu,1024]|is_image[gambar_identitas_ibu]|mime_in[gambar_identitas_ibu,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/ibu-buat-baru')->withInput();
        }

        $file_gambar_identitas_ibu = $this->request->getFile('gambar_identitas_ibu');
        if ($file_gambar_identitas_ibu->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_identitas_ibu->getRandomName();
            $file_gambar_identitas_ibu->move('img', $nama_file);
        }
        // dd($file_gambar_identitas_ibu);

        // dd($this->request->getVar());
        $slug_ibu = url_title($this->request->getVar('nama_ibu'), '-', true);
        if ($this->_ibu_model->save([
            'slug_ibu' => $slug_ibu,
            'identitas_ibu' => $this->request->getVar('identitas_ibu'),
            'gambar_identitas_ibu' => $nama_file,
            'nama_ibu' => $this->request->getVar('nama_ibu'),
            'tempat_lahir_ibu' => $this->request->getVar('tempat_lahir_ibu'),
            'tanggal_lahir_ibu' => $this->request->getVar('tanggal_lahir_ibu'),
            'email_ibu' => $this->request->getVar('email_ibu'),
            'no_hp_ibu' => $this->request->getVar('no_hp_ibu'),
            'pekerjaan_ibu' => $this->request->getVar('pekerjaan_ibu'),
            'penghasilan_ibu' => $this->request->getVar('penghasilan_ibu'),
            'alamat_ibu' => $this->request->getVar('alamat_ibu'),
            'suami' => $this->request->getVar('suami'),
            'jumlah_anak_ibu' => $this->request->getVar('jumlah_anak_ibu'),
            'author_user_id' => $this->request->getVar('author_user_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil ditambahkan!');
        } else session()->setFlashdata('eror', 'Data gagal ditambahkan!');
        return redirect()->to('/ibu');
    }

    public function ubah($slug_ibu)
    {
        $data = [
            "title" => _TITLE,
            "result" => $this->_ibu_model->getIbu($slug_ibu),
            'identitas' => $this->_identitas_model->orderby('nama_identitas')->findAll(),
            'pekerjaan' => $this->_pekerjaan_model->orderby('nama_pekerjaan')->findAll(),
            'ayah' => $this->_ayah_model->orderby('nama_ayah')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('ibu/ubah', $data);
    }
    public function perbaharuiData($id)
    {
        $slug_ibu_lama = $this->request->getVar('slug_ibu_lama');
        $dataIbuLama = $this->_ibu_model->getIbu($slug_ibu_lama);
        if ($dataIbuLama['nama_ibu'] === $this->request->getVar('nama_ibu')) {
            $rule_nama_ibu = 'required';
        } else {
            $rule_nama_ibu = 'required|is_unique[ibu.nama_ibu]';
        }

        // Validasi Data
        if (!$this->validate([
            'nama_ibu' => [
                'rules' => $rule_nama_ibu,
                'label' => 'nama_ibu',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'isi' => 'required',
            // 'slug_ibu' => 'required',
            'gambar_identitas_ibu' => [
                'rules' => 'max_size[gambar_identitas_ibu,1024]|is_image[gambar_identitas_ibu]|mime_in[gambar_identitas_ibu,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/ibu-ubah/' . $slug_ibu_lama)->withInput();
        }

        // Script untuk mendapatkan gambar artikel
        $file_gambar_identitas_ibu = $this->request->getFile('gambar_identitas_ibu');
        if ($file_gambar_identitas_ibu->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_identitas_ibu->getRandomName();
            $file_gambar_identitas_ibu->move('img', $nama_file);
            $file_gambar_identitas_ibu_lama = $dataIbuLama['gambar_identitas_ibu'];

            if ($file_gambar_identitas_ibu_lama != $this->_defaultImg) {
                unlink('img/' . $file_gambar_identitas_ibu_lama);
            }
        }

        $slug_ibu = url_title($this->request->getVar('nama_ibu'), '-', true);
        if ($this->_ibu_model->save([
            'ibu_id' => $id,
            'slug_ibu' => $slug_ibu,
            'identitas_ibu' => $this->request->getVar('identitas_ibu'),
            'gambar_identitas_ibu' => $nama_file,
            'nama_ibu' => $this->request->getVar('nama_ibu'),
            'tempat_lahir_ibu' => $this->request->getVar('tempat_lahir_ibu'),
            'tanggal_lahir_ibu' => $this->request->getVar('tanggal_lahir_ibu'),
            'email_ibu' => $this->request->getVar('email_ibu'),
            'no_hp_ibu' => $this->request->getVar('no_hp_ibu'),
            'pekerjaan_ibu' => $this->request->getVar('pekerjaan_ibu'),
            'penghasilan_ibu' => $this->request->getVar('penghasilan_ibu'),
            'alamat_ibu' => $this->request->getVar('alamat_ibu'),
            'suami' => $this->request->getVar('suami'),
            'jumlah_anak_ibu' => $this->request->getVar('jumlah_anak_ibu'),
            'author_user_id' => $this->request->getVar('author_user_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil diperbaharui!');
        } else session()->setFlashdata('eror', 'Data gagal diperbaharui!');
        return redirect()->to('/ibu');
    }
    public function hapus($id)
    {
        $dataIbuLama = $this->_ibu_model->where(['ibu_id' => $id])->first();
        $file_gambar_identitas_ibu_lama = $dataIbuLama['gambar_identitas_ibu'];

        $this->_ibu_model->delete($id);
        session()->setFlashdata('sukses', 'Data berhasil dihapus!');

        if ($file_gambar_identitas_ibu_lama != $this->_defaultImg) {
            unlink('img/' . $file_gambar_identitas_ibu_lama);
        }
        return redirect()->to('/ibu');
    }
}
