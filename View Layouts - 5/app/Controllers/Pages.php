<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | PWL'
        ];
        echo view('layout/header', $data);
        echo view('pages/home');
        echo view('layout/footer');

    }
    public function about()
    {
        $data = [
            'title' => 'About | PWL',
            'test' => ['Alfa', 'Emen', 'Abe']
        ];
        echo view('layout/header', $data);
        echo view('pages/about', $data);
        echo view('layout/footer');
    }
}
