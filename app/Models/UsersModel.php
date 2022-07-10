<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['users.id as userid', 'username', 'email', 'name'];

    function getUsers($id = null)
    {
        if ($id === null) {
            $this->join('data_orangtua', 'data_orangtua.author_user_id = users.id');
            // $this->join('users', 'artikel.author_user_id = users.id');
            return $this->get()->getResultArray();
        } else {
            $this->join('data_orangtua', 'data_orangtua.author_user_id = users.id');
            // $this->join('users', 'artikel.author_user_id = users.id');
            $this->where(['id' => $id]);
            return $this->first();
        }
    }
}
