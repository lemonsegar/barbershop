<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>

<div class="col-sm-12">
    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Data Karyawan</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModalKaryawan" data-toggle="modal">
                                Tambah Data
                            </button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datakaryawan">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Nama Karyawan</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Alamat</th>
                                                <th>No Hp</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($karyawan as $val) {
                                                $no++; ?>
                                                <tr role="row" class="odd">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $val['id_karyawan'] ?></td>
                                                    <td><?= $val['nama_karyawan'] ?></td>
                                                    <td><?= $val['jenkel'] ?></td>
                                                    <td><?= $val['alamat'] ?></td>
                                                    <td><?= $val['nohp'] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-sm btn-editKaryawan"
                                                            data-id="<?= $val['id_karyawan']; ?>"
                                                            data-namakaryawan="<?= $val['nama_karyawan'] ?>"
                                                            data-jenkel="<?= $val['jenkel'] ?>"
                                                            data-alamat="<?= $val['alamat'] ?>"
                                                            data-nohp="<?= $val['nohp'] ?>">
                                                            <i class="fa fa-tags"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                            data-target="#deleteModalKaryawan" data-toggle="modal"
                                                            data-id="<?= $val['id_karyawan']; ?>">
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
    $(document).ready(function() {
        $('#datakaryawan').DataTable();
    });

    $(document).on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        $('.id').val(id);
    });

    $('.btn-editKaryawan').on('click', function() {
        const id = $(this).data('id');
        const namakaryawan = $(this).data('namakaryawan');
        const jenkel = $(this).data('jenkel');
        const alamat = $(this).data('alamat');
        const nohp = $(this).data('nohp');

        $('.id').val(id);
        $('.namakaryawan').val(namakaryawan);
        $('.jenkel').val(jenkel);
        $('.alamat').val(alamat);
        $('.nohp').val(nohp);
        $('#editModalKaryawan').modal('show');
    });
</script>

<?= $this->endSection() ?>