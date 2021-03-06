<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;


    #
    #   Relations
    #

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    #
    #   Scopes
    #

    public function scopeCompleted($query)
    {
        return $query->where('completed', 1);
    }

    public function scopeOngoing($query)
    {
        return $query->where('completed', 0);
    }

}
