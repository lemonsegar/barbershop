<?= $this->extend('layout/main') ?>

<?= $this->section('css') ?>
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet">
<style>
    .filter-box {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
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
                        <h4 class="mt-0 header-title float-left">Laporan Data Booking</h4>
                        <div class="card-header-action float-right">
                            <a href="/laporan/cetakBooking" target="_blank" class="btn btn-primary btn-sm">
                                <i class="fa fa-file-pdf mr-1"></i> Export PDF
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filter Section -->
                        <div class="filter-box">
                            <form id="filterForm" action="" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Dari Tanggal</label>
                                            <input type="date" id="from_date" name="from_date" class="form-control" value="<?= date('Y-m-01') ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sampai Tanggal</label>
                                            <input type="date" id="to_date" name="to_date" class="form-control" value="<?= date('Y-m-d') ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Semua Status</option>
                                                <option value="pending">Pending</option>
                                                <option value="completed">Completed</option>
                                                <option value="cancelled">Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" id="btnFilter" class="btn btn-primary">
                                            <i class="fa fa-filter mr-1"></i> Filter
                                        </button>
                                        <button type="button" id="btnReset" class="btn btn-secondary">
                                            <i class="fa fa-sync mr-1"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Booking</th>
                                        <th>ID Booking</th>
                                        <th>Pelanggan</th>
                                        <th>Paket</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($booking as $row) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= date('d/m/Y', strtotime($row['tanggal_booking'])) ?></td>
                                            <td><?= $row['id_booking'] ?></td>
                                            <td><?= $row['nama_pelanggan'] ?></td>
                                            <td><?= $row['nama_paket'] ?></td>
                                            <td><?= strtoupper($row['status']) ?></td>
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
<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        // DataTable
        var table = $('#datatable').DataTable({
            responsive: true,
            language: {
                url: "<?= base_url() ?>/assets/plugins/datatables/Indonesian.json"
            }
        });

        // Handle Filter
        $('#btnFilter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var status = $('#status').val();

            $.ajax({
                url: '/laporan/filterBooking',
                type: 'POST',
                data: {
                    from_date: from_date,
                    to_date: to_date,
                    status: status
                },
                success: function(response) {
                    table.clear();

                    if (response.data.length > 0) {
                        response.data.forEach(function(row, index) {
                            table.row.add([
                                index + 1,
                                formatDate(row.tanggal_booking),
                                row.id_booking,
                                row.nama_pelanggan,
                                row.nama_paket,
                                row.status.toUpperCase()
                            ]);
                        });
                    }

                    table.draw();
                }
            });
        });

        // Handle Reset
        $('#btnReset').click(function() {
            $('#filterForm')[0].reset();
            $('#from_date').val('<?= date('Y-m-01') ?>');
            $('#to_date').val('<?= date('Y-m-d') ?>');
            window.location.reload();
        });

        // Handle Export PDF
        $('.btn-primary').click(function(e) {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var status = $('#status').val();

            if (from_date && to_date) {
                e.preventDefault();
                window.open('/laporan/cetakBooking?from_date=' + from_date + '&to_date=' + to_date + '&status=' + status, '_blank');
            }
        });

        // Format date
        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [day, month, year].join('/');
        }

        // Load initial data
        $('#btnFilter').click();
    });
</script>
<?= $this->endSection() ?>