<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Kamar;
use \App\Models\Edit_Kamar;
use \App\Models\Kost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class KamarController extends Controller
{


    public function tambahUpdate(Request $request)
    {
        // $kost_id = $kost->id; 
        // $kostNama = request('nama_kost');
        if (request('harga')) {
            $rules = [
                'harga' => 'required|integer|min:400000|max:2000000',
            ];

            $validatedData = $request->validate($rules);
        }

        return view('tambahUpdateKamar', [
            'title' => 'Tambah atau Update Data Kamar',
            // 'active' => 'kontrakans',
            // 'kost' => $kost,
            'kamars' => Kamar::latest()->filter(request(['kost_id', 'harga']))->paginate(5)->withQueryString(),
            //filter itu menuju Model Kontrakan function scopeFilter
            'kost_id' => request('kost_id'),
            'harga' => request('harga'),
            'namaKost' => request('nama_kost')
        ]);
    }

    public function tambah(Kamar $kamar)
    {
        return view('tambahKamar', [
            "title" => "Kamar",
            // "active" => 'posts',
            // "kontrakan" => $kontrakan,
            'kost_id' => request('kost_id'),
            'harga' => request('harga'),
        ]);
    }

    public function store(Request $request)
    {
        // return $request->file('image')->store('post-images');
        // dd($request);

        $validatedData = $request->validate([
            // 'nama' => 'required|max:255',
            // 'area' => 'required',
            // 'kelurahan' => 'required',
            // 'rt' => 'required|numeric',
            // 'rw' => 'required|numeric',
            // 'no' => 'required|alpha_num',
            // 'gender' => 'required',
            'harga' => 'required|numeric|integer|min:400000|max:2000000',
            'ukuran' => 'required',
            'kamarMandi' => 'required',
            'fasilitasKamar' => 'required',
            'jumKam' => 'required|numeric|integer',
            'jumKos' => 'required|numeric|integer|lte:jumKam',
            'durSewa' => 'required|min:1|max:12|integer|numeric',
            // 'listrik' => 'required',
            'deskripsiKamar' => 'required',
            // 'noHp' => 'required|numeric',

            // 'title' => 'required|max:255',
            // 'slug' => 'required|unique:posts',
            // 'category_id' => 'required',
            'imageKamar' => 'image|file', //harus image dan 
            // 'title' => 'required|max:255',
            // 'slug' => 'required|unique:posts',
            // 'category_id' => 'required',
            // 'image' => 'image|file|max:1024', //harus image dan maksimal 1024Kb
            // 'body' => 'required'
            // 'latitude' => 'required',
            // 'longitude' => 'required',
            // 'status' => 'required',
            'statusPengajuanKamar' => 'required',
            'kost_id' => '',
        ]);

        if ($request->file('imageKamar')) { //Jika gambar ada isinya (true), tambah 1 validate data, upload sekaligus ambil
            $validatedData['imageKamar'] = $request->file('imageKamar')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['ringkasanKamar'] = Str::limit(strip_tags($request->deskripsiKamar), 20, '...');

        Kamar::create($validatedData);

        return redirect('/kosts/tambahUpdateKost')->with('success', 'Data Kamar berhasil diajukan!');
    }

    public function edit(Kamar $kamar)
    {
        return view('updateKamar', [
            'title' => 'Kamar',
            'kamar' => $kamar,
            // 'categories' => Category::all()
        ]);
    }

    public function update(Request $request) //request = data baru, post = data lama
    {

        // dd($request);
        $rules = [
            'harga' => 'required|numeric|integer',
            'ukuran' => 'required',
            'kamarMandi' => 'required',
            'fasilitasKamar' => 'required',
            'jumKam' => 'required|numeric|integer',
            'jumKos' => 'required|numeric|integer|lte:jumKam',
            'durSewa' => 'required|min:1|max:12|integer|numeric',
            // 'listrik' => 'required',
            'deskripsiKamar' => 'required',
            // 'noHp' => 'required|numeric',

            // 'title' => 'required|max:255',
            // 'slug' => 'required|unique:posts',
            // 'category_id' => 'required',
            'imageKamar' => 'image|file', //
            'kamar_id' => '',
        ];



        // if ($request->slug != $post->slug) {
        //     $rules['slug'] = 'required|unique:posts';
        // }

        $validatedData = $request->validate($rules);

        if ($request->file('imageKamar')) { //Jika gambar ada isinya (true), tambah 1 validate data, upload sekaligus ambil
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['imageKamar'] = $request->file('imageKamar')->store('post-images');
        }
        // $validatedData['kontrakan_id'] = $kontrakan->id;
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['ringkasanKamar'] = Str::limit(strip_tags($request->deskripsiKamar), 20, '...');

        Edit_Kamar::create($validatedData);



        // BELUM BISA UPDATE statusUpdate NYA
        // $rules2 = [
        //     'statusUpdate' => '',
        // ];

        // $validatedData2 = $request->validate($rules2);

        Kamar::where('id', $validatedData['kamar_id'])
            ->update(['statusUpdateKamar' => 0]);

        return redirect('/kosts/tambahUpdateKost')->with('success', 'Data Pembaharuan Kamar Berhasil Diajukan!');
    }

    // public function tes()
    // {
    //     return view('tes', [
    //         'title' => 'Kamar',
    //         // 'kamar' => $kamar,
    //     ]);
    // }
}
