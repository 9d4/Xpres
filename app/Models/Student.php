<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'num',
        'name',
        'class_id',
    ];

    public function studentClass() {
        return $this->belongsTo(StudentClass::class, 'class_id');
    }

    public function logs() {
        return $this->hasMany(Log::class, 'student_id');
    }
}
