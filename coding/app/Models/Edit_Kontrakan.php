<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edit_Kontrakan extends Model
{
    use HasFactory;
    protected $guarded = [];

    // PEMBAHARUAN 
    // public function scopeFilterpembaharuan($query)
    // {
    //     return $query->where('kontrakan_id', '=', 0);;
    // }
}
