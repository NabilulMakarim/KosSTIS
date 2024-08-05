<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Kontrakan;
use \App\Models\Kost;
use \App\Models\Kamar;
use \App\Models\Konfirmasikost;
use \App\Models\Konfirmasikontrakan;
use \App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;

class KonfirmasiController extends Controller
{
    public function hapusBulan()
    {

        // $nowMonth = date('m');
        // $nowYear = date('Y');

        // $now = $nowYear . "-" . $nowMonth;

        // $new = Konfirmasikontrakan::where('updated_at', 'like', $now . '%')->first();

        // ddd($new);

        // TES 1 
        // $nowMonth = date('m');
        // $bulanLalu = $nowMonth - 1;
        // // $nowDay = date('d');
        // $nowYear = date('Y');

        // $lastMonth = $nowYear . "-" . $bulanLalu;

        $timestamp = time();
        for ($i = 0; $i <= 30; $i++) {
            $lastMonth = date('Y-m', $timestamp);
            $timestamp -= 24 * 3600;
        }
        // ddd($lastMonth);

        // $now = date('y m d');

        // $new = Konfirmasikost::where('updated_at', 'like', $lastMonth . '%')->first();
        // ddd($new);

        DB::table('konfirmasikontrakans')->where('updated_at', 'like', $lastMonth . '%')->delete();
        DB::table('konfirmasikosts')->where('updated_at', 'like', $lastMonth . '%')->delete();

        return redirect('/dashboard/konfirmasi')->with('success', 'Data riwayat pengguna menghubungi pemilik kost atau kontrakan bulan lalu berhasil dihapus');
    }

    public function hapusAll()
    {
        DB::table('konfirmasikontrakans')->delete();
        DB::table('konfirmasikosts')->delete();

        return redirect('/dashboard/konfirmasi')->with('success', 'Data riwayat pengguna menghubungi pemilik kost atau kontrakan berhasil dihapus seluruhnya');
    }

    public function indexDashboard()
    {

        $riwayatKost = Konfirmasikost::get()->count();
        $riwayatKontrakan = Konfirmasikontrakan::get()->count();
        $riwayatTotal = $riwayatKost + $riwayatKontrakan;
        // ddd($riwayatKontrakan);
        return view('dashboard.riwayat.index', [
            'title' => 'Konfirmasi',
            'active' => 'konfirmasi',
            'riwayatTotal' => $riwayatTotal,
        ]);
    }

    public function hapusKost()
    {
        $kost = request('id');
        // ddd($kost);

        DB::table('konfirmasikosts')->where('id', '=', $kost)->delete();
        //menghapus konfirmasi id yang sesuai dengan konfirmasi id yang di bawa, kost->id di sana sebenarnya adalah id konfirmasi pada tabel konfirmasiKost

        return redirect('/konfirmasi');
    }

    public function hapusKontrakan()
    {
        $kontrakan = request('id');
        // ddd($kontrakan);

        DB::table('konfirmasikontrakans')->where('id', '=', $kontrakan)->delete();
        //menghapus konfirmasi id yang sesuai dengan konfirmasi id yang di bawa, kontrakan->id di sana sebenarnya adalah id konfirmasi pada tabel konfirmasiKontrakan

        return redirect('/konfirmasi');
    }

    public function index()
    {
        // $kost_id = Konfirmasi::where('user_id', '=', auth()->user()->id)
        // ->where('keterangan', '=', "kost");
        $admin = User::where('is_admin', '=', 2)->first();

        $kost = DB::table('kamars')
            ->join('konfirmasikosts', function (JoinClause $join) {
                $join->on('kamars.id', '=', 'konfirmasikosts.kamar_id')
                    ->where('konfirmasikosts.user_id', '=', auth()->user()->id);
            })
            ->join('kosts', function (JoinClause $join) {
                $join->on('kamars.kost_id', '=', 'kosts.id');
            })
            ->select('kosts.nama', 'kosts.rt', 'kosts.rw', 'kosts.no', 'kosts.kelurahan', 'konfirmasikosts.*', 'kamars.harga', 'kamars.jumKos')
            ->orderBy('konfirmasikosts.updated_at', 'desc')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = 'kosts');

        $kontrakan = DB::table('kontrakans')
            ->join('konfirmasikontrakans', function (JoinClause $join) {
                $join->on('kontrakans.id', '=', 'konfirmasikontrakans.kontrakan_id')
                    ->where('konfirmasikontrakans.user_id', '=', auth()->user()->id);
            })
            ->select('kontrakans.nama', 'kontrakans.rt', 'kontrakans.rw', 'kontrakans.no', 'kontrakans.kelurahan', 'konfirmasikontrakans.*')
            ->orderBy('konfirmasikontrakans.updated_at', 'desc')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = 'kontrakans');

        return view('konfirmasi', [
            'title' => 'Konfirmasi',
            'active' => 'konfirmasi',
            "kosts" => $kost,
            "kontrakans" => $kontrakan,
            "admin" => $admin,
            //filter itu menuju Model Post function scopeFilter
            // 'jenisBangunan' => request('jenisBangunan'),
            // 'kelurahan' => request('kelurahan'),
            // 'rt' => request('rt'),
            // 'rw' => request('rw'),
            // 'no' => request('no'),
        ]);
    }

    public function index0()
    {
        if (request('no') && request('rt') && request('kelurahan') && request('rw')) {
            $kost = Kost::first()->filterkonfirmasi(request(['kelurahan', 'rt', 'rw', 'no', 'jumKos']))->paginate(5)->withQueryString();
            $kontrakan = Kontrakan::latest()->filterkonfirmasi(request(['kelurahan', 'rt', 'rw', 'no']))->paginate(5)->withQueryString();
        } else {
            $kost = '';
            $kontrakan = '';
        }

        return view('konfirmasi', [
            'title' => 'Konfirmasi',
            'active' => 'konfirmasi',
            "kosts" => $kost,
            "kontrakans" => $kontrakan,
            //filter itu menuju Model Post function scopeFilter
            // 'jenisBangunan' => request('jenisBangunan'),
            'kelurahan' => request('kelurahan'),
            'rt' => request('rt'),
            'rw' => request('rw'),
            'no' => request('no'),
        ]);
    }

    public function konfirmasiKamar() //request = data baru, post = data lama
    {
        $kamar_id = request('kamar_id');
        $konfirmasi_id = request('id');
        $jumKos = request('jumKos');
        // ddd($kost);

        DB::table('konfirmasikosts')->where('id', '=', $konfirmasi_id)->delete();
        //menghapus konfirmasi id yang sesuai dengan konfirmasi id yang di bawa, kost->id di sana sebenarnya adalah id konfirmasi pada tabel konfirmasiKost

        $validatedData['jumKos'] = $jumKos - 1;

        Kamar::where('id', $kamar_id)
            ->update($validatedData);

        User::where('id', auth()->user()->id)
            ->update(['tempat' => 'kamar', 'tempat_id' => $kamar_id]);

        return redirect('/profil')->with('success', 'Konfirmasi Transaksi Kost Pada Kamar Tersebut Berhasil ! Terimakasih atas konfirmasinya dan selamat datang di halaman "Tempat Tinggal Saya", silakan berikan rating dan komentar tempat tinggalmu di sini :)');
    }

    // BELUM DI SESUAIKAN 
    public function konfirmasiKontrakan() //request = data baru, post = data lama
    {
        // ddd($kontrakan);

        $konfirmasi_id = request('id');
        $kontrakan_id = request('kontrakan_id');
        // ddd($kontrakan);
        // ddd($kontrakan_id);

        DB::table('konfirmasikontrakans')->where('id', '=', $konfirmasi_id)->delete();
        //menghapus konfirmasi id yang sesuai dengan konfirmasi id yang di bawa, kontrakan->id di sana sebenarnya adalah id konfirmasi pada tabel konfirmasiKontrakan


        // return redirect('/konfirmasi');

        $validatedData['status'] = 0;

        // $validatedData['nama'] = $kontrakan->nama;
        // $validatedData['area'] = $kontrakan->area;
        // $validatedData['kelurahan'] = $kontrakan->kelurahan;
        // $validatedData['rt'] = $kontrakan->rt;
        // $validatedData['rw'] = $kontrakan->rw;
        // $validatedData['no'] = $kontrakan->no;
        // $validatedData['harga'] = $kontrakan->harga;
        // $validatedData['fasilitas'] = $kontrakan->fasilitas;
        // $validatedData['noHp'] = $kontrakan->noHp;
        // $validatedData['deskripsi'] = $kontrakan->deskripsi;
        // $validatedData['durSewa'] = $kontrakan->durSewa;
        // // $validatedData['image'] = $kontrakan->image;
        // $validatedData['jumKam'] = $kontrakan->jumKam;
        // $validatedData['listrik'] = $kontrakan->listrik;
        // // $validatedData['latitude'] = $kontrakan->latitude;
        // // $validatedData['longitude'] = $kontrakan->longitude;
        // $validatedData['user_id'] = $kontrakan->user_id;
        // $validatedData['ringkasan'] = $kontrakan->ringkasan;

        Kontrakan::where('id', $kontrakan_id)
            ->update($validatedData);

        User::where('id', auth()->user()->id)
            ->update(['tempat' => 'kontrakan', 'tempat_id' => $kontrakan_id]);

        return redirect('/profil')->with('success', 'Konfirmasi transaksi kontrakan berhasil ! Terimakasih atas konfirmasinya dan selamat datang di halaman "Tempat Tinggal Saya", silakan berikan rating dan komentar tempat tinggalmu di sini :)');
    }

    public function konfirmasiKamarOld()
    {
        // $kost_id = $kost->id; 

        return view('konfirmasiKamar', [
            'title' => 'konfirmasi kamar',
            // 'active' => 'kontrakans',
            // 'kost' => $kost,
            'kamars' => Kamar::latest()->filterkonfirmasi(request(['kost_id']))->paginate(5)->withQueryString(),
            //filter itu menuju Model Kontrakan function scopeFilter
            'kost_id' => request('kost_id'),
            // 'harga' => request('harga'),
            'kelurahan' => request('kelurahan'),
            'rt' => request('rt'),
            'rw' => request('rw'),
            'no' => request('no'),
        ]);
    }
}
