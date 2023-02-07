<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'available',
        'bottle',
        'warming',
        'wearpack',
    ];

    public function logPool() {
        return $this->belongsTo(LogPool::class, 'log_pool_id');
    }

    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
