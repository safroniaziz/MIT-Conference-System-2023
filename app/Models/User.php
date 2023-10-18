<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'photo',
        'phone_number',
        'address',
        'password',
        'unique_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function abstrak(){
        return $this->hasOne(Abstrak::class, 'user_id');
    }

    public function paymentProof(){
        return $this->hasOne(PaymentProof::class, 'user_id');
    }

    public function scopeParticipant($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', 'participant');
        });
    }

    public function scopePresenter($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', 'presenter');
        });
    }
}
