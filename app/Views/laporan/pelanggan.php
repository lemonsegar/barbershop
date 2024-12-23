<?= $this->extend('layout/main') ?>

<?= $this->section('css') ?>
<!-- DataTables CSS -->
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet">
<style>
    .filter-box {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .report-header {
        margin: 20px 0;
        text-align: center;
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
                        <h4 class="mt-0 header-title float-left">Laporan Data Pelanggan</h4>
                        <div class="card-header-action float-right">
                            <a href="/laporan/cetakPelanggan" target="_blank" class="btn btn-primary btn-sm">
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
                                            <label>Dari ID</label>
                                            <input type="text" id="from_id" name="from_id" class="form-control" min="1">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sampai ID</label>
                                            <input type="text" id="to_id" name="to_id" class="form-control" min="1">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div>
                                                <button type="button" id="btnFilter" class="btn btn-primary">
                                                    <i class="fa fa-filter mr-1"></i> Filter
                                                </button>
                                                <button type="button" id="btnReset" class="btn btn-secondary">
                                                    <i class="fa fa-sync mr-1"></i> Reset
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Report Content -->
                        <div class="report-header">
                            <h5>BARBERSHOP</h5>
                            <p>LAPORAN DATA PELANGGAN</p>
                            <p id="filterInfo" style="display: none;">Filter ID: <span id="idRange"></span></p>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="datatable">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>ID Pelanggan</th>
                                        <th>Nama</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($pelanggan as $row) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['id_pelanggan'] ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['nohp'] ?></td>
                                            <td><?= $row['alamat'] ?></td>
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
            var from_id = $('#from_id').val();
            var to_id = $('#to_id').val();

            if (from_id && to_id) {
                if (parseInt(from_id) > parseInt(to_id)) {
                    alert('ID awal harus lebih kecil dari ID akhir!');
                    return;
                }

                $.ajax({
                    url: '/laporan/filterPelanggan',
                    type: 'POST',
                    data: {
                        from_id: from_id,
                        to_id: to_id
                    },
                    success: function(response) {
                        table.clear();

                        if (response.data.length > 0) {
                            response.data.forEach(function(row, index) {
                                table.row.add([
                                    index + 1,
                                    row.id_pelanggan,
                                    row.nama,
                                    row.nohp,
                                    row.alamat,
                                    moment(row.created_at).format('DD/MM/YYYY')
                                ]);
                            });

                            $('#idRange').text(from_id + ' - ' + to_id);
                            $('#filterInfo').show();
                        } else {
                            alert('Data tidak ditemukan');
                            $('#filterInfo').hide();
                        }

                        table.draw();
                    }
                });
            } else {
                // Jika filter kosong, tampilkan semua data
                window.location.reload();
            }
        });

        // Handle Reset
        $('#btnReset').click(function() {
            $('#filterForm')[0].reset();
            $('#filterInfo').hide();
            window.location.reload();
        });

        // Handle Export PDF with filter
        $('.btn-primary').click(function(e) {
            var from_id = $('#from_id').val();
            var to_id = $('#to_id').val();

            if (from_id && to_id) {
                e.preventDefault();
                window.open('/laporan/cetakPelanggan?from_id=' + from_id + '&to_id=' + to_id, '_blank');
            }
        });
    });
</script>
<?= $this->endSection() ?>