<?php

namespace App\Models;

use CodeIgniter\Model;

class DasborModel extends Model
{
    public function hitungJumlahAnak()
    {
        $builder = $this->db->table('anak');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahAyah()
    {
        $builder = $this->db->table('ayah');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahIbu()
    {
        $builder = $this->db->table('ibu');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahFaskes()
    {
        $builder = $this->db->table('faskes');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiSatu()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '13');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahJenisKelaminAnakLaki()
    {
        $builder = $this->db->table('anak');
        $builder->like('jenis_kelamin_anak', 'Laki-laki');
        $query = $builder->countAllResults();
        return $query;
    }
    public function hitungJumlahJenisKelaminAnakPerempuan()
    {
        $builder = $this->db->table('anak');
        $builder->like('jenis_kelamin_anak', 'Perempuan');
        $query = $builder->countAllResults();
        return $query;
    }
}
