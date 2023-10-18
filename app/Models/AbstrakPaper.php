<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbstrakPaper extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'abstrak_id',
        'paper_file',
        'presentation_file',
        'status',
        'comments',
    ];
}
