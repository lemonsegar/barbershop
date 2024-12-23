<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelKaryawan extends Model
{
    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    protected $allowedFields = ['nama_karyawan', 'jenkel', 'alamat', 'nohp'];

    public function getKaryawan()
    {
      $builder = $this->db->table('karyawan');
      return $builder->get();
    }


    public function insertData($data)
    {
        $this->db->table('karyawan')->insert($data);
    }

    public function deletKaryawan($id)
    {
        $query = $this->db->table('karyawan')->delete(array('id_karyawan' => $id));
        return $query;
    }

    public function updatekaryawan($data, $id)
    {
        $query = $this->db->table('karyawan')->update($data, array('id_karyawan' => $id));
    }
}
?>