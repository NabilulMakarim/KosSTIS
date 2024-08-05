<?php

namespace App\Http\Controllers;

use App\Models\Edit_Kontrakan;
use App\Models\Edit_Kost;
use App\Models\Edit_Kamar;
use App\Models\Kost;
use App\Models\Kontrakan;
use App\Models\Kamar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;


use Illuminate\Http\Request;

class PembaharuanController extends Controller
{
    public function index()
    {
        $kamarKosts = DB::table('kosts')
            ->join('kamars', function (JoinClause $join) {
                $join->on('kosts.id', '=', 'kamars.kost_id')
                    ->where('kamars.statusUpdateKamar', '=', 0);
                // ->where('kosts.nama', 'like', '%' . request('search') . '%');
            })
            ->select('kosts.nama', 'kamars.*')
            // ->orderBy('kamars.harga', 'asc')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = 'kamars');

        return view('dashboard.pembaharuan.index', [
            'kosts' => Kost::latest()->filterpembaharuan(request(['statusUpdate']))->paginate($perPage = 5, $columns = ['*'], $pageName = 'kosts'),
            'kontrakans' => Kontrakan::latest()->filterpembaharuan(request(['statusUpdate']))->paginate($perPage = 5, $columns = ['*'], $pageName = 'kontrakans'),
            'kamars' => $kamarKosts,

        ]);
    }


    // DETAIL 
    public function detailKontrakan(Kontrakan $kontrakan)
    {

        $edit = Edit_Kontrakan::where('kontrakan_id', $kontrakan->id)->first();
        $user = DB::table('users')->where('id',  $kontrakan->user_id)->first();


        return view('dashboard.pembaharuan.detailKontrakan', [
            'kontrakan' => $kontrakan,
            'edit' => $edit,
            'user' => $user,
        ]);
    }

    public function detailKost(Kost $kost)
    {

        $user = DB::table('users')->where('id',  $kost->user_id)->first();
        $edit = Edit_Kost::where('kost_id', $kost->id)->first();

        // ddd($user)

        return view('dashboard.pembaharuan.detailKost', [
            'kost' => $kost,
            'user' => $user,
            'edit' => $edit,
        ]);
    }

    public function detailKamar(Kamar $kamar)
    {

        $user = DB::table('users')->where('id',  $kamar->user_id)->first();
        $edit = Edit_Kamar::where('kamar_id', $kamar->id)->first();

        // ddd($edit);

        return view('dashboard.pembaharuan.detailKamar', [
            'kamar' => $kamar,
            'user' => $user,
            'edit' => $edit,
        ]);
    }


    // TOLAK 
    public function tolakKontrakan(Kontrakan $kontrakan)
    {
        if ($kontrakan->image) {
            Storage::delete($kontrakan->image);
        }

        $deleted = Edit_Kontrakan::where('kontrakan_id', $kontrakan->id)->delete();

        Kontrakan::where('id', $kontrakan->id)
            ->update(['statusUpdate' => 1]);

        return redirect('/dashboard/pembaharuan')->with('success', 'Pengajuan Pembaharuan data Kontrakan berhasil ditolak!');
    }

    public function tolakKost(Kost $kost)
    {
        if ($kost->image) {
            Storage::delete($kost->image);
        }

        $deleted = Edit_Kost::where('kost_id', $kost->id)->delete();

        Kost::where('id', $kost->id)
            ->update(['statusUpdate' => 1]);

        return redirect('/dashboard/pembaharuan')->with('success', 'Pengajuan Pembaharuan data Kost berhasil ditolak!');
    }

    public function tolakKamar(Kamar $kamar)
    {
        if ($kamar->imageKamar) {
            Storage::delete($kamar->imageKamar);
        }

        $deleted = Edit_Kamar::where('kamar_id', $kamar->id)->delete();

        Kamar::where('id', $kamar->id)
            ->update(['statusUpdateKamar' => 1]);

        return redirect('/dashboard/pembaharuan')->with('success', 'Pengajuan Pembaharuan data Kamar berhasil ditolak!');
    }


    // TERIMA 
    public function terimaKontrakan(Kontrakan $kontrakan) //request = data baru, post = data lama
    {
        $edit = Edit_Kontrakan::where('kontrakan_id', $kontrakan->id)->first();

        $validatedData['status'] = $edit->status;

        $validatedData['nama'] = $edit->nama;
        // $validatedData['area'] = $edit->area;
        // $validatedData['kelurahan'] = $edit->kelurahan;
        // $validatedData['rt'] = $edit->rt;
        // $validatedData['rw'] = $edit->rw;
        // $validatedData['no'] = $edit->no;
        $validatedData['harga'] = $edit->harga;
        $validatedData['fasilitas'] = $edit->fasilitas;
        $validatedData['noHp'] = $edit->noHp;
        $validatedData['deskripsi'] = $edit->deskripsi;
        $validatedData['durSewa'] = $edit->durSewa;
        // $validatedData['image'] = $edit->image;
        $validatedData['jumKam'] = $edit->jumKam;
        $validatedData['listrik'] = $edit->listrik;
        $validatedData['latitude'] = $edit->latitude;
        $validatedData['longitude'] = $edit->longitude;
        $validatedData['user_id'] = $edit->user_id;
        $validatedData['statusUpdate'] = 1;
        $validatedData['ringkasan'] = $edit->ringkasan;

        //Jika gambar ada isinya (true), tambah 1 validate data, upload sekaligus ambil
        if ($edit->image) {
            if ($kontrakan->image) {
                Storage::delete($kontrakan->image);
            }
            $validatedData['image'] = $edit->image;
        }

        Kontrakan::where('id', $kontrakan->id)
            ->update($validatedData);

        $deleted = Edit_Kontrakan::where('kontrakan_id', $kontrakan->id)->delete();

        return redirect('/dashboard/pembaharuan')->with('success', 'Data Pengajuan Pembaharuan Kontrakan Berhasil disetujui!');
    }

    public function terimaKost(Kost $kost) //request = data baru, post = data lama
    {
        $edit = Edit_Kost::where('kost_id', $kost->id)->first();

        // $validatedData['status'] = $edit->status;

        $validatedData['nama'] = $edit->nama;
        // $validatedData['area'] = $edit->area;
        // $validatedData['kelurahan'] = $edit->kelurahan;
        // $validatedData['rt'] = $edit->rt;
        // $validatedData['rw'] = $edit->rw;
        // $validatedData['no'] = $edit->no;
        $validatedData['area'] = $edit->area;
        $validatedData['fasilitas'] = $edit->fasilitas;
        $validatedData['noHp'] = $edit->noHp;
        $validatedData['deskripsi'] = $edit->deskripsi;
        $validatedData['gender'] = $edit->gender;
        // $validatedData['image'] = $edit->image;
        // $validatedData['jumKam'] = $edit->jumKam;
        // $validatedData['listrik'] = $edit->listrik;
        $validatedData['latitude'] = $edit->latitude;
        $validatedData['longitude'] = $edit->longitude;
        $validatedData['user_id'] = $edit->user_id;
        $validatedData['statusUpdate'] = 1;
        $validatedData['ringkasan'] = $edit->ringkasan;

        //Jika gambar ada isinya (true), tambah 1 validate data, upload sekaligus ambil
        if ($edit->image) {
            if ($kost->image) {
                Storage::delete($kost->image);
            }
            $validatedData['image'] = $edit->image;
        }

        Kost::where('id', $kost->id)
            ->update($validatedData);

        $deleted = Edit_Kost::where('kost_id', $kost->id)->delete();

        return redirect('/dashboard/pembaharuan')->with('success', 'Data Pengajuan Pembaharuan Kost Berhasil disetujui!');
    }

    public function terimaKamar(Kamar $kamar) //request = data baru, post = data lama
    {
        $edit = Edit_Kamar::where('kamar_id', $kamar->id)->first();

        $validatedData['harga'] = $edit->harga;

        $validatedData['kamarMandi'] = $edit->kamarMandi;
        // $validatedData['area'] = $edit->area;
        // $validatedData['kelurahan'] = $edit->kelurahan;
        // $validatedData['rt'] = $edit->rt;
        // $validatedData['rw'] = $edit->rw;
        // $validatedData['no'] = $edit->no;
        // $validatedData['kost_id'] = $edit->kost_id;
        $validatedData['fasilitasKamar'] = $edit->fasilitasKamar;
        $validatedData['jumKos'] = $edit->jumKos;
        $validatedData['deskripsiKamar'] = $edit->deskripsiKamar;
        $validatedData['durSewa'] = $edit->durSewa;
        // $validatedData['imageKamar'] = $edit->imageKamar;
        $validatedData['jumKam'] = $edit->jumKam;
        // $validatedData['listrik'] = $edit->listrik;
        // $validatedData['latitude'] = $edit->latitude;
        // $validatedData['longitude'] = $edit->longitude;
        $validatedData['user_id'] = $edit->user_id;
        $validatedData['statusUpdateKamar'] = 1;
        $validatedData['ringkasanKamar'] = Str::limit(strip_tags($edit->deskripsiKamar), 20, '...');

        //Jika gambar ada isinya (true), tambah 1 validate data, upload sekaligus ambil
        if ($edit->imageKamar) {
            if ($kamar->imageKamar) {
                Storage::delete($kamar->imageKamar);
            }
            $validatedData['imageKamar'] = $edit->imageKamar;

            // $validatedData['imageKamar'] = $edit->file('imageKamar')->store('post-images');
        }

        Kamar::where('id', $kamar->id)
            ->update($validatedData);

        $deleted = Edit_Kamar::where('kamar_id', $kamar->id)->delete();

        return redirect('/dashboard/pembaharuan')->with('success', 'Data Pengajuan Pembaharuan Kamar Berhasil disetujui!');
    }
}
