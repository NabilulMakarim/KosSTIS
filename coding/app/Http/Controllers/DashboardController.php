<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kontrakan;
use App\Models\Kost;
use App\Models\Kamar;
use App\Models\User;
use App\Models\Edit_Kontrakan;
use App\Models\Edit_Kost;


class DashboardController extends Controller
{
    public function index()
    {
        // $pengguna = User::all();
        $penggunaBiasa = User::where('is_admin', 0)->get();
        $pengelola = User::where('is_admin', 1)->get();
        $kost = Kost::all();
        $kontrakan = Kontrakan::all();
        $kamar = Kamar::all();
        $penambahanKontrakan = Kontrakan::where('statusPengajuan', 0)->get();
        $pembaharuanKontrakan = Kontrakan::where('statusUpdate', 0)->get();
        $penambahanKost = Kost::where('statusPengajuan', 0)->get();
        $pembaharuanKost = Kost::where('statusUpdate', 0)->get();
        $penambahanKamar = Kamar::where('statusPengajuanKamar', 0)->get();
        $pembaharuanKamar = Kamar::where('statusUpdateKamar', 0)->get();

        // $a = $penambahanKontrakan->count();
        // $b = $penambahanKost->count();





        return view('dashboard.index', [
            'penggunaBiasa' => $penggunaBiasa,
            'pengelola' => $pengelola,
            'kost' => $kost,
            'kontrakan' => $kontrakan,
            'kamar' => $kamar,
            'penambahanKontrakan' => $penambahanKontrakan,
            'pembaharuanKontrakan' => $pembaharuanKontrakan,
            'penambahanKost' => $penambahanKost,
            'pembaharuanKost' => $pembaharuanKost,
            'penambahanKamar' => $penambahanKamar,
            'pembaharuanKamar' => $pembaharuanKamar,

        ]);
    }


    public function indexAdmin()
    {
        $admin = User::where('is_admin', '=', 2)->first();

        return view('dashboard.admin.index', [
            'admin' => $admin,


        ]);
    }

    public function home()
    {
        $admin = User::where('is_admin', '=', 2)->first();


        if (auth()->user()->is_admin == 0) {
            return view('home', [
                'admin' => $admin,
                "title" => "Home",
                "active" => 'home'
            ]);
        } else {

            $penggunaBiasa = User::where('is_admin', 0)->get();
            $pengelola = User::where('is_admin', 1)->get();
            $kost = Kost::all();
            $kontrakan = Kontrakan::all();
            $kamar = Kamar::all();
            $penambahanKontrakan = Kontrakan::where('statusPengajuan', 0)->get();
            $pembaharuanKontrakan = Kontrakan::where('statusUpdate', 0)->get();
            $penambahanKost = Kost::where('statusPengajuan', 0)->get();
            $pembaharuanKost = Kost::where('statusUpdate', 0)->get();
            $penambahanKamar = Kamar::where('statusPengajuanKamar', 0)->get();
            $pembaharuanKamar = Kamar::where('statusUpdateKamar', 0)->get();

            return view('dashboard.index', [
                'penggunaBiasa' => $penggunaBiasa,
                'pengelola' => $pengelola,
                'kost' => $kost,
                'kontrakan' => $kontrakan,
                'kamar' => $kamar,
                'penambahanKontrakan' => $penambahanKontrakan,
                'pembaharuanKontrakan' => $pembaharuanKontrakan,
                'penambahanKost' => $penambahanKost,
                'pembaharuanKost' => $pembaharuanKost,
                'penambahanKamar' => $penambahanKamar,
                'pembaharuanKamar' => $pembaharuanKamar,

            ]);
        }
    }
}
