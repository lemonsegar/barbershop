<!-- Pelanggan -->

<!-- Form Tambah -->
<form action="/pelanggan/save" method="post">
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


    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pelanggan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label>ID</label>
                        <input type="text" class="form-control" name="id" />
                    </div>
                    <div class="col-md-12">
                        <label>Nama Pelanggan</label>
                        <input type="text" class="form-control" name="namapelanggan" />
                    </div>
                    <div class="col-md-12">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" />
                    </div>
                    <div class="col-md-12">
                        <label>No Hp</label>
                        <input type="text" class="form-control" name="nohp" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data Pelanggan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="/pelanggan/delete" method="post">
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModallabel"> Pelanggan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label=Close></button>
                </div>
                <div class="modal-body">
                    <h1>Yakin Di Hapus?</h1>
                    <input type="hidden" name="deleteId" id="deleteId" class="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">HAPUS</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- edit modal -->
<form action="/pelanggan/update" method="post">
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pelanggan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label>ID</label>
                        <input type="text" class="form-control" name="id" id="id_pelanggan" readonly />
                    </div>
                    <div class="col-md-12">
                        <label>Nama Pelanggan</label>
                        <input type="text" class="form-control" name="namapelanggan" id="namapelanggan" />
                    </div>
                    <div class="col-md-12">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" />
                    </div>
                    <div class="col-md-12">
                        <label>No Hp</label>
                        <input type="text" class="form-control" name="nohp" id="nohp" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Pelanggan -->

<!-- User -->
<!-- Form Tambah -->
<form action="/user/save" method="post">
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

    <div class="modal fade" id="addModalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">user</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                    <label>ID</label>
                    <input type="text" class="form-control" name="id" />
                </div>
                    <div class="col-md-12">
                    <label>Nama user</label>
                    <input type="text" class="form-control" name="namauser" />
                </div>
                    <div class="col-md-12">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" />
                </div>
                    <div class="col-md-12">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" />
                </div>
                    <div class="col-md-12">
                    <label>Level</label>
                    <input type="text" class="form-control" name="level" />
                </div>
                </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
</div>
</div>
</div>
</form>

<!-- Form Delete -->
<form action="/user/delete" method="post">
    <div class="modal fade" id="deleteModalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">user</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3> Apakah Yakin Menghapus Data Ini ?</h3>
                </div>
                    <div class="modal-footer">
                    <input type="text" name="id" class="id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
</div>
</div>
</div>
</div>
</form>

<!-- edit modal -->
<form action="/user/update" method="post">
    <div class="modal fade" id="editModalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                    <label>ID</label>
                    <input type="text" class="form-control id" name="id" />
                </div>
                    <div class="col-md-12">
                    <label>Nama user</label>
                    <input type="text" class="form-control namauser" name="namauser" />
                </div>
                    <div class="col-md-12">
                    <label>Email</label>
                    <input type="text" class="form-control email" name="email" />
                </div>
                    <div class="col-md-12">
                    <label>Password</label>
                    <input type="text" class="form-control password" name="password" />
                </div>
                    <div class="col-md-12">
                    <label>Level</label>
                    <input type="text" class="form-control level" name="level" />
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- User -->

<!-- Karyawan -->
<!-- Form Tambah -->
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
                    <h5 class="modal-title" id="exampleModalLabel">Karyawan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label>ID</label>
                        <input type="text" class="form-control" name="id" />
                    </div>
                    <div class="col-md-12">
                        <label>Nama Karyawan</label>
                        <input type="text" class="form-control" name="namakaryawan" />
                    </div>
                    <div class="col-md-12">
                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control" name="jenkel" />
                    </div>
                    <div class="col-md-12">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" />
                    </div>
                    <div class="col-md-12">
                        <label>No Hp</label>
                        <input type="text" class="form-control" name="nohp" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data Karyawan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="/karyawan/delete" method="post">
    <div class="modal fade" id="deleteModalKaryawan" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModallabel">Karyawan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label=Close></button>
                </div>
                <div class="modal-body">
                    <h1>Yakin Di Hapus?</h1>
                    <input type="text" name="deleteId" id="deleteId" class="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">HAPUS</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- edit modal -->
<form action="/karyawan/update" method="post">
    <div class="modal fade" id="editModalKaryawan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Karyawan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label>ID</label>
                        <input type="text" class="form-control id" id="id" name="id" />
                    </div>
                    <div class="col-md-12">
                        <label>Nama Karyawan</label>
                        <input type="text" class="form-control namakaryawan" id="namakaryawan" name="namakaryawan" />
                    </div>
                    <div class="col-md-12">
                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control jenkel" id="jenkel" name="jenkel" />
                    </div>
                    <div class="col-md-12">
                        <label>Alamat</label>
                        <input type="text" class="form-control alamat" id="alamat" name="alamat" />
                    </div>
                    <div class="col-md-12">
                        <label>No Hp</label>
                        <input type="text" class="form-control nohp" id="nohp" name="nohp" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Karyawan -->

<!-- Paket -->
<!-- Form Paket -->
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


    <div class="modal fade" id="addModalPaket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Paket</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label>ID</label>
                        <input type="text" class="form-control" name="id" />
                    </div>
                    <div class="col-md-12">
                        <label>Nama Paket</label>
                        <input type="text" class="form-control" name="namapaket" />
                    </div>
                    <div class="col-md-12">
                        <label>Jenis Paket</label>
                        <input type="text" class="form-control" name="jenispaket" />
                    </div>
                    <div class="col-md-12">
                        <label>Harga</label>
                        <input type="text" class="form-control" name="harga" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Data Paket</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="/paket/delete" method="post">
    <div class="modal fade" id="deleteModalPaket" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModallabel">Paket</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label=Close></button>
                </div>
                <div class="modal-body">
                    <h1>Yakin Di Hapus?</h1>
                    <input type="text" name="deleteId" id="deleteId" class="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">HAPUS</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- edit modal -->
<form action="/paket/update" method="post">
    <div class="modal fade" id="editModalPaket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Paket</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label>ID</label>
                        <input type="text" class="form-control id" id="id" name="id" />
                    </div>
                    <div class="col-md-12">
                        <label>Nama Paket</label>
                        <input type="text" class="form-control namapaket" id="namapaket" name="namapaket" />
                    </div>
                    <div class="col-md-12">
                        <label>Jenis Paket</label>
                        <input type="text" class="form-control jenispaket" id="jenispaket" name="jenispaket" />
                    </div>
                    <div class="col-md-12">
                        <label>Harga</label>
                        <input type="text" class="form-control harga" id="harga" name="harga" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Paket -->

