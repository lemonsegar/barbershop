<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>

<?php if (session()->getFlashdata('success') || session()->getFlashdata('error')): ?>
    <div class="alert alert-<?= session()->getFlashdata('success') ? 'success' : 'danger' ?>">
        <?= session()->getFlashdata('success') ?? session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="col-sm-12">
    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Tambah Booking</h4>
                    </div>
                    <div class="card-body">
                        <form action="/booking/store" method="post">
                            <?= csrf_field() ?>

                            <!-- Data Pelanggan -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Pelanggan</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="hidden" name="id_pelanggan" id="id_pelanggan">
                                        <input type="text" class="form-control" id="nama_pelanggan" readonly>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" onclick="cariPelanggan()">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback" id="error-pelanggan"></div>
                                </div>
                            </div>

                            <!-- Data Paket -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Paket</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="hidden" name="id_paket" id="id_paket">
                                        <input type="text" class="form-control" id="nama_paket" readonly>
                                        <input type="hidden" id="harga_paket">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary" onclick="cariPaket()">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback" id="error-paket"></div>
                                    <!-- Detail Paket -->
                                    <div id="detail_paket" style="display:none;" class="mt-2">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title" id="detail_nama_paket"></h5>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p class="mb-1">Jenis Paket: <span id="detail_jenis_paket"></span></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="mb-1">Harga: <span id="detail_harga_paket"></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tanggal dan Jam -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Booking</label>
                                <div class="col-sm-10">
                                    <input type="date" name="tanggal_booking" class="form-control" id="tanggal_booking">
                                    <div class="invalid-feedback" id="error-tanggal"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jam Booking</label>
                                <div class="col-sm-10">
                                    <input type="time" name="jam_booking" class="form-control" id="jam_booking">
                                    <div class="invalid-feedback" id="error-jam"></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Total Harga</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="total_harga" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="/booking" class="btn btn-secondary">Kembali</a>
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
<script>
    $(document).ready(function() {
        $('#tablePelanggan').DataTable();
        $('#tablePaket').DataTable();
    });

    function cariPelanggan() {
        $('#modalPelanggan').modal('show');
    }

    function pilihPelanggan(id, nama) {
        $('#id_pelanggan').val(id);
        $('#nama_pelanggan').val(nama);
        $('#modalPelanggan').modal('hide');
    }

    function cariPaket() {
        $('#modalPaket').modal('show');
    }

    function pilihPaket(id, nama, harga, jenis) {
        $('#id_paket').val(id);
        $('#nama_paket').val(nama);
        $('#harga_paket').val(harga);
        $('#total_harga').val('Rp ' + formatRupiah(harga));

        // Tampilkan detail paket
        $('#detail_nama_paket').text(nama);
        $('#detail_jenis_paket').text(jenis);
        $('#detail_harga_paket').text('Rp ' + formatRupiah(harga));
        $('#detail_paket').slideDown();

        $('#modalPaket').modal('hide');
    }

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
    }

    // Validasi form
    $('form').on('submit', function(e) {
        e.preventDefault();

        let valid = true;

        if (!$('#id_pelanggan').val()) {
            $('#error-pelanggan').text('Pelanggan harus dipilih').show();
            valid = false;
        }

        if (!$('#id_paket').val()) {
            $('#error-paket').text('Paket harus dipilih').show();
            valid = false;
        }

        if (!$('#tanggal_booking').val()) {
            $('#error-tanggal').text('Tanggal harus diisi').show();
            valid = false;
        }

        if (!$('#jam_booking').val()) {
            $('#error-jam').text('Jam harus diisi').show();
            valid = false;
        }

        if (valid) {
            this.submit();
        }
    });

    function resetDetailPaket() {
        $('#detail_paket').slideUp();
        $('#id_paket').val('');
        $('#nama_paket').val('');
        $('#harga_paket').val('');
        $('#total_harga').val('');
    }

    // Reset detail saat form direset
    $('button[type="reset"]').on('click', function() {
        resetDetailPaket();
    });
</script>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<style>
    #detail_paket {
        transition: all 0.3s ease;
    }

    #detail_paket .card {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
    }

    #detail_paket .card-title {
        color: #495057;
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    #detail_paket p {
        color: #6c757d;
    }

    #detail_paket span {
        color: #212529;
        font-weight: 500;
    }
</style>
<?= $this->endSection() ?>