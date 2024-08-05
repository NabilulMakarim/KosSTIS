<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kost;
use App\Models\Kontrakan;
use App\Models\Kamar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Query\JoinClause;


class PenambahanController extends Controller
{
    public function index()
    {

        $kamarKosts = DB::table('kosts')
            ->join('kamars', function (JoinClause $join) {
                $join->on('kosts.id', '=', 'kamars.kost_id')
                    ->where('kamars.statusPengajuanKamar', '=', 0);
                // ->where('kosts.nama', 'like', '%' . request('search') . '%');
            })
            ->select('kosts.nama', 'kamars.*')
            // ->orderBy('kamars.harga', 'asc')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = 'kamars');

        return view('dashboard.penambahan.index', [
            'kosts' => Kost::latest()->filterpengajuan(request(['statusPengajuan']))->paginate($perPage = 5, $columns = ['*'], $pageName = 'kosts'),
            'kontrakans' => Kontrakan::latest()->filterpengajuan(request(['statusPengajuan']))->paginate($perPage = 5, $columns = ['*'], $pageName = 'kontrakans'),
            'kamars' => $kamarKosts
        ]);
    }

    public function detailKontrakan(Kontrakan $kontrakan)
    {
        $user = DB::table('users')->where('id',  $kontrakan->user_id)->first();

        return view('dashboard.penambahan.detailKontrakan', [
            'kontrakan' => $kontrakan,
            'user' => $user
        ]);
    }

    public function detailKost(Kost $kost)
    {
        $user = DB::table('users')->where('id', $kost->user_id)->first();

        // ddd($user);
        return view('dashboard.penambahan.detailKost', [
            'user' => $user,
            'kost' => $kost
        ]);
    }

    public function detailKamar(Kamar $kamar)
    {

        $user = DB::table('users')->where('id',  $kamar->user_id)->first();
        $kost = DB::table('kosts')->where('id',  $kamar->kost_id)->first();

        return view('dashboard.penambahan.detailKamar', [
            'kamar' => $kamar,
            'user' => $user,
            'kost' => $kost,

        ]);
    }


    public function tolakKost(Kost $kost)
    {
        if ($kost->image) {
            Storage::delete($kost->image);
        }

        kost::destroy($kost->id);

        return redirect('/dashboard/penambahan')->with('success', 'Pengajuan Penambahan data Kost berhasil ditolak!');
    }

    public function tolakKontrakan(Kontrakan $kontrakan)
    {
        if ($kontrakan->image) {
            Storage::delete($kontrakan->image);
        }

        Kontrakan::destroy($kontrakan->id);

        return redirect('/dashboard/penambahan')->with('success', 'Pengajuan Penambahan data Kontrakan berhasil ditolak!');
    }

    public function tolakKamar(Kamar $kamar)
    {
        if ($kamar->imageKamar) {
            Storage::delete($kamar->imageKamar);
        }

        Kamar::destroy($kamar->id);

        return redirect('/dashboard/penambahan')->with('success', 'Pengajuan Penambahan data kamar berhasil ditolak!');
    }


    public function terimaKontrakan(Kontrakan $kontrakan)
    {
        Kontrakan::where('id', $kontrakan->id)
            ->update(['statusPengajuan' => 1]);

        return redirect('/dashboard/penambahan')->with('success', 'Penambahan data Kontrakan berhasil disetujui!');
    }

    public function terimaKost(Kost $kost)
    {
        Kost::where('id', $kost->id)
            ->update(['statusPengajuan' => 1]);

        return redirect('/dashboard/penambahan')->with('success', 'Penambahan data Kost berhasil disetujui!');
    }

    public function terimaKamar(Kamar $kamar)
    {
        Kamar::where('id', $kamar->id)
            ->update(['statusPengajuanKamar' => 1]);

        return redirect('/dashboard/penambahan')->with('success', 'Penambahan data Kamar berhasil disetujui!');
    }

    public function editKontrakan(Kontrakan $kontrakan)
    {

        return view('dashboard.penambahan.editKontrakan', [
            'title' => 'Kontrakan',
            'kontrakan' => $kontrakan,
            // 'categories' => Category::all()
        ]);
    }

    public function updateKontrakan(Request $request) //request = data baru, kost = data lama
    {
        $rules = [
            'nama' => 'required|max:255',
            // 'area' => 'required',
            // 'kelurahan' => 'required',
            // 'rt' => 'required|numeric',
            // 'rw' => 'required|numeric',
            // 'no' => 'required|alpha_num',
            // 'gender' => 'required',
            'harga' => 'required|numeric|integer',
            'fasilitas' => 'required',
            'jumKam' => 'required|numeric|integer',
            // 'jumKos' => 'required|numeric|integer',
            'durSewa' => 'required|min:1|max:12|integer|numeric',
            'listrik' => 'required',
            'deskripsi' => 'required',
            'noHp' => 'required|numeric',

            // 'title' => 'required|max:255',
            // 'slug' => 'required|unique:posts',
            // 'category_id' => 'required',
            'image' => 'image|file|max:3072', //harus image dan 
            // 'title' => 'required|max:255',
            // 'slug' => 'required|unique:posts',
            // 'category_id' => 'required',
            // 'image' => 'image|file|max:1024', //harus image dan maksimal 1024Kb
            // 'body' => 'required'
            'latitude' => 'required',
            'longitude' => 'required',
            'status' => 'required',
            'jarak' => 'required',
            'parkir' => 'required',
            'wifi' => 'required',
            'ringkasan' => 'required',
            // 'statusPengajuan' => 'required',
        ];



        // if ($request->slug != $post->slug) {
        //     $rules['slug'] = 'required|unique:posts';
        // }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) { //Jika gambar ada isinya (true), tambah 1 validate data, upload sekaligus ambil
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['statusPengajuan'] = 1;
        // $validatedData['ringkasan'] = Str::limit(strip_tags($request->deskripsi), 20, '...');

        Kontrakan::where('id', request('kontrakan_id'))
            ->update($validatedData);

        return redirect('/dashboard/penambahan')->with('success', 'Data Pembaharuan Kontrakan Berhasil Disetujui!');
    }

    public function editKost(Kost $kost)
    {

        return view('dashboard.penambahan.editKost', [
            'title' => 'Kost',
            'kost' => $kost,
            // 'categories' => Category::all()
        ]);
    }

    public function updateKost(Request $request) //request = data baru, kost = data lama
    {
        $rules = [
            'nama' => 'required|max:255',
            'area' => 'required',

            'jarak' => 'required',
            'parkir' => 'required',
            'wifi' => 'required',

            // 'kelurahan' => 'required',
            // 'rt' => 'required|numeric',
            // 'rw' => 'required|numeric',
            // 'no' => 'required|alpha_num',
            'gender' => 'required',
            // 'harga' => 'required|numeric|integer',
            'fasilitas' => 'required',
            // 'jumKam' => 'required|numeric|integer',
            // 'jumKos' => 'required|numeric|integer',
            // 'durSewa' => 'required|min:1|max:12|integer|numeric',
            // 'listrik' => 'required',
            'deskripsi' => 'required',
            'noHp' => 'required|numeric',

            // 'title' => 'required|max:255',
            // 'slug' => 'required|unique:posts',
            // 'category_id' => 'required',
            'image' => 'image|file|max:3072',
            'latitude' => 'required',
            'longitude' => 'required',
            'ringkasan' => 'required',
            // 'status' => 'required',
        ];



        // if ($request->slug != $post->slug) {
        //     $rules['slug'] = 'required|unique:posts';
        // }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) { //Jika gambar ada isinya (true), tambah 1 validate data, upload sekaligus ambil
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['statusPengajuan'] = 1;
        // $validatedData['ringkasan'] = Str::limit(strip_tags($request->deskripsi), 20, '...');

        Kost::where('id', request('kost_id'))
            ->update($validatedData);

        return redirect('/dashboard/penambahan')->with('success', 'Data Pembaharuan Kost Berhasil Disetujui!');
    }


    public function editKamar(Kamar $kamar)
    {

        $kost = DB::table('kosts')->where('id',  $kamar->kost_id)->first();


        return view('dashboard.penambahan.editKamar', [
            'title' => 'Kamar',
            'kamar' => $kamar,
            'kost' => $kost,
            // 'categories' => Category::all()
        ]);
    }


    public function updateKamar(Request $request) //request = data baru, kost = data lama
    {

        // $kamar =  ambil kamarnya

        $rules = [
            'harga' => 'required|numeric|integer',
            'ukuran' => 'required',
            'kamarMandi' => 'required',
            'fasilitasKamar' => 'required',
            'jumKam' => 'required|numeric|integer',
            'jumKos' => 'required|numeric|integer',
            'durSewa' => 'required|min:1|max:12|integer|numeric',
            // 'listrik' => 'required',
            'deskripsiKamar' => 'required',
            // 'noHp' => 'required|numeric',

            // 'title' => 'required|max:255',
            // 'slug' => 'required|unique:posts',
            // 'category_id' => 'required',
            'imageKamar' => 'image|file', //
            // 'kamar_id' => '',
        ];



        // if ($request->slug != $post->slug) {
        //     $rules['slug'] = 'required|unique:posts';
        // }

        $validatedData = $request->validate($rules);

        if ($request->file('imageKamar')) { //Jika gambar ada isinya (true), tambah 1 validate data, upload sekaligus ambil
            if ($request->oldImage) {
                // hapus foto kamar sebelum
                Storage::delete($request->oldImage);
            }
            $validatedData['imageKamar'] = $request->file('imageKamar')->store('post-images');
            //  simpan foto baru
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['statusPengajuanKamar'] = 1;
        $validatedData['ringkasanKamar'] = Str::limit(strip_tags($request->deskripsi), 20, '...');

        Kamar::where('id', request('kamar_id'))
            ->update($validatedData);

        return redirect('/dashboard/penambahan')->with('success', 'Data Pembaharuan Kamar Berhasil Disetujui!');
    }
}
