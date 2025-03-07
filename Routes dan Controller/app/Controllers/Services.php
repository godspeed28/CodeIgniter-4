<?php

namespace App\Controllers;

class Services extends BaseController
{
    public function index($nama = 'Abe', $umur = 20)
    {
        echo "Halo nama saya $nama, saya berusia $umur tahun";
    }
}
