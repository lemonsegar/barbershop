<!-- Form Tambah Data -->
<form action="/karyawan/save" method="post">
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

    <div class="modal fade" id="addModalKaryawan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Karyawan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="id">ID Karyawan</label>
                        <input type="text" class="form-control" id="id" name="id" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="namakaryawan">Nama Karyawan</label>
                        <input type="text" class="form-control" id="namakaryawan" name="namakaryawan" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jenkel">Jenis Kelamin</label>
                        <select class="form-control" id="jenkel" name="jenkel" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nohp">No. HP</label>
                        <input type="tel" class="form-control" id="nohp" name="nohp" required>
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

<!-- Form Hapus Data -->
<form action="/karyawan/delete" method="post">
    <div class="modal fade" id="deleteModalKaryawan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">Apakah Anda yakin ingin menghapus data ini?</h6>
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

<!-- Form Edit Data -->
<form action="/karyawan/update" method="post">
    <div class="modal fade" id="editModalKaryawan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Karyawan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="id">ID Karyawan</label>
                        <input type="text" class="form-control id" id="id" name="id" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="namakaryawan">Nama Karyawan</label>
                        <input type="text" class="form-control namakaryawan" id="namakaryawan" name="namakaryawan" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jenkel">Jenis Kelamin</label>
                        <select class="form-control jenkel" id="jenkel" name="jenkel" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control alamat" id="alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nohp">No. HP</label>
                        <input type="tel" class="form-control nohp" id="nohp" name="nohp" required>
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