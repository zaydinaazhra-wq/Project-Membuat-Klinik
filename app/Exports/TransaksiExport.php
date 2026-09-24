<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Carbon\Carbon;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents, WithCustomStartCell
{
    protected $tglAwal;
    protected $tglAkhir;
    protected $totalPemasukan = 0;

    public function __construct($tglAwal, $tglAkhir)
    {
        $this->tglAwal = $tglAwal;
        $this->tglAkhir = $tglAkhir;
    }

    // Tabel dimulai dari baris ke-4 (Baris 1 & 2 untuk Judul)
    public function startCell(): string
    {
        return 'A4';
    }

    public function collection()
    {
        return Transaksi::whereBetween('created_at', [
            $this->tglAwal . ' 00:00:00',
            $this->tglAkhir . ' 23:59:59'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Nama Pasien',
            'NIK Pasien',
            'No WA Pasien',
            'Kategori Pemeriksaan',
            'Kategori Pembayaran',
            'Diagnosis',
            'Total Bayar',
        ];
    }

    public function map($transaksi): array
    {
        static $no = 0;
        $no++;

        $this->totalPemasukan += $transaksi->total_bayar ?? 0;

        return [
            $no,
            $transaksi->created_at ? $transaksi->created_at->format('d-M-Y') : '-',
            $transaksi->nama_pasien ?? '-',
            $transaksi->nik_pasien ? "'" . $transaksi->nik_pasien : '-',
            $transaksi->no_wa_pasien ? "'" . $transaksi->no_wa_pasien : '-',
            $transaksi->kategori_pemeriksaan ?? '-',
            $transaksi->kategori_pembayaran ?? '-',
            $transaksi->diagnosis ?? '-',
            'Rp ' . number_format($transaksi->total_bayar ?? 0, 0, ',', '.'),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Format Tanggal Judul (contoh: 22-09-2026 s.d 23-09-2026)
                $tglAwalFormatted = Carbon::parse($this->tglAwal)->format('d-M-Y');
                $tglAkhirFormatted = Carbon::parse($this->tglAkhir)->format('d-M-Y');
                $judul = "REKAP TRANSAKSI TANGGAL(" . $tglAwalFormatted . " s.d " . $tglAkhirFormatted . ")";

                // 1. Tulis Judul di Baris 1 & 2
                $sheet->mergeCells("A1:I2");
                $sheet->setCellValue("A1", $judul);
                $sheet->getStyle("A1")->getFont()->setBold(true)->setSize(14);
                $sheet->getStyle("A1")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("A1")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

                // 2. Style Header Tabel (Baris 4)
                $sheet->getStyle("A4:I4")->getFont()->setBold(true);

                // 3. Tambahkan Baris Total Pemasukan
                $highestRow = $sheet->getHighestRow();
                $totalRow = $highestRow + 1;

                $sheet->mergeCells("A{$totalRow}:H{$totalRow}");
                $sheet->setCellValue("A{$totalRow}", "Total Pemasukan");
                $sheet->setCellValue("I{$totalRow}", 'Rp ' . number_format($this->totalPemasukan, 0, ',', '.'));

                // Style Baris Total
                $sheet->getStyle("A{$totalRow}:I{$totalRow}")->getFont()->setBold(true);
                $sheet->getStyle("A{$totalRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                $sheet->getStyle("I{$totalRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

                // 4. Garis Border Tabel
                $sheet->getStyle("A4:I{$totalRow}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            },
        ];
    }
}
