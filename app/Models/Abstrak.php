<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Abstrak extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'abstrak',
        'file_name',
        'status',
        'submission_year',
        'payment_amount',
    ];

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeSent($query)
    {
        return $query->where('status', 'send');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
    
    public function getShortAbstrakAttribute(){
        return substr($this->abstrak, 0, random_int(180,200)). '...';
    }

    public function getShortTitleAttribute(){
        return substr($this->title, 0, random_int(80,100)). '...';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function abstrakPaper(){
        return $this->hasOne(AbstrakPaper::class, 'abstrak_id');
    }
}
