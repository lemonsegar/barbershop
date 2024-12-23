<?= $this->extend('layout/main') ?>

<?= $this->section('css') ?>
<link href="<?= base_url() ?>/assets/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
<style>
    .booking-details {
        display: none;
        margin-top: 20px;
        padding: 20px;
        border-radius: 8px;
        background-color: #f8f9fa;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .1);
    }

    .booking-details h5 {
        color: #333;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .detail-row {
        margin-bottom: 15px;
    }

    .detail-label {
        color: #666;
        font-weight: 500;
        margin-right: 10px;
    }

    .detail-value {
        color: #333;
        font-weight: 500;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .select2-container .select2-selection--single {
        height: 38px;
        border: 1px solid #ced4da;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px;
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
                        <h4 class="mt-0 header-title">Tambah Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <form action="/transaksi/store" method="post" id="form-transaksi">
                            <?= csrf_field() ?>

                            <!-- Pilih Booking -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pilih Booking</label>
                                <div class="col-sm-10">
                                    <select name="id_booking" id="id_booking" class="form-control select2">
                                        <option value="">Pilih Booking</option>
                                        <?php foreach ($booking as $row) : ?>
                                            <option value="<?= $row['id_booking'] ?>">
                                                <?= $row['nama_pelanggan'] ?> - <?= $row['nama_paket'] ?>
                                                (<?= date('d/m/Y H:i', strtotime($row['tanggal_booking'] . ' ' . $row['jam_booking'])) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Detail Booking -->
                            <div class="booking-details" id="booking-details">
                                <h5>Detail Booking</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-row">
                                            <span class="detail-label">Pelanggan:</span>
                                            <span class="detail-value" id="detail-pelanggan"></span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Paket:</span>
                                            <span class="detail-value" id="detail-paket"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-row">
                                            <span class="detail-label">Harga Paket:</span>
                                            <span class="detail-value" id="detail-harga"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tanggal Transaksi -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Transaksi</label>
                                <div class="col-sm-10">
                                    <input type="date" name="tanggal_transaksi" class="form-control"
                                        value="<?= date('Y-m-d') ?>" required>
                                </div>
                            </div>

                            <!-- Total Bayar -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Total Bayar</label>
                                <div class="col-sm-10">
                                    <input type="number" name="total_bayar" id="total_bayar" class="form-control" required>
                                </div>
                            </div>

                            <!-- Metode Bayar -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Metode Pembayaran</label>
                                <div class="col-sm-10">
                                    <select name="metode_bayar" class="form-control" required>
                                        <option value="cash">Cash</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="qris">QRIS</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Hidden status bayar -->
                            <input type="hidden" name="status_bayar" value="lunas">

                            <div class="form-group row">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="/transaksi" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url() ?>/assets/plugins/select2/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('.select2').select2({
            width: '100%',
            placeholder: 'Pilih Booking'
        });

        // Handle perubahan booking
        $('#id_booking').on('change', function() {
            const selected = $(this).find(':selected');
            if (selected.val()) {
                $.ajax({
                    url: '/transaksi/getBookingDetail',
                    type: 'POST',
                    data: {
                        id_booking: selected.val()
                    },
                    success: function(response) {
                        $('#detail-pelanggan').text(response.nama_pelanggan);
                        $('#detail-paket').text(response.nama_paket);
                        $('#detail-harga').text('Rp ' + formatRupiah(response.harga));
                        $('#total_bayar').val(response.harga);
                        $('#booking-details').slideDown();
                    }
                });
            } else {
                $('#booking-details').slideUp();
                $('#total_bayar').val('');
            }
        });

        // Format Rupiah
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }
    });
</script>
<?= $this->endSection() ?>