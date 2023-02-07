<?php

namespace App\Exports;

use App\Models\LogPool;
use App\Models\StudentClass;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LogsPerClassSheet implements FromCollection, WithHeadings, WithTitle, WithMapping, WithStyles, ShouldAutoSize
{
    private $logPool;
    private $class;

    public function __construct(LogPool $logPool, StudentClass $class)
    {
        $this->logPool = $logPool;
        $this->class = $class;
    }

    public function title(): string
    {
        return $this->class->name;
    }

    public function collection()
    {
        $logs = StudentClass::query()
            ->find($this->class->id)
            ->students()
            ->with([
                'logs' => function ($query) {
                    $query->with('student')->where('log_pool_id', $this->logPool->id);
                },
            ])
            ->get()
            ->pluck('logs')
            ->flatten();

        return $logs;
    }

    public function headings(): array
    {
        return [
            'Num',
            'Name',
            'Available',
            'Bottle',
            'Warming',
            'Wearpack',
        ];
    }

    private function getMark($x): string
    {
        return $x ? 'ü' : 'û';
    }

    public function map($log): array
    {
        return [
            $log->student->num,
            $log->student->name,
            $this->getMark($log->available),
            $this->getMark($log->bottle),
            $this->getMark($log->warming),
            $this->getMark($log->wearpack),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'C' => ['font' => ['name' => 'Wingdings']],
            'D' => ['font' => ['name' => 'Wingdings']],
            'E' => ['font' => ['name' => 'Wingdings']],
            'F' => ['font' => ['name' => 'Wingdings']],
            1 => ['font' => ['bold' => true]],
        ];
    }
}
