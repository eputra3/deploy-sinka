<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalImunisasiModel extends Model
{
    protected $table = 'jadwal_imunisasi';
    protected $primaryKey = 'jadwal_imunisasi_id';
    // protected $useTimestamps = true;
    protected $allowedFields = ['nama_jadwal_imunisasi', 'jenis_imunisasi', 'tanggal_jadwal_imunisasi', 'waktu_jadwal_imunisasi', 'deskripsi_jadwal_imunisasi', 'gambar_jadwal_imunisasi', 'slug_jadwal_imunisasi', 'lokasi_faskes_jadwal_imunisasi', 'author_user_id'];

    public function getJadwalImunisasi($slug_jadwal_imunisasi = null)
    {
        if ($slug_jadwal_imunisasi === null) {
            $this->join('users', 'jadwal_imunisasi.author_user_id = users.id');
            $this->join('jenis_imunisasi', 'jenis_imunisasi.jenis_imunisasi_id = jadwal_imunisasi.jenis_imunisasi');
            // $this->join('faskes', 'faskes.faskes_id = jadwal_imunisasi.lokasi_faskes_jadwal_imunisasi');
            $this->join('faskes', 'faskes.faskes_id = jadwal_imunisasi.lokasi_faskes_jadwal_imunisasi');
            return $this->get()->getResultArray();
        } else {
            $this->join('users', 'jadwal_imunisasi.author_user_id = users.id');
            $this->join('jenis_imunisasi', 'jenis_imunisasi.jenis_imunisasi_id = jadwal_imunisasi.jenis_imunisasi');
            $this->join('faskes', 'faskes.faskes_id = jadwal_imunisasi.lokasi_faskes_jadwal_imunisasi');
            $this->where(['slug_jadwal_imunisasi' => $slug_jadwal_imunisasi]);
            return $this->first();
        }
    }
}
