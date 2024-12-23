<form action="/paket/save" method="post">
    <?php if (!empty(session()->getFlashdata('error'))) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4>Periksa Entrian Form</h4>
            <hr>
            <?php echo session()->getFlashdata('error'); ?>
            <button type="button" id="addModal" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Modal Tambah -->
    <div class="modal fade" id="addModalPaket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Paket</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" required />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="namapaket" class="form-label">Nama Paket</label>
                        <input type="text" class="form-control" id="namapaket" name="namapaket" required />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="jenispaket" class="form-label">Jenis Paket</label>
                        <input type="text" class="form-control" id="jenispaket" name="jenispaket" required />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Hapus -->
<form action="/paket/delete" method="post">
    <div class="modal fade" id="deleteModalPaket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Paket</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Apakah Anda yakin ingin menghapus data ini?</h5>
                    <input type="hidden" name="deleteId" id="deleteId" class="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Edit -->
<form action="/paket/update" method="post">
    <div class="modal fade" id="editModalPaket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Paket</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" name="id" id="editId" readonly />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="namapaket" class="form-label">Nama Paket</label>
                        <input type="text" class="form-control" name="namapaket" id="editNamaPaket" required />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="jenispaket" class="form-label">Jenis Paket</label>
                        <input type="text" class="form-control" name="jenispaket" id="editJenisPaket" required />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" name="harga" id="editHarga" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
</form>