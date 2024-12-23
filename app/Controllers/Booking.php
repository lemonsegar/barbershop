<?php

namespace App\Controllers;

use App\Models\ModelBooking;
use App\Models\ModelPelanggan;
use App\Models\ModelPaket;

class Booking extends BaseController
{
    protected $modelBooking;
    protected $modelPelanggan;
    protected $modelPaket;

    public function __construct()
    {
        $this->modelBooking = new ModelBooking();
        $this->modelPelanggan = new ModelPelanggan();
        $this->modelPaket = new ModelPaket();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Booking',
            'booking' => $this->modelBooking
                ->select('booking.*, pelanggan.nama as nama_pelanggan, pelanggan.nohp, 
                         paket.nama_paket, paket.jenis_paket')
                ->join('pelanggan', 'pelanggan.id_pelanggan = booking.id_pelanggan')
                ->join('paket', 'paket.id_paket = booking.id_paket')
                ->findAll()
        ];
        return view('booking/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Booking',
            'pelanggan' => $this->modelPelanggan->findAll(),
            'paket' => $this->modelPaket->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('booking/create', $data);
    }

    public function store()
    {
        if (!$this->validate($this->modelBooking->validationRules, $this->modelBooking->validationMessages)) {
            return redirect()->to('/booking/create')->withInput();
        }

        // Cek ketersediaan jam
        $existingBooking = $this->modelBooking
            ->where('tanggal_booking', $this->request->getPost('tanggal_booking'))
            ->where('jam_booking', $this->request->getPost('jam_booking'))
            ->where('status !=', 'cancelled')
            ->first();

        if ($existingBooking) {
            session()->setFlashdata('error', 'Jam tersebut sudah dibooking');
            return redirect()->to('/booking/create')->withInput();
        }

        // Ambil harga paket
        $paket = $this->modelPaket->find($this->request->getPost('id_paket'));

        $data = [
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'id_paket' => $this->request->getPost('id_paket'),
            'tanggal_booking' => $this->request->getPost('tanggal_booking'),
            'jam_booking' => $this->request->getPost('jam_booking'),
            'status' => 'pending',
            'total_harga' => $paket['harga']
        ];

        $this->modelBooking->insert($data);
        session()->setFlashdata('success', 'Booking berhasil ditambahkan');
        return redirect()->to('/booking');
    }

    public function edit($id)
    {
        $booking = $this->modelBooking->find($id);
        $pelanggan = $this->modelPelanggan->find($booking['id_pelanggan']);
        $paket = $this->modelPaket->find($booking['id_paket']);

        $data = [
            'title' => 'Edit Booking',
            'booking' => $booking,
            'pelanggan' => $this->modelPelanggan->findAll(),
            'paket' => $this->modelPaket->findAll(),
            'nama_pelanggan' => $pelanggan['nama'],
            'nama_paket' => $paket['nama_paket'],
            'jenis_paket' => $paket['jenis_paket'],
            'validation' => \Config\Services::validation()
        ];
        return view('booking/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate($this->modelBooking->validationRules, $this->modelBooking->validationMessages)) {
            return redirect()->to("/booking/edit/$id")->withInput();
        }

        // Cek ketersediaan jam kecuali untuk booking yang sedang diedit
        $existingBooking = $this->modelBooking
            ->where('tanggal_booking', $this->request->getPost('tanggal_booking'))
            ->where('jam_booking', $this->request->getPost('jam_booking'))
            ->where('id_booking !=', $id)
            ->where('status !=', 'cancelled')
            ->first();

        if ($existingBooking) {
            session()->setFlashdata('error', 'Jam tersebut sudah dibooking');
            return redirect()->to("/booking/edit/$id")->withInput();
        }

        $data = [
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'id_paket' => $this->request->getPost('id_paket'),
            'tanggal_booking' => $this->request->getPost('tanggal_booking'),
            'jam_booking' => $this->request->getPost('jam_booking'),
            'status' => $this->request->getPost('status')
        ];

        $this->modelBooking->update($id, $data);
        session()->setFlashdata('success', 'Booking berhasil diupdate');
        return redirect()->to('/booking');
    }

    public function delete($id)
    {
        $this->modelBooking->delete($id);
        session()->setFlashdata('success', 'Booking berhasil dihapus');
        return redirect()->to('/booking');
    }
}
