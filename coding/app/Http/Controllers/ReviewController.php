<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Review;


class ReviewController extends Controller
{
    public function commentKontrakan(Request $request)
    {
        // return $request->file('image')->store('post-images');
        // dd($request);
        // $id = request('kontrakan_id');

        $validatedData = $request->validate([
            'username' => '',
            'comment' => 'required',
            'kontrakan_id' => '',
        ]);

        Review::create($validatedData);

        return redirect('/profil')->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function commentKost(Request $request)
    {
        // return $request->file('image')->store('post-images');
        // dd($request);
        // $id = request('kost_id');
        $comment = request('commentKost');

        $validatedData = $request->validate([
            'username' => '',
            // 'comment' => 'required',
            'kost_id' => '',
        ]);

        $validatedData['comment'] = $comment;


        Review::create($validatedData);

        return redirect('/profil')->with('success', 'Komentar terhadap kost berhasil ditambahkan!');
    }

    public function commentKamar(Request $request)
    {
        // return $request->file('image')->store('post-images');
        // dd($request);
        // $id = request('kamar_id');
        $comment = request('commentKamar');

        $validatedData = $request->validate([
            'username' => '',
            // 'comment' => 'required',
            'kamar_id' => '',
        ]);

        $validatedData['comment'] = $comment;

        Review::create($validatedData);

        return redirect('/profil')->with('success', 'Komentar terhadap kamar berhasil ditambahkan!');
    }
}
