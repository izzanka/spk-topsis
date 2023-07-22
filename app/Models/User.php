<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function criterias()
    {
        return $this->hasMany(Criteria::class);
    }

    public function alternatifs()
    {
        return $this->hasMany(Alternatif::class);
    }

    public function alternatif_criterias()
    {
        return $this->hasMany(AlternatifCriteria::class);
    }

    public function sub_criterias()
    {
        return $this->hasMany(SubCriteria::class);
    }

}
