<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrakan extends Model
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

        if (request('wifi') == 'A') {
            $query->when($filters['wifi'] ?? false, function ($query, $wifi) {
                return $query->where(function ($query) use ($wifi) {
                    $query->where('wifi', 'like', '%' . request('wifi') . '%');
                });
            });
        } else {
            $query->when($filters['wifi'] ?? false, function ($query, $wifi) {
                return $query->where(function ($query) use ($wifi) {
                    $query->where('wifi', 'like', request('wifi') . '%');
                });
            });
        }


        $query->when($filters['parkir'] ?? false, function ($query, $parkir) {
            return $query->where(function ($query) use ($parkir) {
                $query->where('parkir', 'like', request('parkir') . '%');
            });
        });

        $query->when($filters['ringkasan'] ?? false, function ($query, $ringkasan) {
            return $query->where(function ($query) use ($ringkasan) {
                $query->where('ringkasan', 'like', request('ringkasan') . '%');
            });
        });

        $query->when($filters['listrik'] ?? false, function ($query, $listrik) {
            return $query->where(function ($query) use ($listrik) {
                $query->where('listrik', 'like', '%' . request('listrik') . '%');
            });
        });

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

        $query->when($filters['jarak'] ?? false, function ($query, $jarak) {
            return $query->where(function ($query) use ($jarak) {
                $query->where('jarak', '<=', $jarak);
            });
        });

        return $query->where('statusPengajuan', '=', 1);
    }

    public function scopeFilteradmin($query, array $filters)
    {

        // searching tambah dan update berdasar alamat 
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

        // $query->when($filters['status'] ?? false, function ($query) {
        //     return $query->where(function ($query) {
        //         $query->where('status', 0);
        //     });
        // });


        // if (isset($filters['search']) ? $filters['search'] : false) {
        //     return $query->where('title', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('body', 'like', '%' . $filters['search'] . '%');
        // }

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
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

        return $query->where('status', '<>', 0);
    }

    public function scopeFiltertambahupdate($query, array $filters)
    {
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

    // PENGAJUAN 
    public function scopeFilterpengajuan($query, array $filters)
    {
        return $query->where('statusPengajuan', '=', 0);
    }

    // PEMBAHARUAN 
    public function scopeFilterpembaharuan($query)
    {
        return $query->where('statusUpdate', '=', 0);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
