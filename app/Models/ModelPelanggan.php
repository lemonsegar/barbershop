<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelPelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $allowedFields = ['nama', 'no_hp', 'alamat'];

    public function getPelanggan()
    {
      $builder = $this->db->table('pelanggan');
      return $builder->get();
    }


    public function insertData($data)
    {
        $this->db->table('pelanggan')->insert($data);
    }

    public function deletPelanggan($id)
    {
        $query = $this->db->table('pelanggan')->delete(array('id_pelanggan' => $id));
        return $query;
    }

    public function updatepelanggan($data, $id)
    {
        $query = $this->db->table('pelanggan')->update($data, array('id_pelanggan' => $id));
    }
}
?>