<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kontrakan;
use App\Models\Edit_Kontrakan;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardKontrakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('dashboard.kontrakans.index', [
            'kontrakans' => Kontrakan::latest()->filteradmin(request(['search', 'kelurahan', 'rt', 'rw', 'no']))->paginate(10)->withQueryString(),
            'kelurahan' => request('kelurahan'),
            'rt' => request('rt'),
            'rw' => request('rw'),
            'no' => request('no')
        ]);
    }

    public function indexooo()
    {
        if (auth()->user()->is_admin === 2) {
            return view('dashboard.kontrakans.index', [
                'kontrakans' => Kontrakan::latest()->filter(request(['search']))->paginate(10)->withQueryString()
            ]);
        } else {
            //tidak ada fitur pencarian, perlu atau ngga ?
            return view('dashboard.kontrakans.index', [
                'kontrakans' => Kontrakan::where('user_id', auth()->user()->id)->get()
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
        return view('dashboard.kontrakans.create', [
            // 'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            'statusPengajuan' => '',
            'statusUpdate' => '',
            'ringkasan' => 'required',
        ]);

        if ($request->file('image')) { //Jika gambar ada isinya (true), tambah 1 validate data, upload sekaligus ambil
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        // $validatedData['ringkasan'] = Str::limit(strip_tags($request->deskripsi), 20, '...');

        Kontrakan::create($validatedData);

        return redirect('/dashboard/kontrakans')->with('success', 'Data Kontrakan berhasil ditambahkan!');
    }


    public function storeOld(Request $request)
    {
        // return $request->file('image')->store('post-images');

        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'area' => 'required',
            'kelurahan' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'no' => 'required|alpha_num',
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
        ]);

        if ($request->file('image')) { //Jika gambar ada isinya (true), tambah 1 validate data, upload sekaligus ambil
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['ringkasan'] = Str::limit(strip_tags($request->deskripsi), 20, '...');

        Kontrakan::create($validatedData);

        return redirect('/dashboard/kontrakans')->with('success', 'Data Kontrakan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Kontrakan $kontrakan)
    {
        // if (auth()->user()->is_admin !== 2) {
        //     if ($kontrakan->users->id !== auth()->user()->id) {
        //         abort(403);
        //     }
        // }


        return view('dashboard.kontrakans.show', [
            'kontrakan' => $kontrakan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Kontrakan $kontrakan)
    {

        // if (auth()->user()->is_admin !== 2) {
        //     if ($kontrakan->users->id !== auth()->user()->id) {
        //         abort(403);
        //     }
        // }

        return view('dashboard.kontrakans.edit', [
            'kontrakan' => $kontrakan,
            // 'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kontrakan $kontrakan) //request = data baru, post = data lama
    {

        // dd($request);
        $rules = [
            'nama' => 'required|max:255',
            'area' => 'required',
            'kelurahan' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'no' => 'required|alpha_num',
            // 'gender' => 'required',
            'harga' => 'required|numeric|integer',
            'fasilitas' => 'required',
            'jumKam' => 'required|numeric|integer',
            // 'jumKos' => 'required|numeric|integer',
            'durSewa' => 'required|min:1|max:12|integer|numeric',
            'listrik' => 'required',
            'deskripsi' => 'required',
            'noHp' => 'required|numeric',
            'jarak' => 'required',
            'parkir' => 'required',
            'wifi' => 'required',

            // 'title' => 'required|max:255',
            // 'slug' => 'required|unique:posts',
            // 'category_id' => 'required',
            'image' => 'image|file',
            'latitude' => 'required',
            'longitude' => 'required',
            'status' => 'required',
            'ringkasan' => 'required',
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
        // $validatedData['ringkasan'] = Str::limit(strip_tags($request->deskripsi), 20, '...');

        Kontrakan::where('id', request('kontrakan_id'))
            ->update($validatedData);

        return redirect('/dashboard/kontrakans')->with('success', 'Data Pembaharuan Kontrakan Berhasil Diajukan!');
    }


    public function updateOld(Request $request, Kontrakan $kontrakan) //request = data baru, post = data lama
    {
        $rules = [
            'nama' => 'required|max:255',
            'area' => 'required',
            'kelurahan' => 'required',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'no' => 'required|alpha_num',
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
            'image' => 'image|file',
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

        Kontrakan::where('id', $kontrakan->id)
            ->update($validatedData);

        return redirect('/dashboard/kontrakans')->with('success', 'Data Kontrakan Berhasil diperbaharui!');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kontrakan $kontrakan)
    {
        if ($kontrakan->image) {
            Storage::delete($kontrakan->image);
        }

        Edit_Kontrakan::where('kontrakan_id', $kontrakan->id)->delete();
        Kontrakan::destroy($kontrakan->id);

        return redirect('/dashboard/kontrakans')->with('success', 'Data kontrakan berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
