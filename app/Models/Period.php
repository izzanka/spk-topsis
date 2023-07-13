<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function alternatif_criterias()
    {
        return $this->hasMany(AlternatifCriteria::class, 'period_id');
    }
}
