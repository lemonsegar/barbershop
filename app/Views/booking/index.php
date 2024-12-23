<?= $this->extend('layout/main') ?>

<?= $this->section('css') ?>
<!-- DataTables CSS -->
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Sweet Alert -->
<link href="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<!-- Custom CSS -->
<style>
    .badge {
        padding: 0.5em 1em;
        font-size: 85%;
    }

    .badge-pending {
        background-color: #f1b44c;
        color: #fff;
    }

    .badge-confirmed {
        background-color: #50a5f1;
        color: #fff;
    }

    .badge-completed {
        background-color: #34c38f;
        color: #fff;
    }

    .badge-cancelled {
        background-color: #f46a6a;
        color: #fff;
    }

    .action-buttons {
        white-space: nowrap;
    }

    .table td {
        vertical-align: middle;
    }
</style>
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
                                <h4 class="mt-0 header-title">Data Booking</h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="/booking/create" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus-circle mr-1"></i> Tambah Booking
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="databooking" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="10%">ID Booking</th>
                                        <th>Pelanggan</th>
                                        <th>Paket</th>
                                        <th width="10%">Tanggal</th>
                                        <th width="8%">Jam</th>
                                        <th width="10%">Status</th>
                                        <th width="12%">Total Harga</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($booking as $row) :
                                        $no++; ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $row['id_booking'] ?></td>
                                            <td>
                                                <div class="font-weight-bold"><?= $row['nama_pelanggan'] ?></div>
                                                <small class="text-muted"><?= $row['nohp'] ?></small>
                                            </td>
                                            <td>
                                                <div><?= $row['nama_paket'] ?></div>
                                                <small class="text-muted"><?= $row['jenis_paket'] ?></small>
                                            </td>
                                            <td><?= date('d/m/Y', strtotime($row['tanggal_booking'])) ?></td>
                                            <td><?= date('H:i', strtotime($row['jam_booking'])) ?></td>
                                            <td>
                                                <span class="badge badge-<?= getStatusBadge($row['status']) ?>">
                                                    <?= ucfirst($row['status']) ?>
                                                </span>
                                            </td>
                                            <td class="text-right">
                                                Rp <?= number_format($row['total_harga'], 0, ',', '.') ?>
                                            </td>
                                            <td class="action-buttons">
                                                <a href="/booking/edit/<?= $row['id_booking'] ?>"
                                                    class="btn btn-info btn-sm"
                                                    data-toggle="tooltip"
                                                    title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <button type="button"
                                                    class="btn btn-danger btn-sm btn-delete"
                                                    data-toggle="tooltip"
                                                    title="Hapus"
                                                    data-id="<?= $row['id_booking'] ?>"
                                                    data-pelanggan="<?= $row['nama_pelanggan'] ?>">
                                                    <i class="fa fa-trash"></i>
                                                </button>
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

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/booking/delete" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="id_booking" id="id_delete">
                    <p>Apakah Anda yakin ingin menghapus booking untuk pelanggan <strong id="pelanggan_delete"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
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
        // Inisialisasi DataTable
        $('#databooking').DataTable({
            responsive: true,
            language: {
                url: "<?= base_url() ?>/assets/plugins/datatables/Indonesian.json"
            },
            columnDefs: [{
                targets: [-1], // kolom action
                orderable: false
            }]
        });

        // Inisialisasi Tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Handle modal delete
        $('.btn-delete').on('click', function() {
            const id = $(this).data('id');
            const pelanggan = $(this).data('pelanggan');

            $('#id_delete').val(id);
            $('#pelanggan_delete').text(pelanggan);
            $('#deleteModal').modal('show');
        });

        // Flash message
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

        <?php if (session()->getFlashdata('error')) : ?>
            Swal.fire({
                title: 'Error',
                text: '<?= session()->getFlashdata('error') ?>',
                icon: 'error',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        <?php endif; ?>
    });

    // Konfirmasi delete dengan SweetAlert
    $(document).on('submit', 'form', function(e) {
        if ($(this).attr('action').indexOf('delete') > -1) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>

<?php
function getStatusBadge($status)
{
    switch ($status) {
        case 'pending':
            return 'pending';
        case 'confirmed':
            return 'confirmed';
        case 'completed':
            return 'completed';
        case 'cancelled':
            return 'cancelled';
        default:
            return 'secondary';
    }
}
?>