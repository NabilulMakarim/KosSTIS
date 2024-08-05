<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    // use Sluggable;

    // membolehkan var apa yang mau CRUD
    // protected $fillable = ['title','excerpt','body'];

    //melarang var di CRUD, selainnya boleh
    protected $guarded = ['id'];
    protected $with = ['category', 'author'];

    public function scopeFilter($query, array $filters)
    {
        // if (isset($filters['search']) ? $filters['search'] : false) {
        //     return $query->where('title', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('body', 'like', '%' . $filters['search'] . '%');
        // }

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        // $query->when($filters['author'] ?? false, function ($query, $author) {
        //     return $query->whereHas('author', function ($query) use ($author) {
        //         $query->where('username', $author);
        //     });
        // });

        //versi aero function
        $query->when(
            $filters['author'] ?? false,
            fn ($query, $author) =>
            $query->whereHas(
                'author',
                fn ($query) =>
                $query->where('username', $author)
            )
        );
    }

    //relationship (baca dari post karena d file post)
    //1 post hanya memiliki 1 kategori (belongsTo)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //agar pencarian menggunakan slug, bukan id
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    // /**
    //  * Return the sluggable configuration array for this model.
    //  *
    //  * @return array
    //  */
    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'title'
    //         ]
    //     ];
    // }
}
