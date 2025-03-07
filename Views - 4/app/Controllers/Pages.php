<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index(): string
    {
        return view('pages/home');
    }
}
