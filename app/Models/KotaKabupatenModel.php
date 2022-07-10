<?php

namespace App\Models;

use CodeIgniter\Model;

class KotaKabupatenModel extends Model
{
    protected $table = 'kota_kabupaten';
    protected $primaryKey = 'kota_kabupaten_id';
    // protected $useTimestamps = true;
    protected $allowedFields = ['kota_kabupaten_id', 'nama_kota_kabupaten', 'gambar_kota_kabupaten', 'slug'];

    public function getKotaKabupaten($slug = null)
    {
        if ($slug === null) {
            // // $this->select('kota_kabupaten_id', 'nama_kota_kabupaten', 'kota_kabupaten_image', 'slug');
            // $this->join('kecamatan', 'kota_kabupaten.kota_kabupaten_id = kecamatan.kecamatan_id');
            // $this->join('kelurahan_desa', 'kota_kabupaten.kota_kabupaten_id = kelurahan_desa.kelurahan_desa_id');
            return $this->get()->getResultArray();
        } else {
            // $this->select('kota_kabupaten_id', 'nama_kota_kabupaten', 'kota_kabupaten_image', 'slug');
            // $this->join('kecamatan', 'kota_kabupaten.kota_kabupaten_id = kecamatan.kecamatan_id');
            // $this->join('kelurahan_desa', 'kota_kabupaten.kota_kabupaten_id = kelurahan_desa.kelurahan_desa_id');
            $this->where(['slug' => $slug]);
            return $this->first();
        }
    }
}
