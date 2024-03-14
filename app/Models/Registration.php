<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    public function pillar()
    {
        return $this->belongsTo(Pillar::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function weeks()
    {
        return $this->hasMany(Week::class);
    }
}
