<?php

namespace App\Http\Controllers;

use App\Models\LogPool;
use Illuminate\Http\Request;

class LogPoolController extends Controller
{
    public function index() {
        $pools = LogPool::query()->orderBy('date')->get();

        return view('main.logpool.list', [
            'pools' => $pools,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'poolDate' => 'required|date|unique:log_pools,date'
        ]);

        $pool = new LogPool();
        $pool->date = $request->poolDate;

        if (!$pool->save()) {
            return redirect()->back()->with(['create_failed' => true]);
        }

        return redirect()->back()->with(['create_success' => true]);
    }
}
