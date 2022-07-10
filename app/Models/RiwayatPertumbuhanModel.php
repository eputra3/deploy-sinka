<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatPertumbuhanModel extends Model
{
    protected $table = 'riwayat_pertumbuhan';
    protected $primaryKey = 'riwayat_pertumbuhan_id ';
    protected $allowedFields = ['judul_riwayat_pertumbuhan', 'id_anak', 'id_lokasi_faskes', 'tanggal_riwayat_pertumbuhan', 'tinggi_panjang_badan', 'berat_badan', 'lingkar_lengan', 'lingkar_kepala', 'catatan_riwayat_pertumbuhan', 'gambar_riwayat_pertumbuhan', 'slug_riwayat_pertumbuhan', 'author_user_id'];

    public function getRiwayatImunisasi($slug_riwayat_pertumbuhan = null)
    {
        if ($slug_riwayat_pertumbuhan === null) {
            // $this->join('users', 'anak.author_user_id = users.id');
            $this->join('anak', 'anak.anak_id = riwayat_pertumbuhan.id_anak');
            // $this->join('jenis_imunisasi', 'jenis_imunisasi.jenis_imunisasi_id = riwayat_imunisasi.id_jenis_imunisasi');
            $this->join('faskes', 'faskes.faskes_id = riwayat_pertumbuhan.id_lokasi_faskes');
            return $this->get()->getResultArray();
        } else {
            // $this->join('users', 'anak.author_user_id = users.id');
            $this->join('anak', 'anak.anak_id = riwayat_pertumbuhan.id_anak');
            // $this->join('jenis_imunisasi', 'jenis_imunisasi.jenis_imunisasi_id = riwayat_imunisasi.id_jenis_imunisasi');
            $this->join('faskes', 'faskes.faskes_id = riwayat_pertumbuhan.id_lokasi_faskes');
            $this->where(['slug_riwayat_pertumbuhan' => $slug_riwayat_pertumbuhan]);
            return $this->first();
        }
    }
}
