<?php

namespace App\Controllers;

class Books extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Books | PWL'
        ];
        return view('komik/index', $data);
    }
}
