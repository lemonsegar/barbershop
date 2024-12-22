<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelPaket extends Model
{
    public function getPaket()
    {
      $builder = $this->db->table('paket');
      return $builder->get();
    }


    public function insertData($data)
    {
        $this->db->table('paket')->insert($data);
    }

    public function deletpaket($id)
    {
        $query = $this->db->table('paket')->delete(array('id_paket' => $id));
        return $query;
    }

    public function updatepaket($data, $id)
    {
        $query = $this->db->table('paket')->update($data, array('id_paket' => $id));
    }
}
?>