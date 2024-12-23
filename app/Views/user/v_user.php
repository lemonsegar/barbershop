<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>

<div class="col-sm-12">
    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Data User</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModalUser" data-toggle="modal">
                                Tambah Data
                            </button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datauser">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Nama User</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                                <th>Level</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($user as $val) {
                                                $no++; ?>
                                                <tr role="row" class="odd">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $val['id_user'] ?></td>
                                                    <td><?= $val['nama_user'] ?></td>
                                                    <td><?= $val['email'] ?></td>
                                                    <td><?= $val['password'] ?></td>
                                                    <td><?= $val['level'] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-sm btn-editUser"
                                                            data-id="<?= $val['id_user']; ?>"
                                                            data-namauser="<?= $val['nama_user'] ?>"
                                                            data-email="<?= $val['email'] ?>"
                                                            data-password="<?= $val['password'] ?>"
                                                            data-level="<?= $val['level'] ?>">
                                                            <i class="fa fa-tags"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                            data-target="#deleteModalUser"
                                                            data-toggle="modal"
                                                            data-id="<?= $val['id_user']; ?>">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>

<script>
    // Script edit data
    $('.btn-editUser').on('click', function() {
        const id = $(this).data('id');
        const namauser = $(this).data('namauser');
        const email = $(this).data('email');
        const password = $(this).data('password');
        const level = $(this).data('level');

        $('.id').val(id);
        $('.namauser').val(namauser);
        $('.email').val(email);
        $('.password').val(password);
        $('.level').val(level).trigger('change');
        $('#editModalUser').modal('show');
    });

    // Script delete
    $('.btn-delete').on('click', function() {
        const id = $(this).data('id');
        $('.id').val(id);
        $('#deleteModalUser').modal('show');
    });

    // Script datatable
    $(document).ready(function() {
        $('#datauser').DataTable();
    });
</script>

<?= $this->endSection() ?>