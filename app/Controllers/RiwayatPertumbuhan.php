<?php

namespace App\Controllers;

use App\Models\RiwayatPertumbuhanModel;
use App\Models\AnakModel;
use App\Models\JenisImunisasiModel;
use App\Models\FaskesModel;
// use App\Models\KecamatanModel;
// use App\Models\KelurahanDesaModel;

define('_TITLE', 'Data Riwayat Pertumbuhan');

class RiwayatPertumbuhan extends BaseController
{
    private $_riwayat_pertumbuhan_model, $_anak_model, $_jenis_imunisasi_model, $_faskes_model;
    private $_defaultImg;
    public function __construct()
    {
        $this->_riwayat_pertumbuhan_model = new RiwayatPertumbuhanModel();
        $this->_anak_model = new AnakModel();
        $this->_jenis_imunisasi_model = new JenisImunisasiModel();
        $this->_faskes_model = new FaskesModel();
        $this->_defaultImg = "default-idcard-placeholder.png";

        // $this->kotakabupatenModel = new KotaKabupatenModel();
    }
    public function index()
    {
        // $data['title'] = 'Daftar Artikel';
        $data_riwayat_pertumbuhan = $this->_riwayat_pertumbuhan_model->getRiwayatImunisasi();

        // d($data);
        $data = [
            'title' => _TITLE,
            'data_riwayat_pertumbuhan' => $data_riwayat_pertumbuhan,
        ];
        // d($data);
        return view('riwayat_pertumbuhan/index', $data);
    }
    public function detail($slug_riwayat_pertumbuhan)
    {
        $data_riwayat_pertumbuhan = $this->_riwayat_pertumbuhan_model->getRiwayatImunisasi($slug_riwayat_pertumbuhan);
        $data_anak = $this->_anak_model->getAnak();
        // $data_jenis_imunisasi = $this->_jenis_imunisasi_model->getJenisImunisasi();
        $data_faskes = $this->_faskes_model->getFaskes();
        // dd($data_riwayat_pertumbuhan);
        $data = [
            'title' => _TITLE,
            'data_riwayat_pertumbuhan' => $data_riwayat_pertumbuhan,
            'data_anak' => $data_anak,
            // 'data_jenis_imunisasi' => $data_jenis_imunisasi,
            'data_faskes' => $data_faskes
        ];
        // d($data_riwayat_pertumbuhan);
        return view('riwayat_pertumbuhan/detail', $data);
    }
    public function buatBaru()
    {
        $data = [
            'title' => _TITLE,
            'anak' => $this->_anak_model->orderby('nama_anak')->findAll(),
            // 'jenis_imunisasi' => $this->_jenis_imunisasi_model->orderby('nama_jenis_imunisasi')->findAll(),
            'faskes' => $this->_faskes_model->orderby('nama_faskes')->findAll(),
            'validation' => \Config\Services::validation()

        ];
        // d($identitas_model->findAll());
        return view('riwayat_pertumbuhan/buatBaru', $data);
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
            'judul_riwayat_pertumbuhan' => [
                'rules' => 'required|is_unique[riwayat_pertumbuhan.judul_riwayat_pertumbuhan]',
                'label' => 'Judul Riwayat Pertumbuhan',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'isi' => 'required',
            'gambar_riwayat_pertumbuhan' => [
                'rules' => 'max_size[gambar_riwayat_pertumbuhan,1024]|is_image[gambar_riwayat_pertumbuhan]|mime_in[gambar_riwayat_pertumbuhan,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/riwayat-pertumbuhan-buat-baru')->withInput();
        }

        $file_gambar_riwayat_pertumbuhan = $this->request->getFile('gambar_riwayat_pertumbuhan');
        if ($file_gambar_riwayat_pertumbuhan->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_riwayat_pertumbuhan->getRandomName();
            $file_gambar_riwayat_pertumbuhan->move('img', $nama_file);
        }
        // dd($file_gambar_riwayat_pertumbuhan);

        // dd($this->request->getVar());
        $slug_riwayat_pertumbuhan = url_title($this->request->getVar('judul_riwayat_pertumbuhan'), '-', true);
        if ($this->_riwayat_pertumbuhan_model->save([
            'slug_riwayat_pertumbuhan' => $slug_riwayat_pertumbuhan,
            'judul_riwayat_pertumbuhan' => $this->request->getVar('judul_riwayat_pertumbuhan'),
            'gambar_riwayat_pertumbuhan' => $nama_file,
            'id_anak' => $this->request->getVar('id_anak'),
            'id_lokasi_faskes' => $this->request->getVar('id_lokasi_faskes'),
            'tanggal_riwayat_pertumbuhan' => $this->request->getVar('tanggal_riwayat_pertumbuhan'),
            'tinggi_panjang_badan' => $this->request->getVar('tinggi_panjang_badan'),
            'berat_badan' => $this->request->getVar('berat_badan'),
            'lingkar_lengan' => $this->request->getVar('lingkar_lengan'),
            'lingkar_kepala' => $this->request->getVar('lingkar_kepala'),
            'catatan_riwayat_pertumbuhan' => $this->request->getVar('catatan_riwayat_pertumbuhan'),
            'author_user_id' => $this->request->getVar('author_user_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil ditambahkan!');
        } else session()->setFlashdata('eror', 'Data gagal ditambahkan!');
        return redirect()->to('/riwayat-pertumbuhan');
    }

    public function ubah($slug_riwayat_pertumbuhan)
    {
        $data = [
            "title" => _TITLE,
            "result" => $this->_riwayat_pertumbuhan_model->getRiwayatImunisasi($slug_riwayat_pertumbuhan),
            'anak' => $this->_anak_model->orderby('nama_anak')->findAll(),
            // 'jenis_imunisasi' => $this->_jenis_imunisasi_model->orderby('nama_jenis_imunisasi')->findAll(),
            'faskes' => $this->_faskes_model->orderby('nama_faskes')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('riwayat_imunisasi/ubah', $data);
    }
    public function perbaharuiData($id)
    {
        $slug_riwayat_pertumbuhan_lama = $this->request->getVar('slug_riwayat_pertumbuhan_lama');
        $dataRiwayatPertumbuhanLama = $this->_riwayat_pertumbuhan_model->getRiwayatImunisasi($slug_riwayat_pertumbuhan_lama);
        if ($dataRiwayatPertumbuhanLama['judul_riwayat_pertumbuhan'] === $this->request->getVar('judul_riwayat_pertumbuhan')) {
            $rule_judul_riwayat_pertumbuhan = 'required';
        } else {
            $rule_judul_riwayat_pertumbuhan = 'required|is_unique[riwayat_imunisasi.judul_riwayat_pertumbuhan]';
        }

        // Validasi Data
        if (!$this->validate([
            'judul_riwayat_pertumbuhan' => [
                'rules' => $rule_judul_riwayat_pertumbuhan,
                'label' => 'Judul Riwayat Pertumbuhan',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            // 'isi' => 'required',
            // 'slug_riwayat_pertumbuhan' => 'required',
            'gambar_riwayat_pertumbuhan' => [
                'rules' => 'max_size[gambar_riwayat_pertumbuhan,1024]|is_image[gambar_riwayat_pertumbuhan]|mime_in[gambar_riwayat_pertumbuhan,image/jpg,image/jpeg,image/png]',
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
            return redirect()->to('/riwayat-pertumbuhan-ubah/' . $slug_riwayat_pertumbuhan_lama)->withInput();
        }

        // Script untuk mendapatkan gambar artikel
        $file_gambar_riwayat_pertumbuhan = $this->request->getFile('gambar_riwayat_pertumbuhan');
        if ($file_gambar_riwayat_pertumbuhan->getError() === 4) //Tidak ada file yang diunggah
        {
            $nama_file = $this->_defaultImg;
        } else {
            $nama_file = $file_gambar_riwayat_pertumbuhan->getRandomName();
            $file_gambar_riwayat_pertumbuhan->move('img', $nama_file);
            $file_gambar_riwayat_pertumbuhan_lama = $dataRiwayatPertumbuhanLama['gambar_riwayat_pertumbuhan'];

            if ($file_gambar_riwayat_pertumbuhan_lama != $this->_defaultImg) {
                unlink('img/' . $file_gambar_riwayat_pertumbuhan_lama);
            }
        }

        $slug_riwayat_pertumbuhan = url_title($this->request->getVar('judul_riwayat_pertumbuhan'), '-', true);
        if ($this->_riwayat_pertumbuhan_model->save([
            'riwayat_pertumbuhan_id' => $id,
            'slug_riwayat_pertumbuhan' => $slug_riwayat_pertumbuhan,
            'judul_riwayat_pertumbuhan' => $this->request->getVar('judul_riwayat_pertumbuhan'),
            'gambar_riwayat_pertumbuhan' => $nama_file,
            'id_anak' => $this->request->getVar('id_anak'),
            'id_lokasi_faskes' => $this->request->getVar('id_lokasi_faskes'),
            'tanggal_riwayat_pertumbuhan' => $this->request->getVar('tanggal_riwayat_pertumbuhan'),
            'tinggi_panjang_badan' => $this->request->getVar('tinggi_panjang_badan'),
            'berat_badan' => $this->request->getVar('berat_badan'),
            'lingkar_lengan' => $this->request->getVar('lingkar_lengan'),
            'lingkar_kepala' => $this->request->getVar('lingkar_kepala'),
            'catatan_riwayat_pertumbuhan' => $this->request->getVar('catatan_riwayat_pertumbuhan'),
            'author_user_id' => $this->request->getVar('author_user_id')
        ])) {
            session()->setFlashdata('sukses', 'Data berhasil diperbaharui!');
        } else session()->setFlashdata('eror', 'Data gagal diperbaharui!');
        return redirect()->to('/riwayat-pertumbuhan');
    }
    public function hapus($id)
    {
        $dataRiwayatPertumbuhanLama = $this->_riwayat_pertumbuhan_model->where(['riwayat_pertumbuhan_id' => $id])->first();
        $file_gambar_riwayat_pertumbuhan_lama = $dataRiwayatPertumbuhanLama['gambar_riwayat_pertumbuhan'];

        $this->_riwayat_pertumbuhan_model->delete($id);
        session()->setFlashdata('sukses', 'Data berhasil dihapus!');

        if ($file_gambar_riwayat_pertumbuhan_lama != $this->_defaultImg) {
            unlink('img/' . $file_gambar_riwayat_pertumbuhan_lama);
        }
        return redirect()->to('/riwayat-pertumbuhan');
    }
}
