<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function alternatif_criterias()
    {
        return $this->hasMany(AlternatifCriteria::class, 'criteria_id');
    }
}
