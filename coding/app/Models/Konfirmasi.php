<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konfirmasi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        // if (isset($filters['search']) ? $filters['search'] : false) {
        //     return $query->where('title', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('body', 'like', '%' . $filters['search'] . '%');
        // }

        $query->when($filters['kelurahan'] ?? false, function ($query, $kelurahan) {
            return $query->where(function ($query) use ($kelurahan) {
                $query->where('kelurahan', 'like', '%' . $kelurahan . '%');
                // ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['rt'] ?? false, function ($query, $rt) {
            return $query->where(function ($query) use ($rt) {
                $query->where('rt', '=', $rt);
                // ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['rw'] ?? false, function ($query, $rw) {
            return $query->where(function ($query) use ($rw) {
                $query->where('rw', '=', $rw);
                // ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['no'] ?? false, function ($query, $no) {
            return $query->where(function ($query) use ($no) {
                $query->where('no', '=', $no);
                // ->orWhere('body', 'like', '%' . $search . '%');
            });
        });
    }
}
