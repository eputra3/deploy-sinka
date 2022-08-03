<?php

namespace App\Models;

use CodeIgniter\Model;

class AnakModel extends Model
{
    protected $table = 'anak';
    protected $primaryKey = 'anak_id';
    protected $allowedFields = ['nama_anak', 'jenis_kelamin_anak', 'tempat_lahir_anak', 'tanggal_lahir_anak', 'gambar_anak', 'kota_kabupaten', 'kecamatan', 'kelurahan_desa', 'alamat_anak', 'ayah', 'ibu', 'slug_anak', 'author_user_id'];

    public function getAnak($slug_anak = null)
    {
        if ($slug_anak === null) {
            $this->join('users', 'anak.author_user_id = users.id');
            $this->join('kota_kabupaten', 'kota_kabupaten.kota_kabupaten_id = anak.kota_kabupaten');
            $this->join('kecamatan', 'kecamatan.kecamatan_id = anak.kecamatan');
            $this->join('kelurahan_desa', 'kelurahan_desa.kelurahan_desa_id = anak.kelurahan_desa');
            $this->join('ayah', 'ayah.ayah_id = anak.ayah');
            $this->join('ibu', 'ibu.ibu_id = anak.ibu');
            return $this->get()->getResultArray();
        } else {
            $this->join('users', 'anak.author_user_id = users.id');
            $this->join('kota_kabupaten', 'kota_kabupaten.kota_kabupaten_id = anak.kota_kabupaten');
            $this->join('kecamatan', 'kecamatan.kecamatan_id = anak.kecamatan');
            $this->join('kelurahan_desa', 'kelurahan_desa.kelurahan_desa_id = anak.kelurahan_desa');
            $this->join('ayah', 'ayah.ayah_id = anak.ayah');
            $this->join('ibu', 'ibu.ibu_id = anak.ibu');
            $this->where(['slug_anak' => $slug_anak]);
            return $this->first();
        }
    }
}
