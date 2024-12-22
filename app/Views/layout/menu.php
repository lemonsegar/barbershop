<?= $this->extend('layout/main') ?>
<?= $this->section('menu') ?>


    <li>
        <a href="<?= site_url('layout/index') ?>" class="waves-effect">
            <i class="mdi mdi-airplay"></i>
            <span>Beranda</span>
        </a>
    </li>

    <?php if (session()->get('level') == 1) { ?>
        <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
            <i class="mdi mdi-gauge"></i>
            <span>MASTER</span>
            <span class="float-right">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <ul class="list-unstyled">
            <li><a href="<?= site_url('User/index') ?>">User</a></li>
            <li><a href="<?= site_url('Karyawan/index') ?>">Karyawan</a></li>
            <li><a href="<?= site_url('Pelanggan/index') ?>">Pelanggan</a></li>
            <li><a href="<?= site_url('Paket/index') ?>">Paket</a></li>
        </ul>
    </li>

    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
            <i class="mdi mdi-gauge"></i>
            <span>TRANSAKSI</span>
            <span class="float-right">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <ul class="list-unstyled">
            <li><a href="<?= site_url('Booking/index') ?>">Pembookingan</a></li>
        </ul>
    </li>

    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
            <i class="mdi mdi-gauge"></i>
            <span>LAPORAN</span>
            <span class="float-right">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <ul class="list-unstyled">
            <li><a href="<?= site_url('Karyawan/lapkaryawan') ?>">Laporan Karyawan</a></li>
            <li><a href="<?= site_url('Pelanggan/lappelanggan') ?>">Laporan Pelanggan</a></li>
            <li><a href="<?= site_url('Booking/lapdatabooking') ?>">Laporan Data Booking</a></li>
        </ul>
    </li>

    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
            <i class="mdi mdi-gauge"></i>
            <span>TOOLS</span>
            <span class="float-right">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <ul class="list-unstyled">
            <li><a href="<?= site_url('user/profile') ?>">Profile</a></li>
        </ul>
    </li>
<?php } ?>

<?php if (session()->get('level') == 2) { ?>
    <!-- Add level 2 menu items here if needed -->

       <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
            <i class="mdi mdi-gauge"></i>
            <span>Data Transaksi</span>
            <span class="float-right">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <ul class="list-unstyled">
            <li><a href="<?= site_url('Kasmasuk/index') ?>">Kas Masuk</a></li>
            <li><a href="charts-chartist.html">Kas Keluar</a></li>
        </ul>
    </li>

   
<?php } ?>

<?php if (session()->get('level') == 3) { ?>
    <!-- Add level 2 menu items here if needed -->

    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
            <i class="mdi mdi-gauge"></i>
            <span>Data Laporan</span>
            <span class="float-right">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <ul class="list-unstyled">
            <li><a href="<?= site_url('dokter/index') ?>">Data Donatur</a></li>
            <li><a href="charts-chartist.html">Data Pengurus</a></li>
            <li><a href="charts-chartjs.html">Data Anak Yatim</a></li>
            <li><a href="charts-chartjs.html">Kas Masjid</a></li>
            <li><a href="charts-chartjs.html">Kas Anak Yatim</a></li>
            <li><a href="charts-chartjs.html">Kas TPQ</a></li>
        </ul>
    </li>
<?php } ?>
   



<?= $this->endSection('') ?>