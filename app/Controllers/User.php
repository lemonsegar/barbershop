<?php

namespace App\Controllers;

use App\Models\ModelUser;

class User extends BaseController
{
    public function index()
    {
        $model = new ModelUser();
        $data['user'] = $model->getUser()->getResultArray();
        echo view('user/v_user', $data);
    }
    public function save()
    {
    $model = new Modeluser();
    $data = array(
        'id_user'  => $this->request->getPost('id'),
        'nama_user' => $this->request->getPost('namauser'),
        'email'       => $this->request->getPost('email'),
        'Password'        => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'level'         => $this->request->getPost('level'),
    );
    if (!$this->validate([
        'id' => [
            'rules' => 'required|is_unique[user.id_user]',
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
    return redirect()->to('/user');
    }

    public function delete()
    {
    $model = new Modeluser();
    $id = $this->request->getPost('id');
    $model->deleteuser($id);
    return redirect()->to('/user');
    }

    function update()
    {
    $model = new ModelUser();
    $id = $this->request->getPost('id');
    $data = array(
        'nama_user' => $this->request->getPost('namauser'),
        'email' => $this->request->getPost('email'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'level' => $this->request->getPost('level'),
    );
    $model->updateuser($data, $id);
    return redirect()->to('/user');
    }

    public function profile()
    {
        echo view('profile');
    }

}
