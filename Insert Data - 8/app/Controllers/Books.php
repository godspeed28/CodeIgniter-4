<?php

namespace App\Controllers;

use App\Models\BooksModel;

class Books extends BaseController
{
    protected $booksModel;
    public function __construct()
    {
        $this->booksModel = new BooksModel();
    }
    public function index(): string
    {
        // $books = $this->booksModel->findAll();
        $data = [
            'title' => 'Books | PWL',
            'books' => $this->booksModel->getBook()
        ];

        // // cara konek db tanpa model
        // $db = \Config\Database::connect();
        // $books = $db->query("SELECT * FROM books");
        // foreach ($books->getResultArray() as $row) {
        //     dd($row);
        // }

        // $booksModel = new \App\Models\BooksModel();

        return view('books/index', $data);
    }
    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Book',
            'books' => $this->booksModel->getBook($slug)
        ];

        if (empty($data['books'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul komik tidak ditemukan.');
        }

        return view('books/detail', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Form Insert Data'
        ];

        return view('books/create', $data);
    }
    public function save()
    {
        $slug = url_title($this->request->getVar('judul'), '-', true);
        // dd($this->request->getVar());
        $this->booksModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'genre' => $this->request->getVar('genre'),
            'penulis' => $this->request->getVar('penulis'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');

        return redirect()->to('/Books');
    }
}
