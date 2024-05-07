<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'kana_name',
        'sex_id',
        'birthday',
        'email',
        'phone',
        'job_prefecture_id',
        'job_type_id',
        'body',
        '_token',
    ];
}
