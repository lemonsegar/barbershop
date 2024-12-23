<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Struk Transaksi - <?= $transaksi['id_transaksi'] ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }

        .struk {
            width: 80mm;
            margin: 0 auto;
            background: #fff;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 16px;
        }

        .header p {
            margin: 5px 0;
            color: #666;
        }

        .detail {
            margin-bottom: 20px;
        }

        .detail p {
            margin: 5px 0;
        }

        .detail-label {
            color: #666;
        }

        .table {
            width: 100%;
            margin-bottom: 20px;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }

        .table td {
            padding: 5px 0;
        }

        .total {
            text-align: right;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            color: #666;
            font-size: 11px;
            margin-top: 20px;
            border-top: 1px dashed #ddd;
            padding-top: 10px;
        }

        @media print {
            body {
                padding: 0;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="struk">
        <!-- Header -->
        <div class="header">
            <h2>BARBERSHOP</h2>
            <p>Jl. Contoh No. 123, Kota</p>
            <p>Telp: 081234567890</p>
        </div>

        <!-- Detail Transaksi -->
        <div class="detail">
            <p>No: <?= $transaksi['id_transaksi'] ?></p>
            <p>Tanggal: <?= date('d/m/Y H:i', strtotime($transaksi['tanggal_transaksi'])) ?></p>
            <p>Pelanggan: <?= $transaksi['nama_pelanggan'] ?></p>
        </div>

        <!-- Detail Paket -->
        <table class="table">
            <tr>
                <td colspan="2"><?= $transaksi['nama_paket'] ?></td>
            </tr>
            <tr>
                <td><?= $transaksi['jenis_paket'] ?></td>
                <td style="text-align: right;">Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.') ?></td>
            </tr>
        </table>

        <!-- Total -->
        <div class="total">
            <p>Total: Rp <?= number_format($transaksi['total_bayar'], 0, ',', '.') ?></p>
            <p style="font-size: 11px; color: #666;">
                Pembayaran: <?= strtoupper($transaksi['metode_bayar']) ?>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih atas kunjungan Anda</p>
            <p>Selamat datang kembali</p>
        </div>
    </div>

    <!-- Tombol Print (hanya muncul di browser) -->
    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px;">Print Struk</button>
    </div>

    <script>
        // Auto print saat halaman dimuat
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>