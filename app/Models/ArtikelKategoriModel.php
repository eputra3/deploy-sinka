<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelKategoriModel extends Model
{
    protected $table = 'artikel_kategori';
    protected $primaryKey = 'artikel_kategori_id';
    protected $allowedFields = ['nama_artikel_kategori', 'gambar_artikel_kategori', 'slug_artikel_kategori'];

    public function getArtikelKategori($slug_artikel_kategori = null)
    {
        if ($slug_artikel_kategori === null) {
            // $this->select('artikel_kategori_id', 'nama_artikel_kategori', 'image', 'slug_artikel_kategori');
            // $this->join('kecamatan', 'kota_kabupaten.kota_kabupaten_id = kecamatan.kecamatan_id');
            // $this->join('kelurahan_desa', 'kota_kabupaten.kota_kabupaten_id = kelurahan_desa.kelurahan_desa_id');
            return $this->get()->getResultArray();
        } else {
            // $this->select('artikel_kategori_id', 'nama_artikel_kategori', 'image', 'slug_artikel_kategori');
            // $this->join('kecamatan', 'kota_kabupaten.kota_kabupaten_id = kecamatan.kecamatan_id');
            // $this->join('kelurahan_desa', 'kota_kabupaten.kota_kabupaten_id = kelurahan_desa.kelurahan_desa_id');
            $this->where(['slug_artikel_kategori' => $slug_artikel_kategori]);
            return $this->first();
        }
    }
}
