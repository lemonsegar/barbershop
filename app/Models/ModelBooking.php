<?php
namespace App\Models;
use CodeIgniter\Model;

class ModelBooking extends Model
{
    public function getBooking()
    {
        $builder = $this->db->table('booking');
        
        // Lakukan join dengan tabel tbl_donatur2200008
        $builder->select('booking.*, pelanggan.id_pelanggan, pelanggan.nama, pelanggan.alamat, paket.id_paket, paket.nama_paket, paket.jenis_paket, paket.harga');
        $builder->join('pelanggan', 'booking.bokingidpel = pelanggan.id_pelanggan', 'left');
        $builder->join('paket', 'booking.bokingidpaket = paket.id_paket', 'left');
        
        // Kembalikan hasil query
        return $builder->get();
    }


    public function getPel()
    {
        $builder = $this->db->table('pelanggan');
        return $builder->get();
    }

    public function getPaket()
    {
        $builder = $this->db->table('paket');
        return $builder->get();
    }

    public function insertData($data)
    {
       $this->db->table('booking')->insert($data);
    }

    public function deletebooking($id)
    {
      $query = $this->db->table('booking')->delete(array('id_booking' => $id));
      return $query;
    }

    public function updatebooking($data, $id)
    {
        $query = $this->db->table('booking')->update($data, array('id_booking' => $id));
        return $query;
    }
}
?>