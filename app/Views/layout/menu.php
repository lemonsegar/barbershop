<?php if (session()->get('level') == 1) : ?>
    <li class="menu-header">Dashboard</li>
    <li class="<?= current_url(true)->getSegment(1) == '' ? 'active' : '' ?>">
        <a href="<?= site_url('layout/index') ?>" class="nav-link">
            <i class="fas fa-fire"></i>
            <span>Beranda</span>
        </a>
    </li>

    <li class="menu-header">Master Data</li>
    <li class="nav-item dropdown <?= in_array(current_url(true)->getSegment(1), ['User', 'Karyawan', 'Pelanggan', 'Paket']) ? 'active' : '' ?>">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-database"></i>
            <span>Master</span>
        </a>
        <ul class="dropdown-menu">
            <li class="<?= current_url(true)->getSegment(1) == 'User' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('User') ?>">User</a>
            </li>
            <li class="<?= current_url(true)->getSegment(1) == 'Karyawan' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('Karyawan') ?>">Karyawan</a>
            </li>
            <li class="<?= current_url(true)->getSegment(1) == 'Pelanggan' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('Pelanggan') ?>">Pelanggan</a>
            </li>
            <li class="<?= current_url(true)->getSegment(1) == 'Paket' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= site_url('Paket') ?>">Paket</a>
            </li>
        </ul>
    </li>

    <li class="menu-header">Transaksi</li>
    <li class="<?= current_url(true)->getSegment(1) == 'Booking' ? 'active' : '' ?>">
        <a href="<?= site_url('Booking') ?>" class="nav-link">
            <i class="fas fa-calendar-check"></i>
            <span>Pembookingan</span>
        </a>
    </li>
    <li class="<?= current_url(true)->getSegment(1) == 'Transaksi' ? 'active' : '' ?>">
        <a href="<?= site_url('Transaksi') ?>" class="nav-link">
            <i class="fas fa-money-bill-wave"></i>
            <span>Transaksi</span>
        </a>
    </li>

    <li class="menu-header">Laporan</li>
    <li class="nav-item dropdown <?= in_array(current_url(true)->getSegment(2), ['lapkaryawan', 'lappelanggan', 'lapdatabooking']) ? 'active' : '' ?>">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-file-alt"></i>
            <span>Laporan</span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="<?= site_url('laporan/karyawan') ?>">Laporan Karyawan</a></li>
            <li><a class="nav-link" href="<?= site_url('laporan/pelanggan') ?>">Laporan Pelanggan</a></li>
            <li><a class="nav-link" href="<?= site_url('laporan/paket') ?>">Laporan Paket</a></li>
            <li><a class="nav-link" href="<?= site_url('laporan/booking') ?>">Laporan Booking</a></li>
            <li><a class="nav-link" href="<?= site_url('laporan/transaksi') ?>">Laporan Transaksi</a></li>
        </ul>
    </li>

<?php elseif (session()->get('level') == 2) : ?>
    <li class="menu-header">Transaksi</li>
    <li class="nav-item dropdown <?= current_url(true)->getSegment(1) == 'Kasmasuk' ? 'active' : '' ?>">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-money-bill-wave"></i>
            <span>Data Transaksi</span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="<?= site_url('Kasmasuk/index') ?>">Kas Masuk</a></li>
            <li><a class="nav-link" href="<?= site_url('Kaskeluar/index') ?>">Kas Keluar</a></li>
        </ul>
    </li>

<?php elseif (session()->get('level') == 3) : ?>
    <li class="menu-header">Laporan</li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-file-alt"></i>
            <span>Data Laporan</span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="<?= site_url('dokter/index') ?>">Data Donatur</a></li>
            <li><a class="nav-link" href="<?= site_url('pengurus') ?>">Data Pengurus</a></li>
            <li><a class="nav-link" href="<?= site_url('anakyatim') ?>">Data Anak Yatim</a></li>
            <li><a class="nav-link" href="<?= site_url('kasmasjid') ?>">Kas Masjid</a></li>
            <li><a class="nav-link" href="<?= site_url('kasanakyatim') ?>">Kas Anak Yatim</a></li>
            <li><a class="nav-link" href="<?= site_url('kastpq') ?>">Kas TPQ</a></li>
        </ul>
    </li>
<?php endif; ?>

<li class="menu-header">Pengaturan</li>
<li class="<?= current_url(true)->getSegment(2) == 'profile' ? 'active' : '' ?>">
    <a href="<?= site_url('user/profile') ?>" class="nav-link">
        <i class="fas fa-user"></i>
        <span>Profile</span>
    </a>
</li>