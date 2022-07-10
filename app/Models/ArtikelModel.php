<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'artikel_id';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'isi', 'slug', 'gambar_artikel', 'author_user_id', 'artikel_kategori_id'];

    public function getArtikel($slug = null)
    {
        if ($slug === null) {
            $this->join('artikel_kategori', 'artikel.artikel_kategori_id = artikel_kategori.artikel_kategori_id');
            $this->join('users', 'artikel.author_user_id = users.id');
            return $this->get()->getResultArray();
        } else {
            $this->join('artikel_kategori', 'artikel.artikel_kategori_id = artikel_kategori.artikel_kategori_id');
            $this->join('users', 'artikel.author_user_id = users.id');
            $this->where(['slug' => $slug]);
            return $this->first();
        }
    }
}
