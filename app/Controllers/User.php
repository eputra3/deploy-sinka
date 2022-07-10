<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        $data['title'] = 'Profil Saya';
        return view('user/index', $data);
    }
}
