<?php

namespace App\Models;

use CodeIgniter\Model;

class IdentitasModel extends Model
{
    protected $table = 'identitas';
    protected $primaryKey = 'identitas_id';
    protected $allowedFields = ['nama_identitas', 'gambar_identitas', 'slug_pekerjaan'];

    public function getIdentitas($slug_pekerjaan = null)
    {
        if ($slug_pekerjaan === null) {
            // $this->select('artikel_kategori_id', 'nama_artikel_kategori', 'image', 'slug_pekerjaan');
            // $this->join('kecamatan', 'kota_kabupaten.kota_kabupaten_id = kecamatan.kecamatan_id');
            // $this->join('kelurahan_desa', 'kota_kabupaten.kota_kabupaten_id = kelurahan_desa.kelurahan_desa_id');
            return $this->get()->getResultArray();
        } else {
            // $this->select('artikel_kategori_id', 'nama_artikel_kategori', 'image', 'slug_pekerjaan');
            // $this->join('kecamatan', 'kota_kabupaten.kota_kabupaten_id = kecamatan.kecamatan_id');
            // $this->join('kelurahan_desa', 'kota_kabupaten.kota_kabupaten_id = kelurahan_desa.kelurahan_desa_id');
            $this->where(['slug_pekerjaan' => $slug_pekerjaan]);
            return $this->first();
        }
    }
}
