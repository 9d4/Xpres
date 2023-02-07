<?php

namespace App\Http\Controllers;

use App\Exports\LogExport;
use App\Models\Log;
use App\Models\LogPool;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LogController extends Controller
{
    public function export(Request $request) {
        $request->validate([
            'pool' => 'required',
        ]);

        $logPool = LogPool::query()->find($request->pool);
        if (!$logPool) abort(404);

        return Excel::download(new LogExport($logPool), 'kuda.xlsx');
    }

    public function show(Request $request, LogPool $logPool) {
        if ($pool = $request->get('pool')) {
            return redirect(route('logs.show', $pool));
        }

        $classes = StudentClass::query()->orderBy('name')->get();

        return view('main.log.classes', [
            'logPool' => $logPool,
            'classes' => $classes,
        ]);
    }

    public function showStudents(LogPool $logPool, StudentClass $class) {
        $students = $class->students()->orderBy('name')->get();

        // inject students with log if available
        foreach ($students as $s) {
            $log = $s->logs()->where('log_pool_id', $logPool->id)->first();
            if ($log) {
                $s->log = $log;
            }
        }

        return view('main.log.students', [
            'logPool' => $logPool,
            'class' => $class,
            'students' => $students,
        ]);
    }

    public function store(Request $request, LogPool $logPool, StudentClass $class) {
        $availables = $request->available;
        $bottles = $request->bottle;
        $warmings = $request->warming;
        $wearpacks = $request->wearpack;

        $students = $class->students()->get();

        for ($i = 0; $i < count($students); $i++){
            $current = $students[$i];

            $avail = isset($availables[$current->id]);
            $bottle = isset($bottles[$current->id]);
            $warming = isset($warmings[$current->id]);
            $wearpack = isset($wearpacks[$current->id]);

            $logPool->logs()->updateOrCreate(
                ['student_id' => $current->id],
                [
                    'student_id' => $current->id,
                    'available' => $avail,
                    'bottle' => $bottle,
                    'warming' => $warming,
                    'wearpack' => $wearpack,
                ]
            );
        }

        return redirect()->back()->with('saved', true);
    }
}
