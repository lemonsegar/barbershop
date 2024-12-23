<?= $this->extend('layout/main') ?>

<?= $this->section('css') ?>
<style>
    .booking-details {
        padding: 20px;
        border-radius: 8px;
        background-color: #f8f9fa;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .1);
        margin-bottom: 20px;
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
</style>
<?= $this->endSection() ?>

<?= $this->section('isi') ?>
<div class="col-sm-12">
    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Edit Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <form action="/transaksi/update/<?= $transaksi['id_transaksi'] ?>" method="post" id="form-transaksi">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id_booking" value="<?= $transaksi['id_booking'] ?>">

                            <!-- Detail Booking -->
                            <div class="booking-details">
                                <h5>Detail Booking</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="detail-row">
                                            <span class="detail-label">Pelanggan:</span>
                                            <span class="detail-value"><?= $transaksi['nama_pelanggan'] ?></span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Paket:</span>
                                            <span class="detail-value"><?= $transaksi['nama_paket'] ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="detail-row">
                                            <span class="detail-label">Tanggal Booking:</span>
                                            <span class="detail-value">
                                                <?= date('d/m/Y', strtotime($transaksi['tanggal_booking'])) ?>
                                            </span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Jam Booking:</span>
                                            <span class="detail-value">
                                                <?= date('H:i', strtotime($transaksi['jam_booking'])) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tanggal Transaksi -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Transaksi</label>
                                <div class="col-sm-10">
                                    <input type="date" name="tanggal_transaksi" class="form-control"
                                        value="<?= $transaksi['tanggal_transaksi'] ?>" required>
                                </div>
                            </div>

                            <!-- Total Bayar -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Total Bayar</label>
                                <div class="col-sm-10">
                                    <input type="number" name="total_bayar" class="form-control"
                                        value="<?= $transaksi['total_bayar'] ?>" required>
                                </div>
                            </div>

                            <!-- Metode Bayar -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Metode Pembayaran</label>
                                <div class="col-sm-10">
                                    <select name="metode_bayar" class="form-control" required>
                                        <option value="cash" <?= $transaksi['metode_bayar'] == 'cash' ? 'selected' : '' ?>>Cash</option>
                                        <option value="transfer" <?= $transaksi['metode_bayar'] == 'transfer' ? 'selected' : '' ?>>Transfer</option>
                                        <option value="qris" <?= $transaksi['metode_bayar'] == 'qris' ? 'selected' : '' ?>>QRIS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
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