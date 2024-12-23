<?= $this->extend('layout/main') ?>

<?= $this->section('css') ?>
<style>
    .detail-transaksi {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .1);
    }

    .detail-header {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }

    .detail-body {
        margin-bottom: 20px;
    }

    .detail-label {
        color: #666;
        font-weight: 500;
    }

    .detail-value {
        color: #333;
        font-weight: 600;
    }

    .badge-payment {
        padding: 8px 12px;
        font-size: 14px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('isi') ?>
<div class="col-sm-12">
    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-lg-8">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="detail-transaksi">
                            <!-- Header -->
                            <div class="detail-header">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h4 class="mb-0">Detail Transaksi</h4>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <h5 class="mb-0"><?= $transaksi['id_transaksi'] ?></h5>
                                    </div>
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="detail-body">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="detail-label mb-1">Pelanggan</div>
                                            <div class="detail-value"><?= $transaksi['nama_pelanggan'] ?></div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="detail-label mb-1">No. HP</div>
                                            <div class="detail-value"><?= $transaksi['nohp'] ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="detail-label mb-1">Tanggal Transaksi</div>
                                            <div class="detail-value">
                                                <?= date('d/m/Y', strtotime($transaksi['tanggal_transaksi'])) ?>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="detail-label mb-1">Metode Pembayaran</div>
                                            <div class="detail-value">
                                                <span class="badge badge-<?= getMetodeBayarBadge($transaksi['metode_bayar']) ?> badge-payment">
                                                    <?= strtoupper($transaksi['metode_bayar']) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Detail Paket -->
                                <div class="table-responsive mb-4">
                                    <table class="table table-bordered">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Paket</th>
                                                <th>Jenis</th>
                                                <th class="text-right">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= $transaksi['nama_paket'] ?></td>
                                                <td><?= $transaksi['jenis_paket'] ?></td>
                                                <td class="text-right">Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.') ?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2" class="text-right">Total</th>
                                                <th class="text-right">Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.') ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="text-right">
                                <a href="/transaksi" class="btn btn-secondary">Kembali</a>
                                <a href="/transaksi/print/<?= $transaksi['id_transaksi'] ?>"
                                    class="btn btn-primary"
                                    target="_blank">
                                    <i class="fa fa-print mr-1"></i> Cetak
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
?>