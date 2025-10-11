<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, WithEvents
{
    private $totalDeposit = 0;
    private $totalWithdrawal = 0;
    private $totalTransfer = 0;

    public function collection()
    {
        $transactions = Transaction::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        // Подсчитываем итоги
        $this->totalDeposit = $transactions->where('type', 'deposit')->sum('amount');
        $this->totalWithdrawal = $transactions->where('type', 'withdrawal')->sum('amount');
        $this->totalTransfer = $transactions->where('type', 'transfer')->sum('amount');

        return $transactions;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Пользователь',
            'Тип операции',
            'Сумма',
            'Описание',
            'Статус',
            'Дата операции'
        ];
    }

    public function map($transaction): array
    {
        $typeLabels = [
            'deposit' => 'Пополнение',
            'withdrawal' => 'Снятие',
            'transfer' => 'Перевод'
        ];

        $statusLabels = [
            'completed' => 'Завершено',
            'pending' => 'В обработке',
            'failed' => 'Ошибка'
        ];

        return [
            $transaction->id,
            $transaction->user->name,
            $typeLabels[$transaction->type] ?? $transaction->type,
            number_format($transaction->amount, 2) . ' ₽',
            $transaction->description,
            $statusLabels[$transaction->status] ?? $transaction->status,
            $transaction->created_at->format('d.m.Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Стили для заголовков
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2c5aa0'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Авто-ширина колонок
        foreach(range('A', 'G') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Стили для данных
        $sheet->getStyle('A2:G' . ($sheet->getHighestRow()))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'DDDDDD'],
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Чередование цветов строк
        $lastRow = $sheet->getHighestRow();
        for ($row = 2; $row <= $lastRow; $row++) {
            $color = $row % 2 == 0 ? 'f8f9fa' : 'ffffff';
            $sheet->getStyle('A' . $row . ':G' . $row)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB($color);
        }
    }

    public function title(): string
    {
        return 'Транзакции';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $lastRow = $event->sheet->getHighestRow();
                
                // Добавляем строку с итогами
                $event->sheet->setCellValue('C' . ($lastRow + 2), 'ИТОГО:');
                $event->sheet->setCellValue('D' . ($lastRow + 2), number_format($this->totalDeposit - $this->totalWithdrawal, 2) . ' ₽');
                
                // Детализация по типам операций
                $event->sheet->setCellValue('B' . ($lastRow + 4), 'Детализация:');
                $event->sheet->setCellValue('C' . ($lastRow + 5), 'Пополнения:');
                $event->sheet->setCellValue('D' . ($lastRow + 5), number_format($this->totalDeposit, 2) . ' ₽');
                
                $event->sheet->setCellValue('C' . ($lastRow + 6), 'Снятия:');
                $event->sheet->setCellValue('D' . ($lastRow + 6), number_format($this->totalWithdrawal, 2) . ' ₽');
                
                $event->sheet->setCellValue('C' . ($lastRow + 7), 'Переводы:');
                $event->sheet->setCellValue('D' . ($lastRow + 7), number_format($this->totalTransfer, 2) . ' ₽');

                // Стили для итогов
                $event->sheet->getStyle('C' . ($lastRow + 2) . ':D' . ($lastRow + 2))->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'color' => ['rgb' => '2c5aa0'],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'e8efff'],
                    ],
                ]);

                $event->sheet->getStyle('B' . ($lastRow + 4) . ':D' . ($lastRow + 7))->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                // Добавляем заголовок отчета
                $event->sheet->insertNewRowBefore(1, 3);
                
                $event->sheet->mergeCells('A1:G1');
                $event->sheet->setCellValue('A1', 'ВПР БАНК - ВЫПИСКА ПО ТРАНЗАКЦИЯМ');
                $event->sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                        'color' => ['rgb' => '2c5aa0'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $event->sheet->mergeCells('A2:G2');
                $event->sheet->setCellValue('A2', 'Отчет сгенерирован: ' . now()->format('d.m.Y H:i'));
                $event->sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'italic' => true,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Сдвигаем заголовки таблицы
                $event->sheet->setCellValue('A4', 'ID');
                $event->sheet->setCellValue('B4', 'Пользователь');
                $event->sheet->setCellValue('C4', 'Тип операции');
                $event->sheet->setCellValue('D4', 'Сумма');
                $event->sheet->setCellValue('E4', 'Описание');
                $event->sheet->setCellValue('F4', 'Статус');
                $event->sheet->setCellValue('G4', 'Дата операции');

                // Применяем стили к новым заголовкам
                $event->sheet->getStyle('A4:G4')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '2c5aa0'],
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}