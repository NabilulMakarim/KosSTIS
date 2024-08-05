<?php

namespace App\Models;

class Post
{
    private static $blog_posts = [
        [
            "title" => "Judul Post 1",
            "slug" => "judul-post-1",
            "author" => "penulis 1",
            "body" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laborum veritatis quae, reprehenderit dolore, sunt reiciendis possimus vitae aspernatur cumque unde exercitationem doloremque aliquam modi, animi cupiditate dolor provident vel! Optio praesentium aliquid repudiandae esse accusamus. Incidunt, qui excepturi. Rem iure neque sapiente asperiores voluptates vitae accusamus odio commodi quia, consequuntur totam? Quis odit voluptates, alias dolor voluptas, obcaecati optio sint laudantium eaque libero ratione, molestiae maiores a! Molestias accusamus, nemo sit fugit pariatur et animi, necessitatibus earum, accusantium vitae consequatur? Dolores, eligendi! Quos totam dolorum id repellendus architecto maxime ratione."
        ],
        [
            "title" => "Judul Post 2 edit",
            "slug" => "judul-post-2",
            "author" => "penulis 2",
            "body" => "2 Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laborum veritatis quae, reprehenderit dolore, sunt reiciendis possimus vitae aspernatur cumque unde exercitationem doloremque aliquam modi, animi cupiditate dolor provident vel! Optio praesentium aliquid repudiandae esse accusamus. Incidunt, qui excepturi. Rem iure neque sapiente asperiores voluptates vitae accusamus odio commodi quia, consequuntur totam? Quis odit voluptates, alias dolor voluptas, obcaecati optio sint laudantium eaque libero ratione, molestiae maiores a! Molestias accusamus, nemo sit fugit pariatur et animi, necessitatibus earum, accusantium vitae consequatur? Dolores, eligendi! Quos totam dolorum id repellendus architecto maxime ratione."
        ],
    
    ];


    public static function all(){
        return collect(self::$blog_posts); //kalau ambil semua
    }

    public static function find($slug){
        $posts = static::all();
        // $post = [];

        // //ambil 1
        // foreach($posts as $p) {
        //     if($p['slug'] === $slug) {
        //         $post = $p;
        //     }
        // }

        return $posts->firstWhere('slug', $slug); //cari dimana slug = slug
    }
}
