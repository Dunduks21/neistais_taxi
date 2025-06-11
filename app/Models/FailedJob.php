<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FailedJob extends Model
{
    protected $table = 'failed_jobs';

    protected $casts = [
        'failed_at' => 'datetime',
    ];

    public $timestamps = false;
}
