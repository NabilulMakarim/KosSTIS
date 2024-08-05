<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Kost;
use App\Models\Kontrakan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'ilman@gmail.com',
            'password' => bcrypt('lana1406'),
            'is_admin' => 2
        ]);

        User::create([
            'name' => 'koser',
            'username' => 'adminNana',
            'email' => 'koser@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => 1
        ]);

        User::create([
            'name' => 'maba',
            'username' => 'maba',
            'email' => 'maba@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => 0
        ]);


        //     User::create([
        //         'name' => 'Nana',
        //         'email' => 'nana@gmail.com',
        //         'password' => bcrypt('lana1406')
        //     ]);

        User::factory(3)->create();

        Category::create([
            'name' => 'Web Programing',
            'slug' => 'web-programing'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Post::factory(20)->create();

        Kost::factory(30)->create();

        Kontrakan::factory(10)->create();


        //     Post::create([
        //         'title' => 'Judul 1',
        //         'slug' => 'judul-1',
        //         'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem veritatis ab veniam eligendi qui sapiente earum quae quibusdam, eveniet aperiam quis autem libero dolore deleniti nisi dignissimos enim, quo molestiae placeat.',
        //         'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem veritatis ab veniam eligendi qui sapiente earum quae quibusdam, eveniet aperiam quis autem libero dolore deleniti nisi dignissimos enim, quo molestiae placeat. Molestias quibusdam sed, neque hic ratione velit id laborum et reprehenderit, rem nisi delectus quae adipisci praesentium at dignissimos illum voluptatum fugiat nihil, dicta non! Incidunt, ipsa voluptatem. Velit beatae quaerat earum! Sint officia distinctio officiis nulla, id dolorem magnam harum eveniet pariatur voluptatibus quaerat aliquam blanditiis nam repellendus enim dolore? Eius, eaque consequuntur. Nostrum, id deserunt, nam saepe delectus eveniet ad molestias excepturi odio earum quos deleniti adipisci, unde perferendis culpa repellat quo obcaecati qui quidem aliquam numquam magnam corporis commodi. Voluptatem repellat, neque temporibus unde quasi assumenda repudiandae explicabo a hic sit minima veniam reiciendis eos iste fuga omnis vel eveniet dignissimos accusantium pariatur praesentium laborum sequi dolore? At doloribus exercitationem reprehenderit officia enim assumenda cupiditate deleniti?',
        //         'category_id' => 1,
        //         'user_id' => 1
        //     ]);

        //     Post::create([
        //         'title' => 'Judul 2',
        //         'slug' => 'judul-2',
        //         'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem veritatis ab veniam eligendi qui sapiente earum quae quibusdam, eveniet aperiam quis autem libero dolore deleniti nisi dignissimos enim, quo molestiae placeat.',
        //         'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem veritatis ab veniam eligendi qui sapiente earum quae quibusdam, eveniet aperiam quis autem libero dolore deleniti nisi dignissimos enim, quo molestiae placeat. Molestias quibusdam sed, neque hic ratione velit id laborum et reprehenderit, rem nisi delectus quae adipisci praesentium at dignissimos illum voluptatum fugiat nihil, dicta non! Incidunt, ipsa voluptatem. Velit beatae quaerat earum! Sint officia distinctio officiis nulla, id dolorem magnam harum eveniet pariatur voluptatibus quaerat aliquam blanditiis nam repellendus enim dolore? Eius, eaque consequuntur. Nostrum, id deserunt, nam saepe delectus eveniet ad molestias excepturi odio earum quos deleniti adipisci, unde perferendis culpa repellat quo obcaecati qui quidem aliquam numquam magnam corporis commodi. Voluptatem repellat, neque temporibus unde quasi assumenda repudiandae explicabo a hic sit minima veniam reiciendis eos iste fuga omnis vel eveniet dignissimos accusantium pariatur praesentium laborum sequi dolore? At doloribus exercitationem reprehenderit officia enim assumenda cupiditate deleniti?',
        //         'category_id' => 1,
        //         'user_id' => 2
        //     ]);
        //     Post::create([
        //         'title' => 'Judul 3',
        //         'slug' => 'judul-3',
        //         'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem veritatis ab veniam eligendi qui sapiente earum quae quibusdam, eveniet aperiam quis autem libero dolore deleniti nisi dignissimos enim, quo molestiae placeat.',
        //         'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem veritatis ab veniam eligendi qui sapiente earum quae quibusdam, eveniet aperiam quis autem libero dolore deleniti nisi dignissimos enim, quo molestiae placeat. Molestias quibusdam sed, neque hic ratione velit id laborum et reprehenderit, rem nisi delectus quae adipisci praesentium at dignissimos illum voluptatum fugiat nihil, dicta non! Incidunt, ipsa voluptatem. Velit beatae quaerat earum! Sint officia distinctio officiis nulla, id dolorem magnam harum eveniet pariatur voluptatibus quaerat aliquam blanditiis nam repellendus enim dolore? Eius, eaque consequuntur. Nostrum, id deserunt, nam saepe delectus eveniet ad molestias excepturi odio earum quos deleniti adipisci, unde perferendis culpa repellat quo obcaecati qui quidem aliquam numquam magnam corporis commodi. Voluptatem repellat, neque temporibus unde quasi assumenda repudiandae explicabo a hic sit minima veniam reiciendis eos iste fuga omnis vel eveniet dignissimos accusantium pariatur praesentium laborum sequi dolore? At doloribus exercitationem reprehenderit officia enim assumenda cupiditate deleniti?',
        //         'category_id' => 2,
        //         'user_id' => 1
        //     ]);
    }
}
