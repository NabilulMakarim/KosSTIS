<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['users'];

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['area'] ?? false, function ($query, $area) {
            return $query->where(function ($query) use ($area) {
                $query->where('area', 'like', '%' . $area . '%');
            });
        });

        $query->when($filters['gender'] ?? false, function ($query, $gender) {
            return $query->where(function ($query) use ($gender) {
                $query->where('gender', '=', $gender);
            });
        });


        // INI YANG BAGIAN TAMBAH DAN UPDATE 
        // search by alamat 
        $query->when($filters['kelurahan'] ?? false, function ($query, $kelurahan) {
            return $query->where(function ($query) use ($kelurahan) {
                $query->where('kelurahan', 'like', '%' . $kelurahan . '%');
            });
        });

        $query->when($filters['rt'] ?? false, function ($query, $rt) {
            return $query->where(function ($query) use ($rt) {
                $query->where('rt', '=', $rt);
            });
        });

        $query->when($filters['rw'] ?? false, function ($query, $rw) {
            return $query->where(function ($query) use ($rw) {
                $query->where('rw', '=', $rw);
            });
        });

        $query->when($filters['no'] ?? false, function ($query, $no) {
            return $query->where(function ($query) use ($no) {
                $query->where('no', '=', $no);
            });
        });

        $query->when($filters['harga'] ?? false, function ($query, $harga) {
            return $query->where(function ($query) use ($harga) {
                $query->where('harga', '=', $harga);
            });
        });
    }

    public function scopeFilteradmin($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
                // ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        // search by alamat 
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

    public function scopeFilterkonfirmasi($query, array $filters)
    {
        // konfirmasi 
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

        // return $query->where('jumKos', '<>', 0);
    }

    // PENGAJUAN 
    public function scopeFilterpengajuan($query)
    {
        return $query->where('statusPengajuan', '=', 0);;
    }

    // PEMBAHARUAN 
    public function scopeFilterpembaharuan($query)
    {
        return $query->where('statusUpdate', '=', 0);;
    }


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
