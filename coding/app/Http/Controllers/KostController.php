<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Category;
use \App\Models\User;
use \App\Models\Post;
use \App\Models\Kost;
use \App\Models\Konfirmasikost;
use \App\Models\Kamar;
use \App\Models\Edit_Kost;
use \App\Models\Review;
use \App\Models\Rating;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;

class KostController extends Controller
{

    public function hubungiPemilik()
    {
        $kamar_id = request('kamar_id');
        $nama = request('nama');
        $kelurahan = request('kelurahan');
        $rt = request('rt');
        $rw = request('rw');
        $no = request('no');
        $noHp = request('noHp');

        $cek = Konfirmasikost::where('kamar_id', '=', $kamar_id)
            ->where('user_id', '=', auth()->user()->id)->first();

        // ddd($cek);

        if (!$cek) {
            // ddd($cek);
            Konfirmasikost::create([
                'user_id' => auth()->user()->id,
                'kamar_id' => $kamar_id
            ]);
        } else {
            Konfirmasikost::where('id', $cek->id)
                ->update([]);
        }

        return view('hubungiKost', [
            "title" => "Hubungi Pemilik Kost ",
            "active" => 'kosts',
            "nama" => $nama,
            "kelurahan" => $kelurahan,
            "rt" => $rt,
            "rw" => $rw,
            "no" => $no,
            "noHp" => $noHp,
            // "admin" => $admin,
        ]);
    }

    public function index()
    {
        // ddd(request('parkir'));

        $kamarKosts = DB::table('kosts')
            ->join('kamars', function (JoinClause $join) {
                $join->on('kosts.id', '=', 'kamars.kost_id')
                    ->where('kamars.statusPengajuanKamar', '=', 1)
                    ->where('kosts.nama', 'like', '%' . request('search') . '%');
            })
            ->select('kosts.*', 'kamars.*')
            ->orderBy('kamars.harga', 'asc')
            ->paginate(15);


        if (request('wifi') == 'A') {
            if (request('area') and request('gender') and request('hargaMin') and request('hargaMaks') and request('jarak') and request('kamarMandi') and request('parkir')  and request('ringkasan') and request('wifi')) {
                $kamarKosts = DB::table('kosts')
                    ->join('kamars', function (JoinClause $join) {
                        $join->on('kosts.id', '=', 'kamars.kost_id')
                            ->where('kamars.statusPengajuanKamar', '=', 1)
                            ->where('area', 'like', '%' . request('area') . '%')
                            ->where('kosts.ringkasan', 'like', request('ringkasan') . '%')
                            ->where('gender', '=', request('gender'))
                            ->where('harga', '>=', request('hargaMin'))
                            ->where('harga', '<=', request('hargaMaks'))
                            ->where('jarak', '<=', request('jarak'))
                            ->where('kamarMandi', 'like', '%' . request('kamarMandi') . '%')
                            ->where('wifi', 'like', '%' . request('wifi') . '%')
                            ->where('parkir', 'like', request('parkir') . '%');
                    })
                    ->select('kosts.*', 'kamars.*')
                    ->orderBy(request('urut'), 'asc')
                    ->orderBy('harga', 'asc')
                    ->paginate(15);
            }
        } else {
            if (request('area') and request('gender') and request('hargaMin') and request('hargaMaks') and request('jarak') and request('kamarMandi') and request('parkir')  and request('ringkasan') and request('wifi')) {
                $kamarKosts = DB::table('kosts')
                    ->join('kamars', function (JoinClause $join) {
                        $join->on('kosts.id', '=', 'kamars.kost_id')
                            ->where('kamars.statusPengajuanKamar', '=', 1)
                            ->where('area', 'like', '%' . request('area') . '%')
                            // ->where('kosts.ringkasan', 'like', request('ringkasan') . '%')
                            ->where('kosts.ringkasan', 'like', request('ringkasan') . '%')
                            ->where('gender', '=', request('gender'))
                            ->where('harga', '>=', request('hargaMin'))
                            ->where('harga', '<=', request('hargaMaks'))
                            ->where('jarak', '<=', request('jarak'))
                            ->where('kamarMandi', 'like', '%' . request('kamarMandi') . '%')
                            ->where('wifi', 'like', request('wifi') . '%')
                            ->where('parkir', 'like', request('parkir') . '%');
                    })
                    ->select('kosts.*', 'kamars.*')
                    ->orderBy(request('urut'), 'asc')
                    ->orderBy('harga', 'asc')
                    ->paginate(15);
            }
        }


        $ratings = Rating::latest()->get();

        return view('kosts', [
            "title" => "All Kosts ",
            "active" => 'kosts',
            "kamarKosts" => $kamarKosts,
            "ratings" => $ratings,
        ]);
    }

    public function show()
    {

        $admin = User::where('is_admin', '=', 2)->first();

        $idKamar = request('idKamar');

        $kamar = Kamar::where('id', $idKamar)->first();

        $kost = Kost::where('id', $kamar->kost_id)->first();

        $reviewKosts = Review::latest()->where('kost_id', '=', $kost->id)->get();

        $reviewKamars = Review::latest()->where('kamar_id', '=', $kamar->id)->get();

        $ratings = Rating::latest()->where('kamar_id', '=', $kamar->id)->get();

        $rataan = 0;

        $rating = Rating::latest()->where('kamar_id', '=', $kamar->id)
            ->where('user_id', '=', auth()->user()->id)
            ->first();


        return view('kost', [
            "title" => "Kost",
            "kost" => $kost,
            "kamar" => $kamar,
            "reviewKosts" => $reviewKosts,
            "reviewKamars" => $reviewKamars,
            "ratings" => $ratings,
            "rating" => $rating,
            "rataan" => $rataan,
            "admin" => $admin,
        ]);
    }

    public function tambahUpdate(Request $request)
    {

        if (request('kelurahan')) {
            $rules = [
                'kelurahan' => 'required',
                'rt' => 'required|numeric|starts_with:1,2,3,4,5,6,7,8,9',
                'rw' => 'required|numeric|starts_with:1,2,3,4,5,6,7,8,9',
                'no' => 'required|alpha_num|starts_with:1,2,3,4,5,6,7,8,9',
            ];

            $validatedData = $request->validate($rules);
        }

        return view('tambahUpdateKost', [
            'title' => 'Tambah atau Update Data Kost',
            'active' => 'kosts',
            "kosts" => Kost::latest()->filter(request(['kelurahan', 'rt', 'rw', 'no']))->paginate(5)->withQueryString(),
            //filter itu menuju Model Post function scopeFilter
            'kelurahan' => request('kelurahan'),
            'rt' => request('rt'),
            'rw' => request('rw'),
            'no' => request('no'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function editOld(Kost $kost)
    {

        if (auth()->user()->is_admin !== 2) {
            if ($kost->users->id !== auth()->user()->id) {
                abort(403);
            }
        }

        return view('dashboard.kosts.edit', [
            'kost' => $kost,
            // 'categories' => Category::all()
        ]);
    }

    public function edit(Kost $kost)
    {

        return view('updateKost', [
            'title' => 'Kost',
            'kost' => $kost,
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
    public function update(Request $request, Kost $kost) //request = data baru, kost = data lama
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
                'latitude' => 'required|numeric|between:-6.2446249487769165,-6.225015471943578', //bawah, atas
                'longitude' => 'required|numeric|between:106.8634118130181,106.87054858600737', //kiri, kanan
                // 'status' => 'required',
                'ringkasan' => 'required',
                // 'status' => 'required',
                'kost_id' => '',
            ];
        } elseif ($kelurahan == "Cipinang Cempedak") {
            $rules = [
                'nama' => 'required|max:255',
                // 'area' => 'required',

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
                'latitude' => 'required|numeric|between:-6.245714971055918,-6.226228190110476',
                'longitude' => 'required|numeric|between:106.86921510641474,106.87722944563978',
                'ringkasan' => 'required',
                // 'status' => 'required',
                'kost_id' => '',
            ];
        } elseif ($kelurahan == "Balimester") {
            $rules = [
                'nama' => 'required|max:255',
                // 'area' => 'required',

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
                'latitude' => 'required|numeric|between:-6.227195007818267,-6.224258741126292',
                'longitude' => 'required|numeric|between:106.86613511119828,106.87474402655954',
                'ringkasan' => 'required',
                // 'status' => 'required',
                'kost_id' => '',
            ];
        } else {
            abort(403);
        }




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
        $validatedData['area'] = $daerah;
        // $validatedData['ringkasan'] = Str::limit(strip_tags($request->deskripsi), 20, '...');

        Edit_Kost::create($validatedData);

        Kost::where('id', $validatedData['kost_id'])
            ->update(['statusUpdate' => 0]);

        return redirect('/kosts/tambahUpdateKost')->with('success', 'Data Pembaharuan Kost Berhasil Diajukan!');
    }

    public function tambah(Kost $kost)
    {
        return view('tambahKost', [
            "title" => "Kost",
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
                'image' => 'image|file|max:3072', //harus image dan 
                // 'title' => 'required|max:255',
                // 'slug' => 'required|unique:posts',
                // 'category_id' => 'required',
                // 'image' => 'image|file|max:1024', //harus image dan maksimal 1024Kb
                // 'body' => 'required'
                'latitude' => 'required|numeric|between:-6.2446249487769165,-6.225015471943578', //bawah, atas
                'longitude' => 'required|numeric|between:106.8634118130181,106.87054858600737', //kiri, kanan
                // 'status' => 'required',
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
                'image' => 'image|file|max:3072', //harus image dan 
                // 'title' => 'required|max:255',
                // 'slug' => 'required|unique:posts',
                // 'category_id' => 'required',
                // 'image' => 'image|file|max:1024', //harus image dan maksimal 1024Kb
                // 'body' => 'required'
                'latitude' => 'required|numeric|between:-6.245714971055918,-6.226228190110476',
                'longitude' => 'required|numeric|between:106.86921510641474,106.87722944563978',
                // 'status' => 'required',
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
                'image' => 'image|file|max:3072', //harus image dan 
                // 'title' => 'required|max:255',
                // 'slug' => 'required|unique:posts',
                // 'category_id' => 'required',
                // 'image' => 'image|file|max:1024', //harus image dan maksimal 1024Kb
                // 'body' => 'required'
                'latitude' => 'required|numeric|between:-6.227195007818267,-6.224258741126292',
                'longitude' => 'required|numeric|between:106.86613511119828,106.87474402655954',
                // 'status' => 'required',
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
        // $validatedData['ringkasan'] = Str::limit(strip_tags($request->body), 20, '...');

        Kost::create($validatedData);

        return redirect('/kosts/tambahUpdateKost')->with('success', 'Data Kost berhasil ditambahkan!');
    }
}
