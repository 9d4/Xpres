<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPool extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
    ];

    public function logs() {
        return $this->hasMany(Log::class, 'log_pool_id');
    }
}
