<?php

namespace App\Controllers;

use App\Models\ModelPelanggan;
use App\Models\ModelPaket;
use App\Models\ModelKaryawan;
use TCPDF;

class Laporan extends BaseController
{
    protected $modelPelanggan;
    protected $modelPaket;
    protected $modelKaryawan;
    protected $db;

    public function __construct()
    {
        $this->modelPelanggan = new ModelPelanggan();
        $this->modelPaket = new ModelPaket();
        $this->modelKaryawan = new ModelKaryawan();
        $this->db = \Config\Database::connect();
    }

    public function pelanggan()
    {
        $data = [
            'title' => 'Laporan Pelanggan',
            'pelanggan' => $this->modelPelanggan->findAll()
        ];
        return view('laporan/pelanggan', $data);
    }

    public function filterPelanggan()
    {
        $from_id = $this->request->getPost('from_id');
        $to_id = $this->request->getPost('to_id');

        // Build query
        $builder = $this->modelPelanggan->builder();

        // Filter hanya jika ada input
        if ($from_id && $to_id) {
            $builder->where('id_pelanggan >=', $from_id);
            $builder->where('id_pelanggan <=', $to_id);
        }

        $builder->orderBy('id_pelanggan', 'ASC');
        $data = $builder->get()->getResultArray();

        return $this->response->setJSON(['data' => $data]);
    }

    public function cetakPelanggan()
    {
        $from_id = $this->request->getGet('from_id');
        $to_id = $this->request->getGet('to_id');

        // Get data
        $builder = $this->modelPelanggan->builder();

        // Filter hanya jika ada parameter
        if ($from_id && $to_id) {
            $builder->where('id_pelanggan >=', $from_id);
            $builder->where('id_pelanggan <=', $to_id);
        }

        $builder->orderBy('id_pelanggan', 'ASC');
        $pelanggan = $builder->get()->getResultArray();

        // Create PDF
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');

        // Set document information
        $pdf->SetCreator('Barbershop');
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('Laporan Data Pelanggan');

        // Remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Add page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 11);

        // Header
        $pdf->Cell(0, 10, 'BARBERSHOP', 0, 1, 'C');
        $pdf->Cell(0, 5, 'LAPORAN DATA PELANGGAN', 0, 1, 'C');

        // Tambahkan info filter jika ada
        if ($from_id && $to_id) {
            $pdf->Cell(0, 5, 'Filter ID: ' . $from_id . ' - ' . $to_id, 0, 1, 'C');
        }

        $pdf->Ln(10);

        // Table header
        $pdf->SetFillColor(220, 220, 220);
        $pdf->Cell(10, 7, 'No', 1, 0, 'C', true);
        $pdf->Cell(30, 7, 'ID', 1, 0, 'C', true);
        $pdf->Cell(60, 7, 'Nama', 1, 0, 'C', true);
        $pdf->Cell(40, 7, 'No HP', 1, 0, 'C', true);
        $pdf->Cell(40, 7, 'Alamat', 1, 1, 'C', true);

        // Table content
        $no = 1;
        foreach ($pelanggan as $row) {
            $pdf->Cell(10, 7, $no++, 1, 0, 'C');
            $pdf->Cell(30, 7, $row['id_pelanggan'], 1, 0, 'C');
            $pdf->Cell(60, 7, $row['nama'], 1, 0, 'L');
            $pdf->Cell(40, 7, $row['nohp'], 1, 0, 'C');
            $pdf->Cell(40, 7, $row['alamat'], 1, 1, 'C');
        }

        // Output PDF
        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan_pelanggan.pdf', 'I');
    }

    public function paket()
    {
        $data = [
            'title' => 'Laporan Paket',
            'paket' => $this->modelPaket->findAll()
        ];
        return view('laporan/paket', $data);
    }

    public function filterPaket()
    {
        $from_id = $this->request->getPost('from_id');
        $to_id = $this->request->getPost('to_id');

        $builder = $this->modelPaket->builder();

        if ($from_id && $to_id) {
            $builder->where('id_paket >=', $from_id);
            $builder->where('id_paket <=', $to_id);
        }

        $builder->orderBy('id_paket', 'ASC');
        $data = $builder->get()->getResultArray();

        return $this->response->setJSON(['data' => $data]);
    }

    public function cetakPaket()
    {
        $from_id = $this->request->getGet('from_id');
        $to_id = $this->request->getGet('to_id');

        // Get data
        $builder = $this->modelPaket->builder();

        // Terapkan filter jika parameter ada
        if (!empty($from_id) && !empty($to_id)) {
            $builder->where('id_paket >=', $from_id);
            $builder->where('id_paket <=', $to_id);
        }

        $builder->orderBy('id_paket', 'ASC');
        $paket = $builder->get()->getResultArray();

        // Create PDF
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8');
        $pdf->SetCreator('Barbershop');
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('Laporan Data Paket');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        // Set margin
        $pdf->SetMargins(15, 15, 15);

        // Header
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 8, 'BARBERSHOP', 0, 1, 'C');
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 8, 'LAPORAN DATA PAKET', 0, 1, 'C');
        $pdf->Ln(5);

        // Table header
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->SetFillColor(230, 230, 230);

        // Column widths (total = 255mm for A4 Landscape with margins)
        $w = [15, 35, 100, 50, 55]; // No, ID, Nama Paket, Jenis, Harga

        // Header
        $pdf->Cell($w[0], 8, 'No', 1, 0, 'C', true);
        $pdf->Cell($w[1], 8, 'ID', 1, 0, 'C', true);
        $pdf->Cell($w[2], 8, 'Nama Paket', 1, 0, 'C', true);
        $pdf->Cell($w[3], 8, 'Jenis', 1, 0, 'C', true);
        $pdf->Cell($w[4], 8, 'Harga', 1, 1, 'C', true);

        // Table content
        $pdf->SetFont('helvetica', '', 11);
        $pdf->SetFillColor(245, 245, 245);
        $no = 1;
        $fill = false;

        foreach ($paket as $row) {
            $pdf->Cell($w[0], 8, $no++, 1, 0, 'C', $fill);
            $pdf->Cell($w[1], 8, $row['id_paket'], 1, 0, 'C', $fill);
            $pdf->Cell($w[2], 8, $row['nama_paket'], 1, 0, 'L', $fill);
            $pdf->Cell($w[3], 8, $row['jenis_paket'], 1, 0, 'C', $fill);
            $pdf->Cell($w[4], 8, 'Rp ' . number_format($row['harga'], 0, ',', '.'), 1, 1, 'R', $fill);
            $fill = !$fill;
        }

        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan_paket.pdf', 'I');
    }

    public function karyawan()
    {
        $data = [
            'title' => 'Laporan Karyawan',
            'karyawan' => $this->modelKaryawan->findAll()
        ];
        return view('laporan/karyawan', $data);
    }

    public function filterKaryawan()
    {
        $from_id = $this->request->getPost('from_id');
        $to_id = $this->request->getPost('to_id');

        $builder = $this->modelKaryawan->builder();

        if (!empty($from_id) && !empty($to_id)) {
            $builder->where('id_karyawan >=', $from_id);
            $builder->where('id_karyawan <=', $to_id);
        }

        $builder->orderBy('id_karyawan', 'ASC');
        $data = $builder->get()->getResultArray();

        return $this->response->setJSON(['data' => $data]);
    }

    public function cetakKaryawan()
    {
        $from_id = $this->request->getGet('from_id');
        $to_id = $this->request->getGet('to_id');

        $builder = $this->modelKaryawan->builder();

        if (!empty($from_id) && !empty($to_id)) {
            $builder->where('id_karyawan >=', $from_id);
            $builder->where('id_karyawan <=', $to_id);
        }

        $builder->orderBy('id_karyawan', 'ASC');
        $karyawan = $builder->get()->getResultArray();

        // Create PDF
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8');
        $pdf->SetCreator('Barbershop');
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('Laporan Data Karyawan');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        // Set margin
        $pdf->SetMargins(15, 15, 15);

        // Header
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 8, 'BARBERSHOP', 0, 1, 'C');
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 8, 'LAPORAN DATA KARYAWAN', 0, 1, 'C');
        $pdf->Ln(5);

        // Table header
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->SetFillColor(230, 230, 230);

        // Column widths
        $w = [15, 35, 70, 40, 50, 45]; // No, ID, Nama, NoHP, Alamat, Jabatan

        // Header
        $pdf->Cell($w[0], 8, 'No', 1, 0, 'C', true);
        $pdf->Cell($w[1], 8, 'ID', 1, 0, 'C', true);
        $pdf->Cell($w[2], 8, 'Nama', 1, 0, 'C', true);
        $pdf->Cell($w[3], 8, 'Jenis Kelamin', 1, 0, 'C', true);
        $pdf->Cell($w[4], 8, 'Alamat', 1, 0, 'C', true);
        $pdf->Cell($w[5], 8, 'No HP', 1, 1, 'C', true);

        // Table content
        $pdf->SetFont('helvetica', '', 11);
        $pdf->SetFillColor(245, 245, 245);
        $no = 1;
        $fill = false;

        foreach ($karyawan as $row) {
            $pdf->Cell($w[0], 8, $no++, 1, 0, 'C', $fill);
            $pdf->Cell($w[1], 8, $row['id_karyawan'], 1, 0, 'C', $fill);
            $pdf->Cell($w[2], 8, $row['nama_karyawan'], 1, 0, 'L', $fill);
            $pdf->Cell($w[3], 8, $row['jenkel'], 1, 0, 'C', $fill);
            $pdf->Cell($w[4], 8, $row['alamat'], 1, 0, 'L', $fill);
            $pdf->Cell($w[5], 8, $row['nohp'], 1, 1, 'C', $fill);
            $fill = !$fill;
        }

        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan_karyawan.pdf', 'I');
    }

    public function booking()
    {
        // Get initial data (current month)
        $builder = $this->db->table('booking b');
        $builder->select('b.*, p.nama as nama_pelanggan, pk.nama_paket');
        $builder->join('pelanggan p', 'p.id_pelanggan = b.id_pelanggan');
        $builder->join('paket pk', 'pk.id_paket = b.id_paket');
        $builder->where('MONTH(b.tanggal_booking)', date('m'));
        $builder->where('YEAR(b.tanggal_booking)', date('Y'));
        $builder->orderBy('b.tanggal_booking', 'DESC');

        $data = [
            'title' => 'Laporan Booking',
            'booking' => $builder->get()->getResultArray()
        ];

        return view('laporan/booking', $data);
    }

    public function filterBooking()
    {
        $from_date = $this->request->getPost('from_date');
        $to_date = $this->request->getPost('to_date');
        $status = $this->request->getPost('status');

        $builder = $this->db->table('booking b');
        $builder->select('b.*, p.nama as nama_pelanggan, pk.nama_paket');
        $builder->join('pelanggan p', 'p.id_pelanggan = b.id_pelanggan');
        $builder->join('paket pk', 'pk.id_paket = b.id_paket');
        $builder->where('DATE(b.tanggal_booking) >=', $from_date);
        $builder->where('DATE(b.tanggal_booking) <=', $to_date);

        if ($status !== '') {
            $builder->where('b.status', $status);
        }

        $builder->orderBy('b.tanggal_booking', 'DESC');
        $query = $builder->get();

        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function cetakBooking()
    {
        $from_date = $this->request->getGet('from_date');
        $to_date = $this->request->getGet('to_date');
        $status = $this->request->getGet('status');

        // Get data
        $builder = $this->db->table('booking b');
        $builder->select('b.*, p.nama as nama_pelanggan, pk.nama_paket');
        $builder->join('pelanggan p', 'p.id_pelanggan = b.id_pelanggan');
        $builder->join('paket pk', 'pk.id_paket = b.id_paket');
        $builder->where('DATE(b.tanggal_booking) >=', $from_date);
        $builder->where('DATE(b.tanggal_booking) <=', $to_date);

        if ($status !== '') {
            $builder->where('b.status', $status);
        }

        $builder->orderBy('b.tanggal_booking', 'DESC');
        $booking = $builder->get()->getResultArray();

        // Create PDF
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8');
        $pdf->SetCreator('Barbershop');
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('Laporan Data Booking');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        // Set margin
        $pdf->SetMargins(15, 15, 15);

        // Header
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 8, 'BARBERSHOP', 0, 1, 'C');
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 8, 'LAPORAN DATA BOOKING', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(0, 5, 'Periode: ' . date('d/m/Y', strtotime($from_date)) . ' - ' . date('d/m/Y', strtotime($to_date)), 0, 1, 'C');
        if ($status) {
            $pdf->Cell(0, 5, 'Status: ' . strtoupper($status), 0, 1, 'C');
        }
        $pdf->Ln(5);

        // Table header
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->SetFillColor(230, 230, 230);

        // Column widths (total = 260mm for A4 Landscape with margins)
        $w = [15, 35, 45, 75, 60, 30]; // No, Tanggal, ID, Pelanggan, Paket, Status

        // Header
        $pdf->Cell($w[0], 8, 'No', 1, 0, 'C', true);
        $pdf->Cell($w[1], 8, 'Tanggal', 1, 0, 'C', true);
        $pdf->Cell($w[2], 8, 'ID Booking', 1, 0, 'C', true);
        $pdf->Cell($w[3], 8, 'Pelanggan', 1, 0, 'C', true);
        $pdf->Cell($w[4], 8, 'Paket', 1, 0, 'C', true);
        $pdf->Cell($w[5], 8, 'Status', 1, 1, 'C', true);

        // Table content
        $pdf->SetFont('helvetica', '', 11);
        $pdf->SetFillColor(245, 245, 245);
        $no = 1;
        $fill = false;

        foreach ($booking as $row) {
            $pdf->Cell($w[0], 8, $no++, 1, 0, 'C', $fill);
            $pdf->Cell($w[1], 8, date('d/m/Y', strtotime($row['tanggal_booking'])), 1, 0, 'C', $fill);
            $pdf->Cell($w[2], 8, $row['id_booking'], 1, 0, 'C', $fill);
            $pdf->Cell($w[3], 8, $row['nama_pelanggan'], 1, 0, 'L', $fill);
            $pdf->Cell($w[4], 8, $row['nama_paket'], 1, 0, 'L', $fill);
            $pdf->Cell($w[5], 8, strtoupper($row['status']), 1, 1, 'C', $fill);
            $fill = !$fill;
        }

        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan_booking.pdf', 'I');
    }

    public function transaksi()
    {
        // Get initial data (current month)
        $builder = $this->db->table('transaksi t');
        $builder->select('t.*, b.id_booking, p.nama as nama_pelanggan, pk.nama_paket, pk.harga as total');
        $builder->join('booking b', 'b.id_booking = t.id_booking');
        $builder->join('pelanggan p', 'p.id_pelanggan = b.id_pelanggan');
        $builder->join('paket pk', 'pk.id_paket = b.id_paket');
        $builder->where('MONTH(t.tanggal_transaksi)', date('m'));
        $builder->where('YEAR(t.tanggal_transaksi)', date('Y'));
        $builder->orderBy('t.tanggal_transaksi', 'DESC');

        $data = [
            'title' => 'Laporan Transaksi',
            'transaksi' => $builder->get()->getResultArray()
        ];

        return view('laporan/transaksi', $data);
    }

    public function filterTransaksi()
    {
        $from_date = $this->request->getPost('from_date');
        $to_date = $this->request->getPost('to_date');

        $builder = $this->db->table('transaksi t');
        $builder->select('t.*, b.id_booking, p.nama as nama_pelanggan, pk.nama_paket, pk.harga as total');
        $builder->join('booking b', 'b.id_booking = t.id_booking');
        $builder->join('pelanggan p', 'p.id_pelanggan = b.id_pelanggan');
        $builder->join('paket pk', 'pk.id_paket = b.id_paket');
        $builder->where('DATE(t.tanggal_transaksi) >=', $from_date);
        $builder->where('DATE(t.tanggal_transaksi) <=', $to_date);
        $builder->orderBy('t.tanggal_transaksi', 'DESC');

        $query = $builder->get();

        return $this->response->setJSON(['data' => $query->getResultArray()]);
    }

    public function cetakTransaksi()
    {
        $from_date = $this->request->getGet('from_date');
        $to_date = $this->request->getGet('to_date');

        // Get data
        $builder = $this->db->table('transaksi t');
        $builder->select('t.*, b.id_booking, p.nama as nama_pelanggan, pk.nama_paket, pk.harga as total');
        $builder->join('booking b', 'b.id_booking = t.id_booking');
        $builder->join('pelanggan p', 'p.id_pelanggan = b.id_pelanggan');
        $builder->join('paket pk', 'pk.id_paket = b.id_paket');
        $builder->where('DATE(t.tanggal_transaksi) >=', $from_date);
        $builder->where('DATE(t.tanggal_transaksi) <=', $to_date);
        $builder->orderBy('t.tanggal_transaksi', 'DESC');

        $transaksi = $builder->get()->getResultArray();

        // Create PDF
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8');
        $pdf->SetCreator('Barbershop');
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('Laporan Data Transaksi');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        // Set margin
        $pdf->SetMargins(15, 15, 15);

        // Header
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 8, 'BARBERSHOP', 0, 1, 'C');
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->Cell(0, 8, 'LAPORAN DATA TRANSAKSI', 0, 1, 'C');
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(0, 5, 'Periode: ' . date('d/m/Y', strtotime($from_date)) . ' - ' . date('d/m/Y', strtotime($to_date)), 0, 1, 'C');
        $pdf->Ln(5);

        // Table header
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->SetFillColor(230, 230, 230);

        // Column widths
        $w = [15, 35, 40, 40, 55, 50, 35]; // No, Tanggal, ID Trans, ID Book, Pelanggan, Paket, Total

        // Header
        $pdf->Cell($w[0], 8, 'No', 1, 0, 'C', true);
        $pdf->Cell($w[1], 8, 'Tanggal', 1, 0, 'C', true);
        $pdf->Cell($w[2], 8, 'ID Trans', 1, 0, 'C', true);
        $pdf->Cell($w[3], 8, 'ID Book', 1, 0, 'C', true);
        $pdf->Cell($w[4], 8, 'Pelanggan', 1, 0, 'C', true);
        $pdf->Cell($w[5], 8, 'Paket', 1, 0, 'C', true);
        $pdf->Cell($w[6], 8, 'Total', 1, 1, 'C', true);

        // Table content
        $pdf->SetFont('helvetica', '', 11);
        $pdf->SetFillColor(245, 245, 245);
        $no = 1;
        $fill = false;
        $total = 0;

        foreach ($transaksi as $row) {
            $pdf->Cell($w[0], 8, $no++, 1, 0, 'C', $fill);
            $pdf->Cell($w[1], 8, date('d/m/Y', strtotime($row['tanggal_transaksi'])), 1, 0, 'C', $fill);
            $pdf->Cell($w[2], 8, $row['id_transaksi'], 1, 0, 'C', $fill);
            $pdf->Cell($w[3], 8, $row['id_booking'], 1, 0, 'C', $fill);
            $pdf->Cell($w[4], 8, $row['nama_pelanggan'], 1, 0, 'L', $fill);
            $pdf->Cell($w[5], 8, $row['nama_paket'], 1, 0, 'L', $fill);
            $pdf->Cell($w[6], 8, 'Rp ' . number_format($row['total'], 0, ',', '.'), 1, 1, 'R', $fill);
            $fill = !$fill;
            $total += $row['total'];
        }

        // Total row
        $pdf->SetFont('helvetica', 'B', 11);
        $pdf->Cell(array_sum(array_slice($w, 0, 6)), 8, 'Total', 1, 0, 'R', true);
        $pdf->Cell($w[6], 8, 'Rp ' . number_format($total, 0, ',', '.'), 1, 1, 'R', true);

        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan_transaksi.pdf', 'I');
    }
}
