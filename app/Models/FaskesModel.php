<?php

namespace App\Models;

use CodeIgniter\Model;

class FaskesModel extends Model
{
    protected $table = 'faskes';
    protected $primaryKey = 'faskes_id';
    protected $allowedFields = ['nama_faskes', 'lat_faskes', 'lon_faskes', 'kota_kabupaten', 'kecamatan', 'kelurahan_desa', 'no_hp_faskes', 'alamat_faskes', 'gambar_faskes', 'slug_faskes', 'author_user_id'];

    public function getFaskes($slug_faskes = null)
    {
        if ($slug_faskes === null) {
            $this->join('users', 'faskes.author_user_id = users.id');
            // $this->join('identitas', 'identitas.identitas_id = ayah.identitas_ayah');
            // $this->join('pekerjaan', 'pekerjaan.pekerjaan_id = ayah.pekerjaan_ayah');
            // $this->join('jadwal_imunisasi', 'jadwal_imunisasi.lokasi_faskes_jadwal_imunisasi = faskes.faskses_id');
            return $this->get()->getResultArray();
        } else {
            $this->join('users', 'faskes.author_user_id = users.id');
            // $this->join('identitas', 'identitas.identitas_id = ayah.identitas_ayah');
            // $this->join('pekerjaan', 'pekerjaan.pekerjaan_id = ayah.pekerjaan_ayah');
            // $this->join('jadwal_imunisasi', 'jadwal_imunisasi.lokasi_faskes_jadwal_imunisasi = faskes.faskses_id');
            $this->where(['slug_faskes' => $slug_faskes]);
            return $this->first();
        }
    }
}
