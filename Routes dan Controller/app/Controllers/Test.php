<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function index()
    {
        echo "Hallo $this->nama";
    }
}
