<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        // $faker = \Faker\Factory::create();
        // dd($faker->name);
        $data = [
            'title' => 'Home | PWL',

        ];
        return view('pages/home', $data);

    }
    public function about()
    {
        $data = [
            'title' => 'About | PWL',
            'test' => ['Alfa', 'Emen', 'Abe']
        ];
        return view('pages/about', $data);
    }
    public function contact()
    {
        $data = [
            'title' => 'Contact | PWL',
            'contact' => [
                'tel' => '081246881584',
                'alamat' => 'abekolin@outlook.com'
            ]
        ];
        return view('pages/contact', $data);
    }
}
