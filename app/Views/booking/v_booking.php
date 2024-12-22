<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>

<head>


        <link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
         <script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
</head>

<div class="col-sm-12">
    <div class="page-content-wrapper ">
        <!-- end page title and breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Data Booking</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModalpeminjam" data-toggle="modal">Tambah Data</button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datapeminjam">
                                        <thead>
    <tr role="row">
        <th>No</th>
        <th>Tanggal</th>
        <th>Jam</th>
        <th>Nama Pelanggan</th>
        <th>Nama Paket</th>
        <th>Pembayaran</th>
        <th>Catatan</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php $no = 0;
    foreach ($booking as $val) {
        $no++; ?>
        <tr role="row" class="odd">
            <td><?= $no; ?></td>
            <td><?= $val['tanggal'] ?></td>
            <td><?= $val['jam'] ?></td>
            <td><?= $val['nama_pelanggan'] ?></td>
            <td><?= $val['nama_paket'] ?></td>
            <td><?= $val['pembayaran'] ?></td>
            <td><?= $val['catatan'] ?></td>
            <td>
            <button type="button"
                class="btn btn-info btn-sm btn-edit"
                data-tanggal="<?= $val['tanggal']; ?>"
                data-jam="<?= $val['jam']; ?>"
                data-nama_pelanggan="<?= $val['nama_pelanggan']; ?>"
                data-nama_paket="<?= $val['nama_paket']; ?>"
                data-pembayaran="<?= $val['pembayaran']; ?>"
                data-catatan="<?= $val['catatan']; ?>">
                <i class="fa fa-tags"></i>
            </button>

            <button type="button" class="btn btn-danger btn-sm btn-delete" data-target="#deleteModalpeminjam" 
                data-toggle="modal" data-id="<?= $val['id_booking']; ?>">
                    <i class="fa fa-trash"></i>
                </button>

            </td>
        </tr>
    <?php } ?>
</tbody>

   </table>
</div>
</div>
</div>
</div>
</div>
</div> <!-- end col -->
</div> <!-- end row -->
</div>
</div>

<!-- Form Tambah -->
<form action="/Booking/save" method="post">
<?php if (!empty(session()->getFlashdata('error'))) : ?>
 <div class="alert alert-danger alert-dismissible fade show" role="alert">
     <h4> Periksa Entrian Form </h4>
   </hr />

    <?php echo session()->getFlashdata('error'); ?>
       <button type="button" id="addModalpeminjam" class=" close " data-dismiss="alert">
          <span aria-hidden="true">&times;</span>
    
        </button>
    
</div>
<?php endif; ?>
    <div class="modal fade" id="addModalpeminjam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Bookingan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" >
                    </div>
                    <div class="col-sm-12">
                        <label>Jam</label>
                        <input type="time" class="form-control" name="jam" >
                    </div>
                    <div class="col-md-12">
                         <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Pelanggan</label>
                                    <button type="button" data-toggle="modal" data-target="#modal_pelanggan" 
                                    class="btn btn-xs btn-primary">Pelanggan</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" name="idpel" readonly id="idpel"
                                     class="form-control">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nama Pelanggan</label>
                                    <input type="text" readonly id="nama_pelanggan" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                         <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Paket</label>
                                    <button type="button" data-toggle="modal" data-target="#modal_mobil" 
                                    class="btn btn-xs btn-primary">Paket</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>ID</label>
                                    <input type="text" name="idpaket" readonly id="idpaket"
                                     class="form-control">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nama Paket</label>
                                    <input type="text" readonly id="nama_paket" class="form-control">
                                </div>
                                <div class="col-md-5">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" readonly id="harga" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>Pembayaran</label>
                        <select name="pembayaran"  class="form-control">
                            <option value="">--Pilih Pembayaran--</option>
                            <option value="Cash">Cash</option>
                            <option value="Transfer">Transfer</option>
                        </select>
                    </div> 
                    <div class="col-md-12">
                        <label>Catatan</label>
                        <input type="text" class="form-control" name="catatan" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- edit modal -->
<form action="/Booking/update" method="post">
    <div class="modal fade" id="editModalpeminjam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Bookingan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="col-sm-12">
                        <label>Tanggal</label>
                        <input type="date" class="form-control tanggal" name="tanggal" >
                    </div>
                    <div class="col-sm-12">
                        <label>Jam</label>
                        <input type="time" class="form-control jam" name="jam" >
                    </div>
                    <div class="col-md-12">
                         <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Pelanggan</label>
                                    <button type="button" data-toggle="modal" data-target="#modal_donatur" 
                                    class="btn btn-xs btn-primary">Pelanggan</button>
                                </div>
                            </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>ID</label>
                        <input type="text" name="idpel" readonly id="idpel" class="form-control idpel">
                    </div>
                    </div>
                    <div class="col-md-5">
                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text" readonly id="nama_pelanggan" class="form-control nama_pelanggan">
                    </div>
                    </div>
                    </div>
                    </div>
                       
                    <div class="col-md-12">
                         <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Paket</label>
                                    <button type="button" data-toggle="modal" data-target="#modal_donatur" 
                                    class="btn btn-xs btn-primary">Paket</button>
                                </div>
                            </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>ID</label>
                        <input type="text" name="idpaket" readonly id="idpaket" class="form-control idpaket">
                    </div>
                    </div>
                    <div class="col-md-5">
                    <div class="form-group">
                        <label>Nama Paket</label>
                        <input type="text" readonly id="nama_paket" class="form-control nama_paket">
                    </div>
                    <div class="col-md-5">
                    <div class="form-group">
                        <label>Jenis Paket</label>
                        <input type="text" readonly id="jenis_paket" class="form-control jenis_paket">
                    </div>
                    </div>
                    <div class="col-md-5">
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" readonly id="harga" class="form-control harga">
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                        <label>Pembayaran</label>
                        <select name="pembayaran"  class="form-control pembayaran">
                            <option value="">--Pilih Pembayaran--</option>
                            <option value="Cash">Cash</option>
                            <option value="Transfer">Transfer</option>
                        </select>
                    </div> 
                    <div class="col-md-12">
                        <label>Catatan</label>
                        <input type="text" class="form-control catatan"  id="catatan" name="catatan" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="/Booking/delete" method="post">
<div class="modal fade" id="deleteModalpeminjam" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModallabel">Data</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label=Close"></button>
      </div>
      <div class="modal-body">
        <h1>Yakin Di Hapus?</h1>
        </div>
    <div class="modal-footer">
        <input type="text" name="id" class="id">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">HAPUS</button>
      </div>
    </div>
  </div>
</div>
</form>


<div class="modal fade" id="modal_pelanggan">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Data Pelanggan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>ID</th>
              <th>Nama Pelanggan</th>
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
  <?php
  $no = 0;
  foreach ($data_pel as $d) :
      $no++; ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?= $d['id_pelanggan'] ?></td>
    <td><?= $d['nama'] ?></td>
    <td><?= $d['alamat'] ?></td>
    <td>
      <button type="button" class="btn btn-primary" onclick="return pilih_pelanggan('<?= $d['id_pelanggan'] ?>', '<?= $d['nama'] ?>')">
        Pilih
      </button>
    </td>
  </tr>

  <?php
endforeach;
  ?>

<div class="modal fade" id="modal_mobil">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Data Paket</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>ID</th>
              <th>Nama Paket</th>
              <th>Jenis Paket</th>
              <th>Harga</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
  <?php
  $no = 0;
  foreach ($data_paket as $d) :
      $no++; ?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?= $d['id_paket'] ?></td>
    <td><?= $d['nama_paket'] ?></td>
    <td><?= $d['jenis_paket'] ?></td>
    <td><?= $d['harga'] ?></td>
    <td>
      <button type="button" class="btn btn-primary" onclick="return pilih_paket('<?= $d['id_paket'] ?>', '<?= $d['nama_paket'] ?>,'<?= $d['jenis_paket'] ?>','<?= $d['harga'] ?>')">
        Pilih
      </button>
    </td>
  </tr>

  <?php
endforeach;
  ?>

</tbody>
</table>
</p>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>





<script>

$(document).ready(function() {
        $('#datapeminjam').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan MENU data",
                "info": "Menampilkan START hingga END dari TOTAL data"
            }
        });

    function pilih_pelanggan(id, nama, alamat) {
        $('#id_pelanggan').val(id);
        $('#nama').val(nama);
        $('#alamat').val(alamat);
        $('#modal_donatur').modal().hide();
    }

    function pilih_paket(id, nama, jenis, harga) {
        $('#id_paket').val(id);
        $('#nama_paket').val(nama);
        $('#jenis_paket').val(jenis);
        $('#harga').val(harga);
        $('#modal_donatur').modal().hide();
    }

    $('.btn-delete').on('click', function() {
        const id = $(this).data('id');
        $('.id').val(id);
        $('#deleteModalpeminjam').model('show');
    });

   // Script untuk edit data
$('.btn-edit').on('click', function() {
    const tanggal = $(this).data('tanggal');
    const jam = $(this).data('jam');
    const nama_pelanggan = $(this).data('nama_pelanggan');
    const nama_paket = $(this).data('nama_paket');
    const pembayaran = $(this).data('pembayaran');
    const catatan = $(this).data('catatan');


    $('.tanggal').val(tanggal);
    $('.jam').val(jam);
    $('.nama_pelanggan').val(nama_pelanggan);
    $('.nama_paket').val(nama_paket);
    $('.pembayaran').val(pembayaran);
    $('.catatan').val(catatan); // Pastikan class sesuai

    $('#editModalpeminjam').modal('show');
});


</script>
<?= $this->endSection('') ?>