<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function scopeFilterkosts($query, array $filters)
    {
        $query->when($filters['hargaMin'] ?? false, function ($query, $hargaMin) {
            return $query->where(function ($query) use ($hargaMin) {
                $query->where('harga', '>=', $hargaMin);
            });
        });

        $query->when($filters['hargaMaks'] ?? false, function ($query, $hargaMaks) {
            return $query->where(function ($query) use ($hargaMaks) {
                $query->where('harga', '<=', $hargaMaks);
            });
        });
    }


    public function scopeFilter($query, array $filters)
    {
        // INI YANG BAGIAN TAMBAH DAN UPDATE 

        $query->when($filters['harga'] ?? false, function ($query, $harga) {
            return $query->where(function ($query) use ($harga) {
                $query->where('harga', '=', $harga);
                // ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        return $query->where('kost_id', '=', $filters['kost_id']);
    }

    // PENGAJUAN 
    public function scopeFilterpengajuan($query)
    {
        return $query->where('statusPengajuanKamar', '=', 0);
    }

    // PEMBAHARUAN 
    public function scopeFilterpembaharuan($query)
    {
        return $query->where('statusUpdateKamar', '=', 0);
    }

    // KONFIRMASI
    public function scopeFilterkonfirmasi($query, array $filters)
    {
        return $query->where('kost_id', '=', $filters['kost_id']);
    }
}
