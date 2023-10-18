<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'app_name',
        'app_short_name',
        'app_description',
        'presenter_payment_amount',
        'participant_payment_amount',
    ];
}
