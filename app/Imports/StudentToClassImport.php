<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\StudentClass;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class StudentToClassImport implements ToModel, WithBatchInserts
{
    use Importable;

    private $class;

    public function __construct(StudentClass $studentClass)
    {
        $this->class = $studentClass;
    }


    public function model(array $row)
    {
        if (count($row) < 2) return null;

        $s = new Student();
        $s->num = intval($row[0]);
        $s->name = $row[1];
        $s->class_id = $this->class->id;

        return $s;
    }

    public function batchSize(): int
    {
        return 500;
    }
}
