<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternatifCriteria extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class);
    }
    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }
    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
