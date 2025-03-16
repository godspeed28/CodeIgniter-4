<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="mt-3">Detail Book</h3>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $books['sampul']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $books['judul']; ?></h5>
                            <p class="card-text"><b>Genre : </b><?= $books['genre']; ?></p>
                            <p class="card-text"><b>Penulis : </b><?= $books['penulis']; ?></p>
                            <p class="card-text"><small class="text-body-secondary"><b>Tahun Terbit :
                                    </b><?= $books['tahun_terbit']; ?></small></p>
                            <a href="/Books/edit/<?= $books['slug']; ?>" class="btn btn-warning">Edit</a>

                            <form action="/Books/<?= $books['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('yakin ingin menghapus?')">Delete</button>
                            </form>
                            <br><br>
                            <a href="/Books" style="text-decoration: none;" class="backBooks">Kembali ke daftar buku</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>