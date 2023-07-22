<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function alternatif_criterias()
    {
        return $this->hasMany(AlternatifCriteria::class, 'alternatif_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
