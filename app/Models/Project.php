<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }
}
