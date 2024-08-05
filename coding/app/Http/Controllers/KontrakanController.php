<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Post;
use \App\Models\Category;
use \App\Models\User;
use \App\Models\Kontrakan;
use \App\Models\Konfirmasikontrakan;
use \App\Models\Edit_Kontrakan;
use \App\Models\Review;
use \App\Models\Rating;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;




class KontrakanController extends Controller
{

    public function hubungiPemilik()
    {
        // $time = date('d / m / y');
        // ddd($time);
        // WHERE 14 = DATEDIFF(activation_date, $today) 

        // $timestamp = time();
        // for ($i = 0; $i <= 9; $i++) {
        //     $dulu = date('y m d', $timestamp);
        //     $timestamp -= 24 * 3600;
        // }

        // $now = date('y m d');

        // ddd(strtotime($now) - strtotime($dulu));

        // if (strtotime($now) - strtotime($dulu) > 30) {
        //     ddd($now);
        // } else {
        //     ddd($dulu);
        // }

        // strtotime($dulu);
        // ddd($dulu('m'));

        $kontrakan_id = request('kontrakan_id');
        $nama = request('nama');
        $kelurahan = request('kelurahan');
        $rt = request('rt');
        $rw = request('rw');
        $no = request('no');
        $noHp = request('noHp');

        $cek = Konfirmasikontrakan::where('kontrakan_id', '=', $kontrakan_id)
            ->where('user_id', '=', auth()->user()->id)->first();

        // ddd($cek->id);

        if (!$cek) {
            // ddd($cek);
            Konfirmasikontrakan::create([
                'user_id' => auth()->user()->id,
                'kontrakan_id' => $kontrakan_id
            ]);
        } else {
            Konfirmasikontrakan::where('id', $cek->id)
                ->update([]);
        }

        return view('hubungiKontrakan', [
            "title" => "Hubungi Pemilik Kontrakan ",
            "active" => 'kontrakans',
            "nama" => $nama,
            "kelurahan" => $kelurahan,
            "rt" => $rt,
            "rw" => $rw,
            "no" => $no,
            "noHp" => $noHp,
        ]);
    }

    public function index()
    {

        //filter itu menuju Model Post function scopeFilter
        $kontrakans = Kontrakan::oldest(request('urut'))->filter(request(['search', 'area', 'hargaMin', 'hargaMaks', 'wifi', 'parkir', 'listrik', 'jarak', 'ringkasan', 'statusPengajuan']))->paginate(15)->withQueryString();
        // oldest itu ascending, letest itu descending 
        $ratings = Rating::latest()->get();

        return view('kontrakans', [
            "title" => "All Kontrakan ",
            "kontrakans" => $kontrakans,
            "ratings" => $ratings,
        ]);
    }

    public function show(Kontrakan $kontrakan)
    {
        $admin = User::where('is_admin', '=', 2)->first();
        $reviews = Review::latest()->where('kontrakan_id', '=', $kontrakan->id)->get();
        $ratings = Rating::latest()->where('kontrakan_id', '=', $kontrakan->id)->get();
        $rating = Rating::latest()->where('kontrakan_id', '=', $kontrakan->id)
            ->where('user_id', '=', auth()->user()->id)
            ->first();
        $rataan = 0;

        // dd($admin);

        // ddd($rating);

        return view('kontrakan', [
            "title" => "Kontrakan",
            // "active" => 'posts',
            "kontrakan" => $kontrakan,
            "reviews" => $reviews,
            "ratings" => $ratings,
            "rating" => $rating,
            "rataan" => $rataan,
            "admin" => $admin,
        ]);
    }

    public function tambahUpdate(Request $request)
    {
        $a = Kontrakan::latest()->filtertambahupdate(request(['kelurahan', 'rt', 'rw', 'no']))->paginate(5)->withQueryString();

        // ddd($a);
        //sebagai penanda apa dilakukan search atau tidak
        if (request('kelurahan')) {
            $rules = [
                'kelurahan' => 'required',
                'rt' => 'required|numeric|starts_with:1,2,3,4,5,6,7,8,9',
                'rw' => 'required|numeric|starts_with:1,2,3,4,5,6,7,8,9',
                'no' => 'required|alpha_num|starts_with:1,2,3,4,5,6,7,8,9',
            ];

            $validatedData = $request->validate($rules);
        }

        return view('tambahUpdateKontrakan', [
            'title' => 'Tambah atau Update Data Kontrakan',
            'active' => 'kontrakans',
            'kontrakans' => $a,
            //filter itu menuju Model Kontrakan function scopeFilter
            'kelurahan' => request('kelurahan'),
            'rt' => request('rt'),
            'rw' => request('rw'),
            'no' => request('no'),
        ]);
    }

    public function tambah(Kontrakan $kontrakan)
    {
        return view('tambahKontrakan', [
            "title" => "Kontrakan",
            // "active" => 'posts',
            // "kontrakan" => $kontrakan,
            'kelurahan' => request('kelurahan'),
            'rt' => request('rt'),
            'rw' => request('rw'),
            'no' => request('no'),
        ]);
    }

    public function store(Request $request)
    {
        // return $request->file('image')->store('post-images');
        // dd($request);
        $lat = request('latitude');
        $long = request('longitude');

        if ($long > 106.8634118130181 and $long < 106.87739093801957 and $lat < -6.225015471943578 and $lat > -6.245882569425817) {

            // Bonsay 
            if ($long > 106.8634118130181 and $long < 106.86734542344016 and $lat < -6.227987444620183 and $lat > -6.234647980424313) {
                $daerah = "Bonsay";
                // Bonasut 
            } elseif (($long > 106.86704118594412 and $long < 106.87509926488309 and $lat < -6.22462215003425 and $lat > -6.227987444620183) or ($long > 106.86734542344016 and $long < 106.8761822446653 and $lat < -6.227987444620183 and $lat > -6.2318280859662)) {
                $daerah = "Bonasut";
                // Bonasel 
            } elseif (($long > 106.86734542344016 and $long < 106.87745702019009 and $lat < -6.2318280859662 and $lat > -6.234663957330042) or ($long > 106.86907544662824 and $long < 106.87745702019009 and $lat < -6.234663957330042 and $lat > -6.23939773835545)) {
                $daerah = "Bonasel";
                // Lainnya 
            } else {
                $daerah = "Bobobo";
            }
            // ddd($daerah);
        }

        $kelurahan = request('kelurahan');

        if ($kelurahan == "Bidara Cina") {
            $validatedData = $request->validate([
                'nama' => 'required|max:255',
                // 'area' => 'required',
                'kelurahan' => 'required',
                'rt' => 'required|numeric',
                'rw' => 'required|numeric',
                'no' => 'required|alpha_num',
                // 'gender' => 'required',
                'harga' => 'required|numeric|integer|min:1000000|max:5000000',
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
                'latitude' => 'required|numeric|between:-6.2446249487769165,-6.225015471943578', //bawah, atas
                'longitude' => 'required|numeric|between:106.8634118130181,106.87054858600737', //kiri, kanan
                // 'status' => 'required',
                'status' => 'required',
                'jarak' => 'required|numeric',
                'parkir' => 'required',
                'wifi' => 'required',
                'statusPengajuan' => 'required',
                'ringkasan' => 'required',
            ]);
        } elseif ($kelurahan == "Cipinang Cempedak") {
            $validatedData = $request->validate([
                'nama' => 'required|max:255',
                // 'area' => 'required',
                'kelurahan' => 'required',
                'rt' => 'required|numeric',
                'rw' => 'required|numeric',
                'no' => 'required|alpha_num',
                // 'gender' => 'required',
                'harga' => 'required|numeric|integer|min:1000000|max:5000000',
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
                'latitude' => 'required|numeric|between:-6.245714971055918,-6.226228190110476',
                'longitude' => 'required|numeric|between:106.86921510641474,106.87722944563978',
                'status' => 'required',
                'jarak' => 'required|numeric',
                'parkir' => 'required',
                'wifi' => 'required',
                'statusPengajuan' => 'required',
                'ringkasan' => 'required',
            ]);
        } elseif ($kelurahan == "Balimester") {
            $validatedData = $request->validate([
                'nama' => 'required|max:255',
                // 'area' => 'required',
                'kelurahan' => 'required',
                'rt' => 'required|numeric',
                'rw' => 'required|numeric',
                'no' => 'required|alpha_num',
                // 'gender' => 'required',
                'harga' => 'required|numeric|integer|min:1000000|max:5000000',
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
                'latitude' => 'required|numeric|between:-6.227195007818267,-6.224258741126292',
                'longitude' => 'required|numeric|between:106.86613511119828,106.87474402655954',
                'status' => 'required',
                'jarak' => 'required|numeric',
                'parkir' => 'required',
                'wifi' => 'required',
                'statusPengajuan' => 'required',
                'ringkasan' => 'required',
            ]);
        } else {
            abort(403);
        }


        if ($request->file('image')) { //Jika gambar ada isinya (true), tambah 1 validate data, upload sekaligus ambil
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['area'] = $daerah;
        // $validatedData['ringkasan'] = Str::limit(strip_tags($request->deskripsi), 20, '...');

        Kontrakan::create($validatedData);

        return redirect('/kontrakans/tambahUpdateKontrakan')->with('success', 'Data Kontrakan berhasil diajukan!');
    }


    public function edit(Kontrakan $kontrakan)
    {
        return view('updateKontrakan', [
            'title' => 'Kontrakan',
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
        $lat = request('latitude');
        $long = request('longitude');

        if ($long > 106.8634118130181 and $long < 106.87739093801957 and $lat < -6.225015471943578 and $lat > -6.245882569425817) {

            // Bonsay 
            if ($long > 106.8634118130181 and $long < 106.86734542344016 and $lat < -6.227987444620183 and $lat > -6.234647980424313) {
                $daerah = "Bonsay";
                // Bonasut 
            } elseif (($long > 106.86704118594412 and $long < 106.87509926488309 and $lat < -6.22462215003425 and $lat > -6.227987444620183) or ($long > 106.86734542344016 and $long < 106.8761822446653 and $lat < -6.227987444620183 and $lat > -6.2318280859662)) {
                $daerah = "Bonasut";
                // Bonasel 
            } elseif (($long > 106.86734542344016 and $long < 106.87745702019009 and $lat < -6.2318280859662 and $lat > -6.234663957330042) or ($long > 106.86907544662824 and $long < 106.87745702019009 and $lat < -6.234663957330042 and $lat > -6.23939773835545)) {
                $daerah = "Bonasel";
                // Lainnya 
            } else {
                $daerah = "Bobobo";
            }
            // ddd($daerah);
        }

        $kelurahan = request('kelurahan');

        if ($kelurahan == "Bidara Cina") {
            $rules = [
                'nama' => 'required|max:255',
                // 'area' => 'required',
                // 'kelurahan' => 'required',
                // 'rt' => 'required|numeric',
                // 'rw' => 'required|numeric',
                // 'no' => 'required|alpha_num',
                // 'gender' => 'required',
                'harga' => 'required|numeric|integer|min:1000000|max:5000000',
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
                'image' => 'image|file|max:3072',
                'latitude' => 'required|numeric|between:-6.2446249487769165,-6.225015471943578', //bawah, atas
                'longitude' => 'required|numeric|between:106.8634118130181,106.87054858600737', //kiri, kanan
                'status' => 'required',
                'ringkasan' => 'required',
                'kontrakan_id' => '',
            ];
        } elseif ($kelurahan == "Cipinang Cempedak") {
            $rules = [
                'nama' => 'required|max:255',
                // 'area' => 'required',
                // 'kelurahan' => 'required',
                // 'rt' => 'required|numeric',
                // 'rw' => 'required|numeric',
                // 'no' => 'required|alpha_num',
                // 'gender' => 'required',
                'harga' => 'required|numeric|integer|min:1000000|max:5000000',
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
                'image' => 'image|file|max:3072',
                'latitude' => 'required|numeric|between:-6.245714971055918,-6.226228190110476',
                'longitude' => 'required|numeric|between:106.86921510641474,106.87722944563978',
                'status' => 'required',
                'ringkasan' => 'required',
                'kontrakan_id' => '',
            ];
        } elseif ($kelurahan == "Balimester") {
            $rules = [
                'nama' => 'required|max:255',
                // 'area' => 'required',
                // 'kelurahan' => 'required',
                // 'rt' => 'required|numeric',
                // 'rw' => 'required|numeric',
                // 'no' => 'required|alpha_num',
                // 'gender' => 'required',
                'harga' => 'required|numeric|integer|min:1000000|max:5000000',
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
                'image' => 'image|file|max:3072',
                'latitude' => 'required|numeric|between:-6.227195007818267,-6.224258741126292',
                'longitude' => 'required|numeric|between:106.86613511119828,106.87474402655954',
                'status' => 'required',
                'ringkasan' => 'required',
                'kontrakan_id' => '',
            ];
        } else {
            abort(403);
        }
        // dd($request);




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
        $validatedData['area'] = $daerah;

        // $validatedData['ringkasan'] = Str::limit(strip_tags($request->body), 20, '...');

        Edit_Kontrakan::create($validatedData);



        // BELUM BISA UPDATE statusUpdate NYA
        // $rules2 = [
        //     'statusUpdate' => '',
        // ];

        // $validatedData2 = $request->validate($rules2);

        Kontrakan::where('id', $validatedData['kontrakan_id'])
            ->update(['statusUpdate' => 0]);

        return redirect('/kontrakans/tambahUpdateKontrakan')->with('success', 'Data Pembaharuan Kontrakan Berhasil Diajukan!');
    }
}
