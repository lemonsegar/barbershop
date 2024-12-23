<?php

namespace App\Controllers;

use App\Models\ModelTransaksi;
use App\Models\ModelBooking;

class Transaksi extends BaseController
{
    protected $modelTransaksi;
    protected $modelBooking;

    public function __construct()
    {
        $this->modelTransaksi = new ModelTransaksi();
        $this->modelBooking = new ModelBooking();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Transaksi',
            'transaksi' => $this->modelTransaksi->getTransaksiWithDetails()
        ];
        return view('transaksi/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Transaksi',
            'booking' => $this->modelTransaksi->getAvailableBookings(),
            'validation' => \Config\Services::validation()
        ];
        return view('transaksi/create', $data);
    }

    public function store()
    {
        // Validasi input
        if (!$this->validate($this->modelTransaksi->validationRules, $this->modelTransaksi->validationMessages)) {
            return redirect()->to('/transaksi/create')->withInput();
        }

        // Generate ID Transaksi
        $id_transaksi = $this->modelTransaksi->generateTransaksiId();

        // Simpan transaksi
        $data = [
            'id_transaksi' => $id_transaksi,
            'id_booking' => $this->request->getPost('id_booking'),
            'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi'),
            'total_bayar' => $this->request->getPost('total_bayar'),
            'metode_bayar' => $this->request->getPost('metode_bayar'),
            'status_bayar' => $this->request->getPost('status_bayar')
        ];

        $this->modelTransaksi->insert($data);

        // Update status booking menjadi completed
        $this->modelBooking->update($data['id_booking'], ['status' => 'completed']);

        session()->setFlashdata('success', 'Transaksi berhasil disimpan');
        return redirect()->to('/transaksi');
    }

    public function show($id)
    {
        $transaksi = $this->modelTransaksi->select('transaksi.*, 
                booking.tanggal_booking, booking.jam_booking,
                pelanggan.nama as nama_pelanggan, pelanggan.nohp,
                paket.nama_paket, paket.jenis_paket, paket.harga')
            ->join('booking', 'booking.id_booking = transaksi.id_booking')
            ->join('pelanggan', 'pelanggan.id_pelanggan = booking.id_pelanggan')
            ->join('paket', 'paket.id_paket = booking.id_paket')
            ->find($id);

        if (!$transaksi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaksi tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Transaksi',
            'transaksi' => $transaksi
        ];

        return view('transaksi/show', $data);
    }

    public function print($id)
    {
        $transaksi = $this->modelTransaksi->select('transaksi.*, 
                booking.tanggal_booking, booking.jam_booking,
                pelanggan.nama as nama_pelanggan, pelanggan.nohp,
                paket.nama_paket, paket.jenis_paket, paket.harga')
            ->join('booking', 'booking.id_booking = transaksi.id_booking')
            ->join('pelanggan', 'pelanggan.id_pelanggan = booking.id_pelanggan')
            ->join('paket', 'paket.id_paket = booking.id_paket')
            ->find($id);

        if (!$transaksi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaksi tidak ditemukan');
        }

        $data = [
            'transaksi' => $transaksi
        ];

        return view('transaksi/print', $data);
    }

    // API untuk mendapatkan detail booking
    public function getBookingDetail()
    {
        $id_booking = $this->request->getPost('id_booking');

        $booking = $this->modelBooking->select('booking.*, pelanggan.nama as nama_pelanggan, paket.nama_paket, paket.harga')
            ->join('pelanggan', 'pelanggan.id_pelanggan = booking.id_pelanggan')
            ->join('paket', 'paket.id_paket = booking.id_paket')
            ->find($id_booking);

        return $this->response->setJSON($booking);
    }

    public function edit($id)
    {
        $transaksi = $this->modelTransaksi->select('transaksi.*, 
                booking.tanggal_booking, booking.jam_booking,
                pelanggan.nama as nama_pelanggan,
                paket.nama_paket')
            ->join('booking', 'booking.id_booking = transaksi.id_booking')
            ->join('pelanggan', 'pelanggan.id_pelanggan = booking.id_pelanggan')
            ->join('paket', 'paket.id_paket = booking.id_paket')
            ->find($id);

        if (!$transaksi) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Transaksi tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Transaksi',
            'transaksi' => $transaksi,
            'validation' => \Config\Services::validation()
        ];

        return view('transaksi/edit', $data);
    }

    public function update($id)
    {
        // Validasi input
        $rules = [
            'tanggal_transaksi' => 'required|valid_date',
            'total_bayar' => 'required|numeric',
            'metode_bayar' => 'required|in_list[cash,transfer,qris]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to("/transaksi/edit/$id")->withInput();
        }

        $data = [
            'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi'),
            'total_bayar' => $this->request->getPost('total_bayar'),
            'metode_bayar' => $this->request->getPost('metode_bayar')
        ];

        try {
            $this->modelTransaksi->update($id, $data);
            session()->setFlashdata('success', 'Transaksi berhasil diupdate');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal update transaksi');
            return redirect()->to("/transaksi/edit/$id")->withInput();
        }

        return redirect()->to('/transaksi');
    }
}
