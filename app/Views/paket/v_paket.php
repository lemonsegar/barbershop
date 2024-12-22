<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>


<head>


    <link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
</head>

<div class="col-sm-12">
    <div class="page-content-wrapper ">
        <!-- end page title and breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Data Paket</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModalPaket"
                                data-toggle="modal">Tambah Data</button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datapaket">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Nama Paket</th>
                                                <th>Jenis Paket</th>
                                                <th>Harga</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($paket as $val) {
                                                $no++; ?>
                                            <tr role="row" class="odd">
                                                <td><?= $no; ?></td>
                                                <td><?= $val['id_paket'] ?></td>
                                                <td><?= $val['nama_paket'] ?></td>
                                                <td><?= $val['jenis_paket'] ?></td>
                                                <td><?= $val['harga'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm btn-editPaket"
                                                        data-id="<?= $val['id_paket']; ?>"
                                                        data-namapaket="<?= $val['nama_paket'] ?>"
                                                        data-jenispaket="<?= $val['jenis_paket'] ?>"
                                                        data-harga="<?= $val['harga'] ?>">
                                                        <i class="fa fa-tags"></i>
                                                    </button>

                                                    <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                        data-target="#deleteModalPaket" data-toggle="modal"
                                                        data-id="<?= $val['id_paket']; ?>">
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
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>




<script src="<?= base_url() ?>/assets/modules/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#datapaket').DataTable();
});



$(document).on('click', '.btn-delete', function() {
    var id = $(this).data('id'); // Ambil id dari data-id di tombol
    $('.id').val(id); // Isi input hidden di modal dengan id yang sesuai

});

//script untuk edit data
$('.btn-editPaket').on('click', function() {
    const id = $(this).data('id');
    const namapaket = $(this).data('namapaket');
    const jenispaket = $(this).data('jenispaket');
    const harga = $(this).data('harga');

    $('.id').val(id);
    $('.namapaket').val(namapaket);
    $('.jenispaket').val(jenispaket);
    $('.harga').val(harga);
    $('#editModalPaket').modal('show');
});
</script>
<?= $this->endSection('') ?>