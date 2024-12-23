<?= $this->extend('layout/main') ?>

<?= $this->section('css') ?>
<!-- DataTables CSS -->
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Sweet Alert -->
<link href="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<?= $this->endSection() ?>

<?= $this->section('isi') ?>
<div class="col-sm-12">
    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8">
                                <h4 class="mt-0 header-title">Data Transaksi</h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="/transaksi/create" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus-circle mr-1"></i> Tambah Transaksi
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="datatable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Pelanggan</th>
                                        <th>Paket</th>
                                        <th>Total Bayar</th>
                                        <th>Metode</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($transaksi as $row) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['id_transaksi'] ?></td>
                                            <td><?= date('d/m/Y', strtotime($row['tanggal_transaksi'])) ?></td>
                                            <td><?= $row['nama_pelanggan'] ?></td>
                                            <td><?= $row['nama_paket'] ?></td>
                                            <td class="text-right">Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?></td>
                                            <td>
                                                <span class="badge badge-<?= getMetodeBayarBadge($row['metode_bayar']) ?>">
                                                    <?= strtoupper($row['metode_bayar']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-<?= getStatusBayarBadge($row['status_bayar']) ?>">
                                                    <?= str_replace('_', ' ', strtoupper($row['status_bayar'])) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="/transaksi/edit/<?= $row['id_transaksi'] ?>"
                                                    class="btn btn-warning btn-sm"
                                                    data-toggle="tooltip"
                                                    title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="/transaksi/show/<?= $row['id_transaksi'] ?>"
                                                    class="btn btn-info btn-sm"
                                                    data-toggle="tooltip"
                                                    title="Detail">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="/transaksi/print/<?= $row['id_transaksi'] ?>"
                                                    class="btn btn-success btn-sm"
                                                    data-toggle="tooltip"
                                                    title="Print"
                                                    target="_blank">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Required datatable js -->
<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Responsive examples -->
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
<!-- Sweet Alerts js -->
<script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            responsive: true,
            language: {
                url: "<?= base_url() ?>/assets/plugins/datatables/Indonesian.json"
            }
        });

        // Tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Sweet Alert
        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire({
                title: 'Sukses',
                text: '<?= session()->getFlashdata('success') ?>',
                icon: 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        <?php endif; ?>
    });
</script>
<?= $this->endSection() ?>

<?php
function getMetodeBayarBadge($metode)
{
    switch ($metode) {
        case 'cash':
            return 'success';
        case 'transfer':
            return 'primary';
        case 'qris':
            return 'info';
        default:
            return 'secondary';
    }
}

function getStatusBayarBadge($status)
{
    switch ($status) {
        case 'lunas':
            return 'success';
        case 'belum_lunas':
            return 'warning';
        default:
            return 'secondary';
    }
}
?>