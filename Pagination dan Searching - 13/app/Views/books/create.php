<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h3 class="my-3">Form Insert Book</h3>
            <form action="/Books/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="mb-3 row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control <?= (isset($validation) && $validation->hasError('judul')) ? 'is-invalid' : ''; ?>"
                            id="judul" name="judul" value="<?= old('judul'); ?>" autofocus>
                        <div class="invalid-feedback">
                            <?php if (isset($validation)): ?>
                                <?= $validation->getError('judul'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="genre" class="col-sm-2 col-form-label">Genre</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control <?= (isset($validation) && $validation->hasError('genre')) ? 'is-invalid' : ''; ?>"
                            id="genre" name="genre" value="<?= old('genre'); ?>">
                        <div class="invalid-feedback">
                            <?php if (isset($validation)): ?>
                                <?= $validation->getError('genre'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="text"
                            class="form-control <?= (isset($validation) && $validation->hasError('penulis')) ? 'is-invalid' : ''; ?>"
                            id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                        <div class="invalid-feedback">
                            <?php if (isset($validation)): ?>
                                <?= $validation->getError('penulis'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                    <div class="col-sm-10">
                        <input type="number"
                            class="form-control <?= (isset($validation) && $validation->hasError('tahun_terbit')) ? 'is-invalid' : ''; ?>"
                            id="tahun_terbit" name="tahun_terbit" value="<?= old('tahun_terbit'); ?>">
                        <div class="invalid-feedback">
                            <?php if (isset($validation)): ?>
                                <?= $validation->getError('tahun_terbit'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/default.jpg" class="img-thumbnail img-preview" alt="">
                    </div>
                    <div class="col-sm-8">
                        <input type="file"
                            class="form-control custom <?= session()->getFlashdata('error') ? 'is-invalid' : ''; ?>"
                            id="sampul" name="sampul" onchange="previewImage()">
                        <div class="invalid-feedback">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-10 ">
                        <button type="submit" class="btn btn-primary">Insert Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>