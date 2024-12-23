<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>

<div class="col-sm-12">
    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Data Pelanggan</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModal" data-toggle="modal">Tambah Data</button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datapelanggan">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Alamat</th>
                                                <th>No Hp</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($pelanggan as $val) {
                                                $no++; ?>
                                                <tr role="row" class="odd">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $val['id_pelanggan'] ?></td>
                                                    <td><?= $val['nama'] ?></td>
                                                    <td><?= $val['alamat'] ?></td>
                                                    <td><?= $val['nohp'] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-sm btn-edit"
                                                            data-id_pelanggan="<?= $val['id_pelanggan']; ?>"
                                                            data-namapelanggan="<?= $val['nama'] ?>"
                                                            data-alamat="<?= $val['alamat'] ?>"
                                                            data-nohp="<?= $val['nohp'] ?>">
                                                            <i class="fa fa-tags"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                            data-target="#deleteModal"
                                                            data-toggle="modal"
                                                            data-id="<?= $val['id_pelanggan']; ?>">
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
        $('#datapelanggan').DataTable();
    });

    $(document).on('click', '.btn-delete', function() {
        var id = $(this).data('id');
        $('#deleteId').val(id);
    });

    $('.btn-edit').on('click', function() {
        const id = $(this).data('id_pelanggan');
        const namapelanggan = $(this).data('namapelanggan');
        const alamat = $(this).data('alamat');
        const nohp = $(this).data('nohp');

        $('#edit_id_pelanggan').val(id);
        $('#edit_namapelanggan').val(namapelanggan);
        $('#edit_alamat').val(alamat);
        $('#edit_nohp').val(nohp);
        $('#editModal').modal('show');
    });
</script>

<?= $this->endSection() ?>