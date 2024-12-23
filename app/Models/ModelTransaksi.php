<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['id_transaksi', 'id_booking', 'tanggal_transaksi', 'total_bayar', 'metode_bayar', 'status_bayar'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = '';

    // Validasi
    protected $validationRules = [
        'id_booking' => 'required',
        'tanggal_transaksi' => 'required|valid_date',
        'total_bayar' => 'required|numeric',
        'metode_bayar' => 'required|in_list[cash,transfer,qris]',
        'status_bayar' => 'required|in_list[lunas,belum_lunas]'
    ];

    protected $validationMessages = [
        'id_booking' => [
            'required' => 'Booking harus dipilih'
        ],
        'tanggal_transaksi' => [
            'required' => 'Tanggal transaksi harus diisi',
            'valid_date' => 'Format tanggal tidak valid'
        ],
        'total_bayar' => [
            'required' => 'Total bayar harus diisi',
            'numeric' => 'Total bayar harus berupa angka'
        ],
        'metode_bayar' => [
            'required' => 'Metode pembayaran harus dipilih',
            'in_list' => 'Metode pembayaran tidak valid'
        ],
        'status_bayar' => [
            'required' => 'Status pembayaran harus dipilih',
            'in_list' => 'Status pembayaran tidak valid'
        ]
    ];

    // Generate ID Transaksi
    public function generateTransaksiId()
    {
        $date = date('Ymd');
        $lastId = $this->select('id_transaksi')
            ->like('id_transaksi', 'TRX-' . $date)
            ->orderBy('id_transaksi', 'DESC')
            ->first();

        if ($lastId) {
            $lastNo = substr($lastId['id_transaksi'], -4);
            $nextNo = str_pad(intval($lastNo) + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextNo = '0001';
        }

        return 'TRX-' . $date . $nextNo;
    }

    // Get Transaksi dengan detail booking dan pelanggan
    public function getTransaksiWithDetails()
    {
        return $this->select('transaksi.*, booking.tanggal_booking, booking.jam_booking, 
                            pelanggan.nama as nama_pelanggan, paket.nama_paket')
            ->join('booking', 'booking.id_booking = transaksi.id_booking')
            ->join('pelanggan', 'pelanggan.id_pelanggan = booking.id_pelanggan')
            ->join('paket', 'paket.id_paket = booking.id_paket')
            ->findAll();
    }

    // Get Booking yang belum ada transaksi
    public function getAvailableBookings()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('booking');

        // Ambil ID booking yang sudah ada transaksi
        $usedBookings = $this->select('id_booking')->findAll();
        $usedBookingIds = array_column($usedBookings, 'id_booking');

        // Jika belum ada transaksi, set array kosong
        if (empty($usedBookingIds)) {
            $usedBookingIds = [0];
        }

        return $builder->select('booking.*, pelanggan.nama as nama_pelanggan, paket.nama_paket, paket.harga')
            ->join('pelanggan', 'pelanggan.id_pelanggan = booking.id_pelanggan')
            ->join('paket', 'paket.id_paket = booking.id_paket')
            ->where('booking.status', 'completed')
            ->whereNotIn('booking.id_booking', $usedBookingIds)
            ->get()
            ->getResultArray();
    }
}
