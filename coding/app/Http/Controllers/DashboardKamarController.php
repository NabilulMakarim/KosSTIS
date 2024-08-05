<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kost;
use App\Models\Kamar;
use App\Models\Edit_Kamar;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;

class DashboardKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kamarKosts = DB::table('kosts')
            ->join('kamars', function (JoinClause $join) {
                $join->on('kosts.id', '=', 'kamars.kost_id')
                    ->where('kosts.nama', 'like', '%' . request('search') . '%')
                    ->where('kosts.rt', 'like', '%' . request('rt') . '%')
                    ->where('kosts.rw', 'like', '%' . request('rw') . '%')
                    ->where('kosts.no', 'like', '%' . request('no') . '%')
                    ->where('kosts.kelurahan', 'like', '%' . request('kelurahan') . '%');
            })
            ->select('kosts.*', 'kamars.*')
            ->orderBy('nama', 'asc')
            ->orderBy('harga', 'asc')
            ->paginate(10);


        return view('dashboard.kamars.index', [
            // 'kosts' => Kost::latest()->filter(request(['search', 'kelurahan', 'rt', 'rw', 'no']))->paginate(10)->withQueryString(),
            'kelurahan' => request('kelurahan'),
            'rt' => request('rt'),
            'rw' => request('rw'),
            'no' => request('no'),
            "kosts" => $kamarKosts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kamars.create', [
            // 'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Untuk menyimpan
    public function store(Request $request)
    {
        // return $request->file('image')->store('post-images');
        // dd($request);

        $kost = Kost::filter(request(['kelurahan', 'rt', 'rw', 'no']))->first();
        // dd($kost->attribute->id);
        // dd($kost[0]->id);

        if ($kost) {


            $validatedData = $request->validate([
                // 'nama' => 'required|max:255',
                // 'area' => 'required',
                // 'kelurahan' => 'required',
                // 'rt' => 'required|numeric',
                // 'rw' => 'required|numeric',
                // 'no' => 'required|alpha_num',
                // 'gender' => 'required',
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
                'imageKamar' => 'image|file', //harus image dan 
                // 'title' => 'required|max:255',
                // 'slug' => 'required|unique:posts',
                // 'category_id' => 'required',
                // 'image' => 'image|file|max:1024', //harus image dan maksimal 1024Kb
                // 'body' => 'required'
                // 'latitude' => 'required',
                // 'longitude' => 'required',
                // 'status' => 'required',
                'statusPengajuanKamar' => '',
                'statusUpdateKamar' => '',
                // 'kost_id' => '',
            ]);

            if ($request->file('imageKamar')) { //Jika gambar ada isinya (true), tambah 1 validate data, upload sekaligus ambil
                $validatedData['imageKamar'] = $request->file('imageKamar')->store('post-images');
            }

            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['kost_id'] = $kost->id;
            $validatedData['ringkasanKamar'] = Str::limit(strip_tags($request->deskripsiKamar), 20, '...');

            Kamar::create($validatedData);

            return redirect('/dashboard/kamars')->with('success', 'Data Kamar berhasil ditambahkan!');
        } else {
            return redirect('/dashboard/kamars')->with('danger', 'Kost untuk kamar dengan alamat yang dimasukkan belum terdaftar!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Kamar $kamar)
    {
        // ini apa bila pakai pembatasan 
        // if (auth()->user()->is_admin !== 2) {
        //     if ($kost->users->id !== auth()->user()->id) {
        //         abort(403);
        //     }
        // }
        $kost = Kost::where('id', '=', $kamar->kost_id)->first();
        // dd($kost[0]->nama);

        return view('dashboard.kamars.show', [
            'kamar' => $kamar,
            'kost' => $kost
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Kamar $kamar)
    {

        // ini apa bila pakai pembatasan 
        // if (auth()->user()->is_admin !== 2) {
        //     if ($kamar->users->id !== auth()->user()->id) {
        //         abort(403);
        //     }
        // }
        $kost = Kost::where('id', '=', $kamar->kost_id)->first();
        // ddd($kost);
        // if ($kost) {
        //     $kost = $kost;
        // } else {
        //     $kost->nama = '';
        // }

        return view('dashboard.kamars.edit', [
            'kamar' => $kamar,
            'kost' => $kost,
            // 'categories' => Category::all()
        ]);
    }


    // UPDATE UNTUK KAMAR YANG ADA DI HALAMAN DASHBOARD KOST 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) //request = data baru, post = data lama
    {

        // dd($request);
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
            'imageKamar' => 'image|file|max:3072', //
            // 'kamar_id' => '',
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
        // $validatedData['kontrakan_id'] = $kontrakan->id;
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['ringkasanKamar'] = Str::limit(strip_tags($request->deskripsiKamar), 20, '...');

        Kamar::where('id', $request['kamar_id'])
            ->update($validatedData);

        return redirect('/dashboard/kosts')->with('success', 'Pembaharuan Data Kamar Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kamar $kamar)
    {
        //Jika gambarnya juga ditambahkan, maka hapus dahulu gambar di Storage
        if ($kamar->imageKamar) {
            Storage::delete($kamar->imageKamar);
        }

        //Hapus data kamar terpilih
        Edit_Kamar::where('kamar_id', $kamar->id)->delete();
        Kamar::destroy($kamar->id);

        //Kembali ke dashboard/kamars dengan membawa pesan berkode success
        return redirect('/dashboard/kamars')->with('success', 'Data kamar berhasil dihapus!');
    }
}
