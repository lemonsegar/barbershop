<?php

namespace App\Controllers;

use App\Models\ModelPaket;

class Paket extends BaseController
{
    public function index()
    {
        $model = new ModelPaket();
        $data['paket'] = $model->getPaket()->getResultArray();
        echo view('paket/v_paket', $data);
    }


    public function save()
    {
        $model = new ModelPaket();
        $data = array(
            'id_paket'  => $this->request->getPost('id'),
            'nama_paket' => $this->request->getPost('namapaket'),
            'jenis_paket'    => $this->request->getPost('jenispaket'),
            'harga' => $this->request->getPost('harga'),
        );
        if (!$this->validate([
            'id' => [
                'rules' => 'required|is_unique[paket.id_paket]',
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
        return redirect()->to('/paket');
    }

    public function delete()
    {
        $model = new ModelPaket();
        $id = $this->request->getpost('deleteId');
        $model->deletpaket($id);
        return redirect()->to('/paket');
    }

    function update()
    {
        $model = new ModelPaket();
        $id = $this->request->getPost('id');
        $data = array(
            'id_paket'  => $id,
            'nama_paket' => $this->request->getPost('namapaket'),
            'jenis_paket'    => $this->request->getPost('jenispaket'),
            'harga' => $this->request->getPost('harga'),
        );
        $model->updatepaket($data, $id);
        return redirect()->to('/paket');
    }
}
