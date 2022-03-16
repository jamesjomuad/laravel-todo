<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function scopeCompleted($query)
    {
        return $query->where('completed', 1);
    }

    public function scopeOngoing($query)
    {
        return $query->where('completed', 0);
    }
}
