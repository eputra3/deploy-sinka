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
            $this->join('kota_kabupaten', 'kota_kabupaten.kota_kabupaten_id = faskes.kota_kabupaten');
            $this->join('kecamatan', 'kecamatan.kecamatan_id = faskes.kecamatan');
            $this->join('kelurahan_desa', 'kelurahan_desa.kelurahan_desa_id = faskes.kelurahan_desa');
            return $this->get()->getResultArray();
        } else {
            $this->join('users', 'faskes.author_user_id = users.id');
            $this->join('kota_kabupaten', 'kota_kabupaten.kota_kabupaten_id = faskes.kota_kabupaten');
            $this->join('kecamatan', 'kecamatan.kecamatan_id = faskes.kecamatan');
            $this->join('kelurahan_desa', 'kelurahan_desa.kelurahan_desa_id = faskes.kelurahan_desa');
            $this->where(['slug_faskes' => $slug_faskes]);
            return $this->first();
        }
    }
}
