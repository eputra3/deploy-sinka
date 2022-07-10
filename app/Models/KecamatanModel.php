<?php

namespace App\Models;

use CodeIgniter\Model;

class KecamatanModel extends Model
{
    protected $table = 'kecamatan';
    protected $primaryKey = 'kecamatan_id';
    // protected $useTimestamps = true;
    protected $allowedFields = ['kecamatan_id', 'nama_kecamatan', 'gambar_kecamatan', 'slug_kecamatan', 'kota_kabupaten_id'];

    public function getKecamatan($slug_kecamatan = null)
    {
        if ($slug_kecamatan === null) {
            // // $this->select('kota_kabupaten_id', 'nama_kota_kabupaten', 'kota_kabupaten_image', 'slug_kecamatan');
            $this->join('kota_kabupaten', 'kota_kabupaten.kota_kabupaten_id = kecamatan.kota_kabupaten_id');
            // $this->join('slug_kecamatan_kecamatan', 'kecamatan.slug_kecamatan = kelurahan_desa.kelurahan_desa_id');
            return $this->get()->getResultArray();
        } else {
            // $this->select('kota_kabupaten_id', 'nama_kota_kabupaten', 'kota_kabupaten_image', 'slug_kecamatan');
            $this->join('kota_kabupaten', 'kota_kabupaten.kota_kabupaten_id = kecamatan.kota_kabupaten_id');
            // $this->join('kelurahan_desa', 'kota_kabupaten.kota_kabupaten_id = kelurahan_desa.kelurahan_desa_id');
            $this->where(['slug_kecamatan' => $slug_kecamatan]);
            return $this->first();
        }
    }
}
