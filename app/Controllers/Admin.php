<?php

namespace App\Controllers;

class Admin extends BaseController
{
    protected $db, $builder, $DataOrangtuaModel;

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        // $this->builder = $this->db->table('data_orangtua');
        // $this->builder = $this->db->table('artikel_kategori');
    }

    public function index()
    {
        $data['title'] = 'Daftar Pengguna';
        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users'] = $users->findAll();


        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        // $this->builder->join('data_orangtua', 'data_orangtua.author_user_id = users.id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();
        // $data['data_orangtua'] = $query->getResult();

        // d($data);
        return view('admin/index', $data);
    }
    public function detail($id)
    {
        $data['title'] = 'Detail Pengguna';

        $this->builder->select('users.id as userid, username, email, name, username, user_image, fullname');
        // $this->builder->join('data_orangtua', 'data_orangtua.author_user_id = users.id');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();

        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }

        // d($data);
        return view('admin/detail', $data);
    }
    // public function artikel()
    // {
    //     $data['title'] = 'Daftar Artikel';
    //     $this->builder->select('judul, isi');

    //     $query = $this->builder->get();
    //     $data['artikel'] = $query->getResult();

    //     return view('artikel/index', $data);
    // }

}
