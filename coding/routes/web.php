<?php

use App\Http\Controllers\AdminCategoryController;
use App\Models\Category;
use GuzzleHttp\BodySummarizer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KostController;
use App\Http\Controllers\KontrakanController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\KonfirmasiController;
use App\Http\Controllers\TambahController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardKostController;
use App\Http\Controllers\DashboardKontrakanController;
use App\Http\Controllers\DashboardKamarController;
use App\Http\Controllers\PenambahanController;
use App\Http\Controllers\PembaharuanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RatingController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('/tesDrive', function (Request $request) {
    dd($request->file("image"));
});

// Route::get('/', function () {

//     return view('home', [
//         "title" => "Home",
//         "active" => 'home'
//     ]);
// })->middleware('auth');

Route::get('/', [DashboardController::class, 'home'])->middleware('auth');


Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "active" => 'about',
        "name" => "Ilman maulana",
        "image" => "test.jpg"
    ]);
})->middleware('auth');

Route::get('/profil', [UserController::class, 'myHome'])->middleware('auth');

Route::get('/kosts', [KostController::class, 'index'])->middleware('auth');
Route::get('/kontrakans', [KontrakanController::class, 'index'])->middleware('auth');
Route::get('/konfirmasi', [KonfirmasiController::class, 'index'])->middleware('auth');

Route::get('/kosts/tambahUpdateKost', [KostController::class, 'tambahUpdate'])->middleware('auth');
Route::get('/kosts/tambahKost', [KostController::class, 'tambah'])->middleware('auth');
Route::post('/kosts/tambahUpdateKost', [KostController::class, 'store'])->middleware('auth');
Route::get('/kosts/editKost/{kost}', [KostController::class, 'edit'])->middleware('auth');
Route::post('/ajukanUpdateKost', [KostController::class, 'update'])->middleware('auth');





Route::get('/kosts/tambahUpdateKamar', [KamarController::class, 'tambahUpdate'])->middleware('auth');
Route::get('/kosts/tambahKamar', [KamarController::class, 'tambah'])->middleware('auth');
Route::post('/kosts/tambahUpdateKamar', [KamarController::class, 'store'])->middleware('auth');
Route::get('/kosts/editKamar/{kamar}', [KamarController::class, 'edit'])->middleware('auth');
Route::post('/ajukanUpdateKamar', [KamarController::class, 'update'])->middleware('auth');









Route::get('/kontrakans/tambahUpdateKontrakan', [KontrakanController::class, 'tambahUpdate'])->middleware('auth');
Route::get('/kontrakans/tambahKontrakan', [KontrakanController::class, 'tambah'])->middleware('auth');
Route::post('/kontrakans/tambahUpdateKontrakan', [KontrakanController::class, 'store'])->middleware('auth');
Route::get('/kontrakans/editKontrakan/{kontrakan}', [KontrakanController::class, 'edit'])->middleware('auth');
Route::post('/ajukanUpdateKontrakan', [KontrakanController::class, 'update'])->middleware('auth');



// Route::get('/updateData', [UpdateController::class, 'index'])->middleware('auth');
// Route::get('/tambahData', [TambahController::class, 'index'])->middleware('auth');


//halaman single post
// Route::get('/posts/{post:slug}', [KostController::class, 'show'])->middleware('auth');
// Route::get('/kosts/{kamarKost}', [KostController::class, 'show'])->middleware('auth');
Route::get('/kosts/singleKost', [KostController::class, 'show'])->middleware('auth');
Route::get('/kontrakans/{kontrakan}', [KontrakanController::class, 'show'])->middleware('auth');
//tambah :slug untuk mencari berdasarkan slug, jika tidak dicari berdasrkan id

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Post category',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
})->middleware('auth');



// Route::get('/categories/{category:slug}', function (Category $category) {
//     return view('posts', [
//         'title' => "Post by Category : $category->name",
//         'active' => 'categories',
//         'posts' => $category->posts->load('category', 'author'),
//     ]);
// });


// Route::get('/authors/{author:username}', function (User $author) {
//     return view('posts', [
//         'title' => "Posts by Author : $author->name",
//         'active' => 'posts',
//         'posts' => $author->posts->load('category', 'author'),
//     ]);
// });


//LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
//kalau method nya get, menuju /login yang akan mengakses controller LoginController dan function index
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


//REGISTER
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
//apabila ada request ke halaman register tapi method nya post, maka panggil controller register yang method nya store


//DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware('auth');


Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource(
    '/dashboard/posts',
    DashboardPostController::class
)->middleware('auth');

// Route::resource(
//     '/dashboard/kosts',
//     DashboardKostController::class
// )->middleware('auth');
// KOST ADMIN DASHBOARD 
Route::get('/dashboard/kosts', [DashboardKostController::class, 'index'])->middleware('auth');
Route::get('/dashboard/kosts/create', [DashboardKostController::class, 'create'])->middleware('auth');
Route::post('/dashboard/kosts/tambahKostAdmin', [DashboardKostController::class, 'store'])->middleware('auth');
Route::delete('/dashboard/kosts/delete/{kost}', [DashboardKostController::class, 'destroy'])->middleware('auth');
Route::get('/dashboard/kosts/edit/{kost}', [DashboardKostController::class, 'edit'])->middleware('auth');
Route::post('/dashboard/kosts/update/{kost}', [DashboardKostController::class, 'update'])->middleware('auth');
Route::get('/dashboard/kosts/show/{kost}', [DashboardKostController::class, 'show'])->middleware('auth');
Route::get('/dashboard/kosts/daftarKamar/{kost}', [DashboardKostController::class, 'showKamar'])->middleware('auth');
Route::get('/dashboard/kosts/createKamar', [DashboardKostController::class, 'createKamar'])->middleware('auth');
Route::post('/dashboard/kosts/tambahKamar', [DashboardKostController::class, 'storeKamar'])->middleware('auth');

Route::get('/dashboard/kosts/editKamar/{kamar}', [DashboardKostController::class, 'editKamar'])->middleware('auth');
Route::get('/dashboard/kosts/detailKamar/{kamar}', [DashboardKostController::class, 'detailKamar'])->middleware('auth');
Route::delete('/dashboard/kosts/deleteKamar/{kamar}', [DashboardKostController::class, 'destroyKamar'])->middleware('auth');





// KONTRAKAN ADMIN DASHBOARD 
Route::get('/dashboard/kontrakans', [DashboardKontrakanController::class, 'index'])->middleware('auth');
Route::get('/dashboard/kontrakans/create', [DashboardKontrakanController::class, 'create'])->middleware('auth');
Route::post('/dashboard/kontrakans/tambahKontrakanAdmin', [DashboardKontrakanController::class, 'store'])->middleware('auth');
Route::delete('/dashboard/kontrakans/delete/{kontrakan}', [DashboardKontrakanController::class, 'destroy'])->middleware('auth');
Route::get('/dashboard/kontrakans/edit/{kontrakan}', [DashboardKontrakanController::class, 'edit'])->middleware('auth');
Route::post('/dashboard/kontrakans/update/{kontrakan}', [DashboardKontrakanController::class, 'update'])->middleware('auth');
Route::get('/dashboard/kontrakans/show/{kontrakan}', [DashboardKontrakanController::class, 'show'])->middleware('auth');

// KAMAR ADMIN DASHBOARD 
Route::get('/dashboard/kamars', [DashboardKamarController::class, 'index'])->middleware('auth');
Route::get('/dashboard/kamars/create', [DashboardKamarController::class, 'create'])->middleware('auth');
Route::post('/dashboard/kamars/tambahKamarAdmin', [DashboardKamarController::class, 'store'])->middleware('auth');
Route::delete('/dashboard/kamars/delete/{kamar}', [DashboardKamarController::class, 'destroy'])->middleware('auth');
Route::get('/dashboard/kamars/edit/{kamar}', [DashboardKamarController::class, 'edit'])->middleware('auth');
Route::post('/dashboard/kamars/update/{kamar}', [DashboardKamarController::class, 'update'])->middleware('auth');
Route::get('/dashboard/kamars/show/{kamar}', [DashboardKamarController::class, 'show'])->middleware('auth');

// DASHBOARD ADMIN MENU ADMIN 
Route::get('/dashboard/admin', [DashboardController::class, 'indexAdmin'])->middleware('auth');
Route::post('/dashboard/perbaharuiAdmin', [UserController::class, 'updateAdmin'])->middleware('auth');









// Route::get('/dashboard/kosts/{kost}', [DashboardKostController::class, 'show'])->middleware('auth');

Route::resource('/dashboard/kontrakans', DashboardKontrakanController::class)->middleware('auth');

// Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show');
Route::resource('/dashboard/categories', AdminCategoryController::class)->middleware('admin');


// PENAMBAHAN 
Route::get('/dashboard/penambahan', [PenambahanController::class, 'index'])->middleware('auth');

Route::get('/dashboard/penambahanKost/{kost}', [PenambahanController::class, 'detailKost'])->middleware('auth');
Route::get('/dashboard/penambahanKost/edit/{kost}', [PenambahanController::class, 'editKost'])->middleware('auth');
Route::post('/dashboard/penambahanKost/update', [PenambahanController::class, 'updateKost'])->middleware('auth');
Route::delete('/dashboard/tolakKost/{kost}', [PenambahanController::class, 'tolakKost'])->middleware('auth');
Route::post('/dashboard/terimaKost/{kost}', [PenambahanController::class, 'terimaKost'])->middleware('auth');


Route::get('/dashboard/penambahanKontrakan/{kontrakan}', [PenambahanController::class, 'detailKontrakan'])->middleware('auth');
Route::delete('/dashboard/tolakKontrakan/{kontrakan}', [PenambahanController::class, 'tolakKontrakan'])->middleware('auth');
// mengubah statusPengajuan jadi 1 atau disetujui
Route::post('/dashboard/terimaKontrakan/{kontrakan}', [PenambahanController::class, 'terimaKontrakan'])->middleware('auth');
Route::post('/dashboard/penambahanKontrakan/update', [PenambahanController::class, 'updateKontrakan'])->middleware('auth');
Route::get('/dashboard/penambahanKontrakan/edit/{kontrakan}', [PenambahanController::class, 'editKontrakan'])->middleware('auth');




Route::get('/dashboard/penambahanKamar/{kamar}', [PenambahanController::class, 'detailKamar'])->middleware('auth');
Route::delete('/dashboard/tolakKamar/{kamar}', [PenambahanController::class, 'tolakKamar'])->middleware('auth');
Route::post('/dashboard/terimaKamar/{kamar}', [PenambahanController::class, 'terimaKamar'])->middleware('auth');
Route::post('/dashboard/penambahanKamar/update', [PenambahanController::class, 'updateKamar'])->middleware('auth');
Route::get('/dashboard/penambahanKamar/edit/{kamar}', [PenambahanController::class, 'editKamar'])->middleware('auth');




// PEMBAHRUAN ATAU UPDATE 
Route::get('/dashboard/pembaharuan', [PembaharuanController::class, 'index'])->middleware('auth');
Route::get('/dashboard/pembaharuanKontrakan/{kontrakan}', [PembaharuanController::class, 'detailKontrakan'])->middleware('auth');
Route::delete('/dashboard/tolakPembaharuanKontrakan/{kontrakan}', [PembaharuanController::class, 'tolakKontrakan'])->middleware('auth');
// mengubah data kontrakan pada tabel kontrakan sesuai data yang ada pada tabel edit_kontrakan
Route::post('/dashboard/terimaPembaharuanKontrakan/{kontrakan}', [PembaharuanController::class, 'terimaKontrakan'])->middleware('auth');

Route::get('/dashboard/pembaharuanKost/{kost}', [PembaharuanController::class, 'detailKost'])->middleware('auth');
Route::delete('/dashboard/tolakPembaharuanKost/{kost}', [PembaharuanController::class, 'tolakKost'])->middleware('auth');
// mengubah data kost pada tabel kost sesuai data yang ada pada tabel edit_kost
Route::post('/dashboard/terimaPembaharuanKost/{kost}', [PembaharuanController::class, 'terimaKost'])->middleware('auth');

Route::get('/dashboard/pembaharuanKamar/{kamar}', [PembaharuanController::class, 'detailKamar'])->middleware('auth');
Route::delete('/dashboard/tolakPembaharuanKamar/{kamar}', [PembaharuanController::class, 'tolakKamar'])->middleware('auth');
// mengubah data kamar pada tabel kamar sesuai data yang ada pada tabel edit_kamar
Route::post('/dashboard/terimaPembaharuanKamar/{kamar}', [PembaharuanController::class, 'terimaKamar'])->middleware('auth');


// PENGGUNA DARI SISI ADMIN
Route::get('/dashboard/penggunas', [UserController::class, 'index'])->middleware('auth');
Route::delete('/dashboard/hapusPengguna/{pengguna}', [UserController::class, 'hapusPengguna'])->middleware('auth');



Route::get('/dashboard/pengelolas', [UserController::class, 'pengelola'])->middleware('auth');
Route::get('/dashboard/pengelolas/create', [UserController::class, 'tambahPengelola'])->middleware('auth');
Route::post('/dashboard/pengelolas', [UserController::class, 'simpanData'])->middleware('auth');
Route::delete('/dashboard/hapusPengelola/{pengelola}', [UserController::class, 'hapusPengelola'])->middleware('auth');












// KONFIRMASI 
// vcafsdu
// konfirmasiKost/{kost} ini adalah konfirmasiKost/{kost->id} dimana ini dicocokan dengan action pada form di view,
// lalu, route ini menuju controller dengan nama KonfirmasiController dengan method konfirmasiKost
// Route::post('/konfirmasiKost/{kost}', [KonfirmasiController::class, 'konfirmasiKost'])->middleware('auth');
Route::post('/konfirmasiKontrakan', [KonfirmasiController::class, 'konfirmasiKontrakan'])->middleware('auth');
Route::post('/konfirmasiKost', [KonfirmasiController::class, 'konfirmasiKamar'])->middleware('auth');
// Route::get('/konfirmasiKost', [KonfirmasiController::class, 'konfirmasiKamar'])->middleware('auth');
// Route::post('/konfirmasiKamar/{kamar}', [KonfirmasiController::class, 'konfirmasiKamarSetuju'])->middleware('auth');





// vfghfaduya 
Route::post('/kontrakan/comment', [ReviewController::class, 'commentKontrakan'])->middleware('auth');
Route::post('/kost/comment', [ReviewController::class, 'commentKost'])->middleware('auth');
Route::post('/kamar/comment', [ReviewController::class, 'commentKamar'])->middleware('auth');

Route::post('/kontrakan/rating', [RatingController::class, 'ratingKontrakan'])->middleware('auth');
// Route::post('/kost/rating', [ReviewController::class, 'ratingKost'])->middleware('auth');
Route::post('/kamar/rating', [RatingController::class, 'ratingKamar'])->middleware('auth');
Route::post('/kontrakan/hapusRating', [RatingController::class, 'hapusRatingKontrakan'])->middleware('auth');
// Route::post('/kost/hapusRating', [ReviewController::class, 'hapusRatingKost'])->middleware('auth');
Route::post('/kamar/hapusRating', [RatingController::class, 'hapusRatingKamar'])->middleware('auth');

Route::get('/tes', [KostController::class, 'tes']);
Route::post('/kosts/hubungiPemilik', [KostController::class, 'hubungiPemilik']);
Route::post('/kontrakans/hubungiPemilik', [KontrakanController::class, 'hubungiPemilik']);
Route::delete('/konfirmasi/deleteKost', [KonfirmasiController::class, 'hapusKost'])->middleware('auth');
Route::delete('/konfirmasi/deleteKontrakan', [KonfirmasiController::class, 'hapusKontrakan'])->middleware('auth');
Route::get('/dashboard/konfirmasi', [KonfirmasiController::class, 'indexDashboard']);
Route::delete('/dashboard/konfirmasi/hapusBulan', [KonfirmasiController::class, 'hapusBulan'])->middleware('auth');
Route::delete('/dashboard/konfirmasi/hapusAll', [KonfirmasiController::class, 'hapusAll'])->middleware('auth');
