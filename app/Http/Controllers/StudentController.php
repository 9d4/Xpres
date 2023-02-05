<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function studentsInClass(StudentClass $class) {
        $students = $class->students()->orderBy('name')->get();

        return view('main.students.list', [
            'students' => $students,
            'className' => $class->name,
        ]);
    }

    public function storeStudentsInClass(Request $request, StudentClass $class) {
        $request->validate([
            'studentsFile' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('studentsFile');
        $fstream = fopen($file->getRealPath(),'r');

        while ($line = fgetcsv($fstream,$file->getSize(), ',')){
            if (count($line) < 2) {
                continue;
            }

            $student = new Student();
            $student->num = $line[0];
            $student->name = $line[1];
            $student->class_id = $class->id;

            $student->save();
        }

        return redirect()->back()->with('upload_success', true);
    }
}
