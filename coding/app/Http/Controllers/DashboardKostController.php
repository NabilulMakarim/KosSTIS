<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kost;
use App\Models\Kamar;
use App\Models\Edit_Kost;
use App\Models\Edit_Kamar;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class DashboardKostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kosts.index', [
            'kosts' => Kost::latest()->filteradmin(request(['search', 'kelurahan', 'rt', 'rw', 'no']))->paginate(10)->withQueryString(),
            'kelurahan' => request('kelurahan'),
            'rt' => request('rt'),
            'rw' => request('rw'),
            'no' => request('no')
        ]);
    }


    // sdgfdgfchjd 
    public function indexooo()
    {

        //Jika Admin maka tampilkan semua data kost
        if (auth()->user()->is_admin === 2) {
            return view('dashboard.kosts.index', [
                'kosts' => Kost::latest()->filter(request(['search']))->paginate(10)->withQueryString()
            ]);
        } else {
            //Jika bukan admin, tampilkan hanya kost yang dia tambahkan
            return view('dashboard.kosts.index', [
                'kosts' => Kost::where('user_id', auth()->user()->id)->get()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kosts.create', [
            // 'categories' => Category::all()
        ]);
    }

    public function createKamar()
    {
        // $kost = Kost::where('id', request('kost_id'))->first();
        // ddd($kost);

        return view('dashboard.kosts.createKamar', [
            'kost' => Kost::where('id', request('kost_id'))->first(),
            'hargas' => Kamar::where('kost_id', request('kost_id'))->get()
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

        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'area' => 'required',
            'kelurahan' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'no' => 'required|alpha_num',
            'gender' => 'required',
            // 'harga' => 'required|numeric|integer',
            'fasilitas' => 'required',

            'jarak' => 'required',
            'parkir' => 'required',
            'wifi' => 'required',
            // 'jumKam' => 'required|numeric|integer',
            // 'jumKos' => 'required|numeric|integer',
            // 'durSewa' => 'required|min:1|max:12|integer|numeric',
            // 'listrik' => 'required',
            'deskripsi' => 'required',
            'noHp' => 'required|numeric',

            // 'title' => 'required|max:255',
            // 'slug' => 'required|unique:posts',
            // 'category_id' => 'required',
            'image' => 'image|file|max:3072', //harus image dan maksimal 3072kb atau 3mb
            // 'title' => 'required|max:255',
            // 'slug' => 'required|unique:posts',
            // 'category_id' => 'required',
            // 'image' => 'image|file|max:1024', //harus image dan maksimal 1024Kb
            // 'body' => 'required'
            'latitude' => 'required',
            'longitude' => 'required',
            // 'status' => 'required',
            'statusPengajuan' => 'required',
            'statusUpdate' => 'required',
            'ringkasan' => 'required',
        ]);

        if ($request->file('image')) { //Jika gambar ada isinya (true), tambah 1 validate data, upload sekaligus ambil
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        // $validatedData['ringkasan'] = Str::limit(strip_tags($request->deskripsi), 20, '...');

        Kost::create($validatedData);

        return redirect('/dashboard/kosts')->with('success', 'Data Kost berhasil ditambahkan!');
    }

    public function storeKamar(Request $request)
    {
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
            'imageKamar' => 'image|file|max:3072', //harus image dan 
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
            'kost_id' => '',
        ]);

        if ($request->file('imageKamar')) { //Jika gambar ada isinya (true), tambah 1 validate data, upload sekaligus ambil
            $validatedData['imageKamar'] = $request->file('imageKamar')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        // $validatedData['kost_id'] = $kost->id;
        $validatedData['ringkasanKamar'] = Str::limit(strip_tags($request->deskripsiKamar), 20, '...');

        Kamar::create($validatedData);

        return redirect('/dashboard/kosts')->with('success', 'Data Kamar berhasil ditambahkan!');
    }

    public function storeOld(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'area' => 'required',
            'kelurahan' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'no' => 'required|alpha_num',
            'gender' => 'required',
            'harga' => 'required|numeric|integer',
            'fasilitas' => 'required',
            'jumKam' => 'required|numeric|integer',
            'jumKos' => 'required|numeric|integer',
            'noHp' => 'required|numeric',
            'deskripsi' => 'required',
            'durSewa' => 'required|min:1|max:12|integer|numeric',
            'image' => 'image|file', //harus image dan maksimal 1024Kb
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        // dd($validatedData);


        if ($request->file('image')) { //Jika gambar ada isinya (true), tambah 1 validate data, upload sekaligus ambil
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        //inputan untuk variabel user_id
        $validatedData['user_id'] = auth()->user()->id;
        //inputan untuk variabel ringkasan (100 string pertama lalu ...)
        $validatedData['ringkasan'] = Str::limit(strip_tags($request->deskripsi), 20, '...');

        // dd($validatedData);

        Kost::create($validatedData);

        return redirect('/dashboard/kosts')->with('success', 'Data Kost Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Kost $kost)
    {
        // ini apa bila pakai pembatasan 
        // if (auth()->user()->is_admin !== 2) {
        //     if ($kost->users->id !== auth()->user()->id) {
        //         abort(403);
        //     }
        // }


        return view('dashboard.kosts.show', [
            'kost' => $kost
        ]);
    }

    public function showKamar(Kost $kost)
    {
        return view('dashboard.kosts.daftarKamar', [
            'kamars' => Kamar::where('kost_id', $kost->id)->latest()->paginate(10)->withQueryString(),
            'kost' => $kost
        ]);
    }

    public function detailKamar(Kamar $kamar)
    {
        $kost = Kost::where('id', '=', $kamar->kost_id)->first();
        // dd($kost[0]->nama);

        return view('dashboard.kosts.showKamar', [
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
    public function edit(Kost $kost)
    {

        // ini apa bila pakai pembatasan 
        // if (auth()->user()->is_admin !== 2) {
        //     if ($kost->users->id !== auth()->user()->id) {
        //         abort(403);
        //     }
        // }

        return view('dashboard.kosts.edit', [
            'kost' => $kost,
            // 'categories' => Category::all()
        ]);
    }

    public function editKamar(Kamar $kamar)
    {
        $kost = Kost::where('id', '=', $kamar->kost_id)->first();

        return view('dashboard.kosts.editKamar', [
            'kamar' => $kamar,
            'kost' => $kost,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kost $kost) //request = data baru, kost = data lama
    {
        $rules = [
            'nama' => 'required|max:255',
            'area' => 'required',

            'jarak' => 'required',
            'parkir' => 'required',
            'wifi' => 'required',

            'kelurahan' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'no' => 'required|alpha_num',
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
            // 'kost_id' => '',
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
        // $validatedData['ringkasan'] = Str::limit(strip_tags($request->deskripsi), 20, '...');

        Kost::where('id', request('kost_id'))
            ->update($validatedData);

        return redirect('/dashboard/kosts')->with('success', 'Data Pembaharuan Kost Berhasil Diajukan!');
    }


    public function updateOld(Request $request, Kost $kost) //request = data baru, post = data lama
    {
        $rules = [
            'nama' => 'required|max:255',
            'area' => 'required',
            'kelurahan' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'no' => 'required|alpha_num',
            'gender' => 'required',
            'harga' => 'required|numeric|integer',
            'fasilitas' => 'required',
            'jumKam' => 'required|numeric|integer',
            'jumKos' => 'required|numeric|integer',
            'noHp' => 'required|numeric',
            'deskripsi' => 'required',
            'durSewa' => 'required|min:1|max:12|integer|numeric',
            'image' => 'image|file', //harus image dan maksimal 1024Kb
            'latitude' => '',
            'longitude' => ''
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
        $validatedData['ringkasan'] = Str::limit(strip_tags($request->deskripsi), 20, '...');

        Kost::where('id', $kost->id)
            ->update($validatedData);

        return redirect('/dashboard/kosts')->with('success', 'Data Kost Berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kost $kost)
    {
        // $id = $kost->id;
        // ddd($id);
        //Jika gambarnya juga ditambahkan, maka hapus dahulu gambar di Storage
        if ($kost->image) {
            Storage::delete($kost->image);
        }

        //Hapus data kost terpilih beserta kamar di dalamnya
        Edit_Kost::where('kost_id', $kost->id)->delete();
        $deleted = DB::table('kamars')->where('kost_id', '=', $kost->id)->delete();
        Kost::destroy($kost->id);

        //Kembali ke dashboard/kosts dengan membawa pesan berkode success
        return redirect('/dashboard/kosts')->with('success', 'Data kost berhasil dihapus!');
    }

    public function destroyKamar(Kamar $kamar)
    {
        //Jika gambarnya juga ditambahkan, maka hapus dahulu gambar di Storage
        if ($kamar->imageKamar) {
            Storage::delete($kamar->imageKamar);
        }

        //Hapus data kamar terpilih
        Edit_Kamar::where('kamar_id', $kamar->id)->delete();
        Kamar::destroy($kamar->id);

        //Kembali ke dashboard/kamars dengan membawa pesan berkode success
        return redirect('/dashboard/kosts')->with('success', 'Data kamar berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
