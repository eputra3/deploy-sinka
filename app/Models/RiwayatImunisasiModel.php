<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatImunisasiModel extends Model
{
    protected $table = 'riwayat_imunisasi';
    protected $primaryKey = 'riwayat_imunisasi_id ';
    protected $allowedFields = ['judul_riwayat_imunisasi', 'id_anak', 'id_jenis_imunisasi', 'id_lokasi_faskes', 'tanggal_riwayat_imunisasi', 'catatan_riwayat_imunisasi', 'gambar_riwayat_imunisasi', 'slug_riwayat_imunisasi', 'author_user_id'];

    public function getRiwayatImunisasi($slug_riwayat_imunisasi = null)
    {
        if ($slug_riwayat_imunisasi === null) {
            // $this->join('users', 'anak.author_user_id = users.id');
            $this->join('anak', 'anak.anak_id = riwayat_imunisasi.id_anak');
            $this->join('jenis_imunisasi', 'jenis_imunisasi.jenis_imunisasi_id = riwayat_imunisasi.id_jenis_imunisasi');
            $this->join('faskes', 'faskes.faskes_id = riwayat_imunisasi.id_lokasi_faskes');
            return $this->get()->getResultArray();
        } else {
            // $this->join('users', 'anak.author_user_id = users.id');
            $this->join('anak', 'anak.anak_id = riwayat_imunisasi.id_anak');
            $this->join('jenis_imunisasi', 'jenis_imunisasi.jenis_imunisasi_id = riwayat_imunisasi.id_jenis_imunisasi');
            $this->join('faskes', 'faskes.faskes_id = riwayat_imunisasi.id_lokasi_faskes');
            $this->where(['slug_riwayat_imunisasi' => $slug_riwayat_imunisasi]);
            return $this->first();
        }
    }
}
