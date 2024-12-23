<!-- Modal Cari Pelanggan -->
<div class="modal fade" id="modalPelanggan" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cari Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped" id="tablePelanggan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pelanggan as $p) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $p['nama'] ?></td>
                                <td><?= $p['alamat'] ?></td>
                                <td><?= $p['nohp'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info"
                                        onclick="pilihPelanggan('<?= $p['id_pelanggan'] ?>', '<?= $p['nama'] ?>')">
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cari Paket -->
<div class="modal fade" id="modalPaket" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cari Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped" id="tablePaket">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Paket</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($paket as $p) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $p['nama_paket'] ?></td>
                                <td><?= $p['jenis_paket'] ?></td>
                                <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info"
                                        onclick="pilihPaket('<?= $p['id_paket'] ?>', '<?= $p['nama_paket'] ?>', '<?= $p['harga'] ?>', '<?= $p['jenis_paket'] ?>')">
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>