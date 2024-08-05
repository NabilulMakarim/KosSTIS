<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Rating;
use Illuminate\Support\Facades\DB;



class RatingController extends Controller
{
    public function ratingKontrakan(Request $request)
    {
        // return $request->file('image')->store('post-images');
        // dd($request);
        // $id = request('kontrakan_id');

        $validatedData = $request->validate([
            'user_id' => '',
            'rating' => 'required',
            'kontrakan_id' => '',
        ]);

        Rating::create($validatedData);

        return redirect('/profil')->with('success', 'Rating berhasil ditambahkan!');
    }

    public function ratingKamar(Request $request)
    {
        // return $request->file('image')->store('post-images');
        // dd($request);
        // $id = request('kontrakan_id');

        $validatedData = $request->validate([
            'user_id' => '',
            'rating' => 'required',
            'kamar_id' => '',
        ]);

        Rating::create($validatedData);

        return redirect('/profil')->with('success', 'Rating berhasil ditambahkan!');
    }

    public function hapusRatingKontrakan()
    {

        $deleted = DB::table('ratings')->where('kontrakan_id', '=', request('kontrakan_id'))
            ->where('user_id', '=', request('user_id'))
            ->delete();

        return redirect('/profil')->with('success', 'Rating berhasil dihapus!');
    }

    public function hapusRatingKamar()
    {

        $deleted = DB::table('ratings')->where('kamar_id', '=', request('kamar_id'))
            ->where('user_id', '=', request('user_id'))
            ->delete();

        return redirect('/profil')->with('success', 'Rating berhasil dihapus!');
    }
}
