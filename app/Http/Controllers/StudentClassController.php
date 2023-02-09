<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = StudentClass::query()
            ->withCount('students')
            ->orderBy('name')
            ->get()
            ->groupBy(function ($class) {
                $name = $class->name;
                $parts = explode(' ', $name);
                return implode(' ', array_slice($parts, 0, count($parts) - 1));
            });
        ;

        foreach ($classes as $subClass) {
            $subClass->students_count = 0;
            foreach ($subClass as $c) {
                $subClass->students_count += $c->students_count;

                $c->href = route('classes.students', $c->id);
            }
        }

        return view('main.classes.list', [
            'classes' => $classes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'className' => 'required',
        ]);

        StudentClass::create([
            'name' => $request->className,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentClass $class)
    {
        $request->validate([
            'className' => 'required',
        ]);

        $class->update(['name' => $request->className]);
        return redirect()->back()->with('change_name_success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
