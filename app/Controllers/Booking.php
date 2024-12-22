<?php
namespace App\Controllers;
use App\Models\ModelBooking;

class Booking extends BaseController
{
    public function index()
    {
        if ((session()->get('masuk') == true) 
            and (session()->get('level') == 1 or session()->get('level') == 2)) 
        {
            $model = new ModelBooking();
            $data['booking'] = $model->getBooking()->getResultArray();
            $data['data_pel'] = $model->getPel()->getResultArray();
            $data['data_paket'] = $model->getPaket()->getResultArray();
            echo view('booking/v_booking', $data);
        } 
        else 
        {
            echo "<script>alert('Anda belum login'); window.location.href='/login';</script>";
        }
    }

    public function save()
 {
    $model = new ModelBooking();
    $data = array(
        'tanggal' => $this->request->getPost('tanggal'),
        'jam' => $this->request->getPost('jam'),
        'bokingidpel' => $this->request->getPost('bokingidpel'),
        'bokingidpaket' => $this->request->getPost('bokingidpaket'),
        'pembayaran' => $this->request->getPost('pembayaran'),
        'catatan' => $this->request->getPost('catatan'),
    );

    $model->insertData($data);
    return redirect()->to('/booking');
 }

    public function delete()
    {
    $model = new ModelBooking();
    $id = $this->request->getPost('id');
    $model->deletebooking($id);
    return redirect()->to('/booking/index');
    }

    function update()
    {
    $model = new ModelBooking();
    $id = $this->request->getPost('id');
    $data = array(
        'tanggal' => $this->request->getPost('tanggal'),
        'jam' => $this->request->getPost('jam'),
        'bokingidpel' => $this->request->getPost('bokingidpel'),
        'bokingidpaket' => $this->request->getPost('bokingidpaket'),
        'pembayaran' => $this->request->getPost('pembayaran'),
        'catatan' => $this->request->getPost('catatan'),
    );
    $model->updatebooking($data, $id);
    return redirect()->to('/booking/index');
    }
}
?>