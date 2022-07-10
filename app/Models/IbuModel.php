<?php

namespace App\Models;

use CodeIgniter\Model;

class IbuModel extends Model
{
    protected $table = 'ibu';
    protected $primaryKey = 'ibu_id';
    protected $allowedFields = ['identitas_ibu', 'gambar_identitas_ibu', 'nama_ibu', 'tempat_lahir_ibu', 'tanggal_lahir_ibu', 'email_ibu', 'no_hp_ibu', 'pekerjaan_ibu', 'penghasilan_ibu', 'alamat_ibu', 'suami', 'jumlah_anak_ibu', 'slug_ibu', 'author_user_id'];

    public function getIbu($slug_ibu = null)
    {
        if ($slug_ibu === null) {
            $this->join('users', 'ibu.author_user_id = users.id');
            $this->join('identitas', 'identitas.identitas_id = ibu.identitas_ibu');
            $this->join('pekerjaan', 'pekerjaan.pekerjaan_id = ibu.pekerjaan_ibu');
            $this->join('ayah', 'ayah.ayah_id = ibu.suami');
            return $this->get()->getResultArray();
        } else {
            $this->join('users', 'ibu.author_user_id = users.id');
            $this->join('identitas', 'identitas.identitas_id = ibu.identitas_ibu');
            $this->join('pekerjaan', 'pekerjaan.pekerjaan_id = ibu.pekerjaan_ibu');
            $this->join('ayah', 'ayah.ayah_id = ibu.suami');
            $this->where(['slug_ibu' => $slug_ibu]);
            return $this->first();
        }
    }
}
