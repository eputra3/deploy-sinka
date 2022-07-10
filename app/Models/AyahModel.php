<?php

namespace App\Models;

use CodeIgniter\Model;

class AyahModel extends Model
{
    protected $table = 'ayah';
    protected $primaryKey = 'ayah_id';
    protected $allowedFields = ['identitas_ayah', 'gambar_identitas_ayah', 'nama_ayah', 'tempat_lahir_ayah', 'tanggal_lahir_ayah', 'email_ayah', 'no_hp_ayah', 'pekerjaan_ayah', 'penghasilan_ayah', 'alamat_ayah', 'istri', 'jumlah_anak_ayah', 'slug_ayah', 'author_user_id'];

    public function getAyah($slug_ayah = null)
    {
        if ($slug_ayah === null) {
            $this->join('users', 'ayah.author_user_id = users.id');
            $this->join('identitas', 'identitas.identitas_id = ayah.identitas_ayah');
            $this->join('pekerjaan', 'pekerjaan.pekerjaan_id = ayah.pekerjaan_ayah');
            $this->join('ibu', 'ibu.ibu_id = ayah.istri');
            return $this->get()->getResultArray();
        } else {
            $this->join('users', 'ayah.author_user_id = users.id');
            $this->join('identitas', 'identitas.identitas_id = ayah.identitas_ayah');
            $this->join('pekerjaan', 'pekerjaan.pekerjaan_id = ayah.pekerjaan_ayah');
            $this->join('ibu', 'ibu.ibu_id = ayah.istri');
            $this->where(['slug_ayah' => $slug_ayah]);
            return $this->first();
        }
    }
}
