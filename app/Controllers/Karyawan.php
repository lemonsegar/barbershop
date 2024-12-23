<?php
namespace App\Controllers;

use App\Models\ModelKaryawan;

class Karyawan extends BaseController
{
    public function index()
    {
        $model = new ModelKaryawan();
        $data['karyawan'] = $model->getKaryawan()->getResultArray();
        echo view('karyawan/v_karyawan', $data);
    }


    public function save()
    {
        $model = new ModelKaryawan();
        $data = array(
            'id_karyawan'  => $this->request->getPost('id'),
            'nama_karyawan' => $this->request->getPost('namakaryawan'),
            'jenkel'       => $this->request->getPost('jenkel'),
            'alamat' => $this->request->getPost('alamat'),
            'nohp'       => $this->request->getPost('nohp'),
        );
        if (!$this->validate([
            'id' => [
                'rules' => 'required|is_unique[karyawan.id_karyawan]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'is_unique' => '{field} Sudah ada'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            print_r($this->request->getVar());
        }

        $model->insertData($data);
        return redirect()->to('/karyawan');
    }

    public function delete()
    {
        $model = new ModelKaryawan();
        $id = $this->request->getpost('deleteId');
        $model->deletKaryawan($id);
        return redirect()->to('/karyawan');
    }

    function update()
{
    $model = new ModelKaryawan();
    $id = $this->request->getPost('id');
    $data = array(
        'id_karyawan'  => $id,
            'nama_karyawan' => $this->request->getPost('namakaryawan'),
            'jenkel'       => $this->request->getPost('jenkel'),
            'alamat' => $this->request->getPost('alamat'),
            'nohp'       => $this->request->getPost('nohp'),
    );
    $model->updatekaryawan($data, $id);
    return redirect()->to('/karyawan');
}

public function formedit($id)
    {
        $karyawanModel = new ModelKaryawan();

        // Mengambil data karyawan berdasarkan ID
        $karyawan = $karyawanModel->editData()->find($id);

        if ($karyawan) {
            $data = [
                'id' => $karyawan['id_karyawan'],
                'namakaryawan' => $karyawan['nama_karyawan'],
                'jenkel' => $karyawan['jenkel'],
                'alamat' => $karyawan['alamat'],
                'nohp' => $karyawan['nohp'],
            ];

            return view('layout/modal', $data);
        } else {
            $pesan_error = [
                'error' => '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Error</h5>
            Data karyawan Tidak Ditemukan...
          </div>'
            ];

            session()->setFlashdata($pesan_error);
            return redirect()->to('karyawan');
        }
    }
}
?>