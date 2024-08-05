<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kost;
use App\Models\Kontrakan;
use App\Models\Kamar;
use App\Models\Edit_Kost;
use App\Models\Edit_Kontrakan;
use App\Models\Edit_Kamar;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;




class UserController extends Controller
{
    public function index()
    {
        $penggunas = User::latest()->filter(request(['search', 'is_admin']))->paginate(10)->withQueryString();

        // $penggunaUrut = $penggunas->groupBy('is_admin');

        // $penggunaUrut->first();

        return view('dashboard.penggunas.index', [
            'penggunas' => $penggunas,
        ]);
    }

    public function pengelola()
    {
        $pengelolas = User::latest()->filterpengelola(request(['search', 'is_admin']))->paginate(10)->withQueryString();
        // $penggunaUrut = $penggunas->groupBy('is_admin');

        // $penggunaUrut->first();

        return view('dashboard.pengelolas.index', [
            'pengelolas' => $pengelolas
        ]);
    }

    public function tambahPengelola()
    {
        return view('dashboard.pengelolas.create', [
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
    public function simpanData(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'username' => 'unique:users|required',
            'noHp' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|alpha_num',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $validatedData['is_admin'] = 1;

        User::create($validatedData);

        return redirect('/dashboard/pengelolas')->with('success', 'Pengelola Baru Berhasil Ditambahkan!');
    }

    public function hapusPengelola(User $pengelola)
    {

        $id = $pengelola->id;
        // ddd($id);
        Kost::where('user_id', $id)->delete();
        Kontrakan::where('user_id', $id)->delete();
        Kamar::where('user_id', $id)->delete();
        User::destroy($pengelola->id);

        return redirect('/dashboard/pengelolas')->with('success', 'Pengelola berhasil dihapus!');
    }

    public function hapusPengguna(User $pengguna)
    {
        $id = $pengguna->id;
        // ddd($id);
        Kost::where('user_id', $id)->delete();
        Kontrakan::where('user_id', $id)->delete();
        Kamar::where('user_id', $id)->delete();
        Edit_Kost::where('user_id', $id)->delete();
        Edit_Kontrakan::where('user_id', $id)->delete();
        Edit_Kamar::where('user_id', $id)->delete();
        Rating::where('user_id', $id)->delete();
        Review::where('username', $pengguna->username)->delete();

        User::destroy($pengguna->id);

        return redirect('/dashboard/penggunas')->with('success', 'Pengguna berhasil dihapus!');
    }

    public function updateAdmin(Request $request)
    {

        $admin = User::where('is_admin', '=', 2)->first();
        $passwordLama = request('passwordLama');
        $passwordBaru = request('passwordBaru');

        // ddd($admin->password);

        $validatedData = $request->validate([
            // 'username' => 'unique:users|required',
            'noHp' => 'required|numeric',
            // 'passwordLama' => 'required|alpha_num',
            // 'passwordBaru' => 'required|alpha_num',
        ]);

        $validatedData['id'] = auth()->user()->id;
        $validatedData['password'] = Hash::make($passwordBaru);

        // ddd($admin->password);


        if (Hash::check($passwordLama, $admin->password)) {
            User::where('id', $validatedData['id'])
                ->update($validatedData);

            return redirect('/dashboard/admin')->with('success', 'Data Admin berhasil diperbaharui!');
        } else {
            return redirect('/dashboard/admin')->with('failed', 'Password lama tidak sesuai! Gagal memperbaharui data');
        }
    }

    public function myHome()
    {
        if (auth()->user()->tempat == 'kamar') {
            $idKamar = auth()->user()->tempat_id;

            $kamar = Kamar::where('id', $idKamar)->first();

            $kost = Kost::where('id', $kamar->kost_id)->first();

            $reviewKosts = Review::latest()->where('kost_id', '=', $kost->id)->get();

            $reviewKamars = Review::latest()->where('kamar_id', '=', $kamar->id)->get();

            $ratings = Rating::latest()->where('kamar_id', '=', $kamar->id)->get();

            $rataan = 0;

            $rating = Rating::latest()->where('kamar_id', '=', $kamar->id)
                ->where('user_id', '=', auth()->user()->id)
                ->first();

            $latitude = $kost->latitude;
            $longitude = $kost->longitude;


            return view('profil', [
                "title" => "Profil",
                "kost" => $kost,
                "kamar" => $kamar,
                "reviewKosts" => $reviewKosts,
                "reviewKamars" => $reviewKamars,
                "ratings" => $ratings,
                "rating" => $rating,
                "rataan" => $rataan,
                "latitude" => $latitude,
                "longitude" => $longitude,
                // "admin" => $admin,
            ]);
        } else {
            $kontrakan = Kontrakan::where('id', auth()->user()->tempat_id)->first();
            // $admin = User::where('is_admin', '=', 2)->first();
            $reviews = Review::latest()->where('kontrakan_id', '=', $kontrakan->id)->get();
            $ratings = Rating::latest()->where('kontrakan_id', '=', $kontrakan->id)->get();
            $rating = Rating::latest()->where('kontrakan_id', '=', $kontrakan->id)
                ->where('user_id', '=', auth()->user()->id)
                ->first();
            $rataan = 0;
            $latitude = $kontrakan->latitude;
            $longitude = $kontrakan->longitude;

            // dd($admin);

            // ddd($rating);

            return view('profil', [
                "title" => "Profil",
                // "active" => 'posts',
                "kontrakan" => $kontrakan,
                "reviews" => $reviews,
                "ratings" => $ratings,
                "rating" => $rating,
                "rataan" => $rataan,
                "latitude" => $latitude,
                "longitude" => $longitude,
                // "admin" => $admin,
            ]);
        }
    }
}
