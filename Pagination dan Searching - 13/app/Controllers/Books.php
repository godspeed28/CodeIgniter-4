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
            'title' => 'Form Insert Data',
            'validation' => session('validation')
        ];

        return view('books/create', $data);
    }
    public function save()
    {
        // Validasi input teks
        $rules = [
            'judul' => [
                'rules' => 'required|is_unique[books.judul]',
                'errors' => [
                    'required' => '{field} buku harus diisi.',
                    'is_unique' => '{field} buku sudah terdaftar.'
                ]
            ],
            'genre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi.'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi.'
                ]
            ],
            'tahun_terbit' => [
                'label' => 'tahun terbit',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Validasi manual untuk sampul
        $fileSampul = $this->request->getFile('sampul');

        // Validasi format & ukuran file sampul
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $maxSize = 2048; // 2MB

        if (!$fileSampul->isValid() || $fileSampul->getError() == 4) {
            $sampulName = 'default.jpg';
        } else if (!in_array($fileSampul->getExtension(), $allowedExtensions)) {
            return redirect()->back()->withInput()->with('error', 'Format file tidak valid! Hanya boleh jpg, jpeg, atau png.');
        } else if ($fileSampul->getSize() > ($maxSize * 1024)) {
            return redirect()->back()->withInput()->with('error', 'Ukuran file terlalu besar! Maksimal 2MB.');
        } else {
            $sampulName = $fileSampul->getRandomName();
            $fileSampul->move('img', $sampulName);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);

        // Simpan ke database
        $this->booksModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'genre' => $this->request->getVar('genre'),
            'penulis' => $this->request->getVar('penulis'),
            'sampul' => $sampulName,
            'tahun_terbit' => $this->request->getVar('tahun_terbit')

        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/Books');
    }

    public function delete($id)
    {
        // cari gambar berdasarkan id
        $book = $this->booksModel->find($id);

        if ($book['sampul'] !== 'default.jpg') {
            // hapus gambar
            unlink('img/' . $book['sampul']);
        }
        $this->booksModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/Books');
    }
    public function edit($slug)
    {
        $data = [
            'title' => 'Form Edit Data',
            'validation' => session()->get('validation'),
            'books' => $this->booksModel->getBook($slug)
        ];

        return view('books/edit', $data);
    }
    public function update($id)
    {
        // cek judul
        $old_books = $this->booksModel->getBook($this->request->getVar('slug'));
        if ($old_books['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[books.judul]';
        }
        // validasi input
        if (
            !$this->validate([
                'judul' => [
                    'rules' => $rule_judul,
                    'errors' => [
                        'required' => '{field} buku harus diisi.',
                        'is_unique' => '{field} buku sudah terdaftar.'
                    ]
                ],
                'genre' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} buku harus diisi.'
                    ]
                ],
                'penulis' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} buku harus diisi.'
                    ]
                ],
                'tahun_terbit' => [
                    'label' => 'tahun terbit',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} buku harus diisi.'
                    ]
                ]
            ])
        ) {
            // $validation = \Config\Services::validation();
            return redirect()->to('/Books/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $this->validation);
        }

        // Validasi manual untuk sampul
        $fileSampul = $this->request->getFile('sampul');
        $fileSampulLama = $this->request->getVar('sampulLama');

        // Validasi format & ukuran file sampul
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $maxSize = 2048; // 2MB

        if (!$fileSampul->isValid() || $fileSampul->getError() == 4) {
            $fileSampul = $fileSampulLama;
            $sampulName = $fileSampul;
        } else if (!in_array($fileSampul->getExtension(), $allowedExtensions)) {
            return redirect()->back()->withInput()->with('error', 'Format file tidak valid! Hanya boleh jpg, jpeg, atau png.');
        } else if ($fileSampul->getSize() > ($maxSize * 1024)) {
            return redirect()->back()->withInput()->with('error', 'Ukuran file terlalu besar! Maksimal 2MB.');
        } else {
            $sampulName = $fileSampul->getRandomName();
            unlink('img/' . $fileSampulLama);
            $fileSampul->move('img', $sampulName);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        // dd($this->request->getVar());
        $this->booksModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'genre' => $this->request->getVar('genre'),
            'penulis' => $this->request->getVar('penulis'),
            'sampul' => $sampulName,
            'tahun_terbit' => $this->request->getVar('tahun_terbit')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/Books');
    }
}
