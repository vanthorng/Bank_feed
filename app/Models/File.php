<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_name',
        's3_path',
        'url',
        'ct_02',
        'ct_03',
        'ct_04',
        'ct_05',
        'ct_06',
        'ct_07',
    ];
}
