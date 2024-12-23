<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4><i class="fas fa-home"></i> Dashboard</h4>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <img src="https://img.okezone.com/content/2022/12/21/612/2731359/ini-arti-di-balk-tanda-merah-putih-biru-pada-barbershop-bikin-merinding-xLe6ZtyiVn.jpg" alt="Logo" width="150">
                    <h2 class="mt-3">Selamat Datang di Awan BarberShop</h2>
                    <p class="lead">Tempat potong rambut terbaik untuk tampilan terbaikmu</p>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Pelanggan</h4>
                                </div>
                                <div class="card-body">
                                    10
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Booking Hari Ini</h4>
                                </div>
                                <div class="card-body">
                                    5
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="fas fa-cut"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total Layanan</h4>
                                </div>
                                <div class="card-body">
                                    8
                                </div>
                            </div>
                        </div>
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
        // Animasi untuk card statistik
        $('.card-statistic-1').addClass('animate__animated animate__fadeInUp');
    });
</script>
<?= $this->endSection() ?>