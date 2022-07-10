<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisImunisasiModel extends Model
{
    protected $table = 'jenis_imunisasi';
    protected $primaryKey = 'jenis_imunisasi_id';
    protected $allowedFields = ['nama_jenis_imunisasi', 'slug_jenis_imunisasi', 'gambar_jenis_imunisasi', 'waktu_awal_tepat_jenis_imunisasi', 'waktu_akhir_tepat_jenis_Imunisasi', 'waktu_awal_telat_jenis_imunisasi', 'waktu_akhir_telat_jenis_imunisasi'];

    public function getJenisImunisasi($slug_jenis_imunisasi = null)
    {
        if ($slug_jenis_imunisasi === null) {
            // $this->select('artikel_kategori_id', 'nama_artikel_kategori', 'image', 'slug_artikel_kategori');
            // $this->join('kecamatan', 'kota_kabupaten.kota_kabupaten_id = kecamatan.kecamatan_id');
            // $this->join('kelurahan_desa', 'kota_kabupaten.kota_kabupaten_id = kelurahan_desa.kelurahan_desa_id');
            return $this->get()->getResultArray();
        } else {
            // $this->select('artikel_kategori_id', 'nama_artikel_kategori', 'image', 'slug_artikel_kategori');
            // $this->join('kecamatan', 'kota_kabupaten.kota_kabupaten_id = kecamatan.kecamatan_id');
            // $this->join('kelurahan_desa', 'kota_kabupaten.kota_kabupaten_id = kelurahan_desa.kelurahan_desa_id');
            $this->where(['slug_jenis_imunisasi' => $slug_jenis_imunisasi]);
            return $this->first();
        }
    }
}
