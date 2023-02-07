<?php

namespace App\Exports;

use App\Models\LogPool;
use App\Models\StudentClass;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LogExport implements WithMultipleSheets
{
    use Exportable;

    protected $logPool;

    public function __construct(LogPool $logPool)
    {
        $this->logPool = $logPool;
    }

    public function sheets(): array
    {
        $sheets = [];
        $classes = StudentClass::all();

        foreach ($classes as $class) {
            $sheets[] = new LogsPerClassSheet($this->logPool, $class);
        }

        return $sheets;
    }
}
