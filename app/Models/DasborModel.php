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

    // Jumkah Riwayat Imunisasi
    public function hitungJumlahImunisasiHepatittisB()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '1');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiBcg()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '2');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiPolioTetes1()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '3');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiDptHbHib1()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '4');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiPolioTetes2()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '5');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiDptHbHib2()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '6');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiPolioTetes3()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '7');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiDptHbHib3()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '8');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiPolioTetes4()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '9');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiPolioSuntikIpv()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '10');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiCampakRubelaMr()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '11');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiDptHbHibLanjutan()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '12');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiCampakRubelaMrLanjutan()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '13');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiPcv1()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '14');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiPcv2()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '15');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiJapaneseEncephalitis()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '16');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahImunisasiPcv3()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $builder->like('id_jenis_imuniasasi', '17');
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
    public function hitungJumlahArtikelBerita()
    {
        $builder = $this->db->table('artikel');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahTotalPertumbuhan()
    {
        $builder = $this->db->table('riwayat_pertumbuhan');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahTotalImunisasi()
    {
        $builder = $this->db->table('riwayat_imunisasi');
        $query = $builder->countAll();
        return $query;
    }
    public function hitungJumlahPengguna()
    {
        $builder = $this->db->table('users');
        $query = $builder->countAll();
        return $query;
    }
}
