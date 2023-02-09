<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class StudentToClassImport implements ToCollection, WithBatchInserts
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

    public function collection(Collection $rows)
    {
        for ($i = 0; $i < count($rows); $i++) {
            $row = $rows[$i];
            if (count($row) < 2) continue;

            try {
                $this->class->students()->updateOrCreate(
                    ['num' => intval($row[0])],
                    [
                        'name' => $row[1],
                    ]
                );
            }catch (Exception $e) {
                dd($e);
            }
        }
    }
}
