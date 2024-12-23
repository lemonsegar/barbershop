<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBooking extends Model
{
    protected $table = 'booking';
    protected $primaryKey = 'id_booking';
    protected $allowedFields = ['id_pelanggan', 'id_paket', 'tanggal_booking', 'jam_booking', 'status', 'total_harga'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';

    // Validasi
    protected $validationRules = [
        'id_pelanggan' => 'required',
        'id_paket' => 'required',
        'tanggal_booking' => 'required|valid_date',
        'jam_booking' => 'required',
    ];

    // Pesan validasi
    protected $validationMessages = [
        'id_pelanggan' => [
            'required' => 'Pelanggan harus dipilih'
        ],
        'id_paket' => [
            'required' => 'Paket harus dipilih'
        ],
        'tanggal_booking' => [
            'required' => 'Tanggal booking harus diisi',
            'valid_date' => 'Format tanggal tidak valid'
        ],
        'jam_booking' => [
            'required' => 'Jam booking harus diisi'
        ]
    ];
}
