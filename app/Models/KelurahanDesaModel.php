<?php

namespace App\Models;

use CodeIgniter\Model;

class KelurahanDesaModel extends Model
{
    protected $table = 'kelurahan_desa';
    protected $primaryKey = 'kelurahan_desa_id';
    // protected $useTimestamps = true;
    protected $allowedFields = ['kelurahan_desa_id', 'nama_kelurahan_desa', 'gambar_kelurahan_desa', 'slug_kelurahan_desa', 'kecamatan_id'];

    public function getKelurahanDesa($slug_kelurahan_desa = null)
    {
        if ($slug_kelurahan_desa === null) {
            // // $this->select('kota_kabupaten_id', 'nama_kota_kabupaten', 'kota_kabupaten_image', 'slug_kecamatan');
            $this->join('kecamatan', 'kecamatan.kecamatan_id = kelurahan_desa.kecamatan_id');
            // $this->join('slug_kecamatan_kecamatan', 'kecamatan.slug_kecamatan = kelurahan_desa.kelurahan_desa_id');
            return $this->get()->getResultArray();
        } else {
            // $this->select('kota_kabupaten_id', 'nama_kota_kabupaten', 'kota_kabupaten_image', 'slug_kecamatan');
            $this->join('kecamatan', 'kecamatan.kecamatan_id = kelurahan_desa.kecamatan_id');
            // $this->join('kelurahan_desa', 'kota_kabupaten.kota_kabupaten_id = kelurahan_desa.kelurahan_desa_id');
            $this->where(['slug_kelurahan_desa' => $slug_kelurahan_desa]);
            return $this->first();
        }
    }
}
