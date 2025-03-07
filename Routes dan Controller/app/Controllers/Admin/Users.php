<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function index($nama = 'Albert', $umur = 20)
    {
        echo "Halo nama saya $nama, saya berusia $umur tahun";
    }
}
