<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="mt-3">Books</h3>
            <table class="table table-dark table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Tahun Terbit</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $book['sampul']; ?>" alt="sampul" class="sampul"></td>
                            <td><?= $book['judul']; ?></td>
                            <td><?= $book['tahun_terbit']; ?></td>
                            <td><?= $book['genre']; ?></td>
                            <td><?= $book['penulis']; ?></td>
                            <td><a href="" class="btn btn-success">Detail</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>