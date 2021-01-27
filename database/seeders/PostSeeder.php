<?php

namespace Database\Seeders;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Post::create([
            'user_ID' => 1,
            'title' => 'Lorem ipsum dolor',
            'user_nickname'=> "Chlorek",
            'content'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum fermentum, velit vel rhoncus sagittis, justo neque porta libero, vel dictum velit quam vel ipsum. Mauris facilisis tortor ac malesuada fermentum. Nam porta erat a felis commodo maximus. Nulla bibendum porta turpis, facilisis sollicitudin tortor. In pellentesque, tortor quis ullamcorper varius, nibh metus tincidunt velit, vel accumsan ipsum ligula at nulla. Donec a nisi dui. Duis efficitur eget arcu eu interdum. Vestibulum sollicitudin cursus tortor. Praesent et pulvinar dui. Donec accumsan eget mauris vel rutrum.',
        ]
        );
        Post::create([
            'user_ID' => 2,
            'title' => 'Aliquam sit amet',
            'user_nickname'=> "Atomek",
            'content'=> 'Aliquam sit amet metus tellus. Ut et congue ligula. Nunc pellentesque tempor malesuada. Ut est nibh, euismod nec facilisis sed, imperdiet in elit. Fusce fringilla erat euismod, porta eros nec, ultrices elit. Mauris sit amet tristique nunc. Sed in risus in nibh malesuada hendrerit. Mauris iaculis ultricies tellus ac dictum. Pellentesque at nunc nibh. Mauris hendrerit enim quis leo iaculis commodo. Cras vel posuere lacus, vitae consequat lorem. Cras lacinia est ut dignissim placerat. In sit amet tristique quam. Vestibulum vel auctor tellus.',
        ]);
        Post::create([
                'user_ID' => 3,
                'title' => 'Duis congue ligula',
                'user_nickname'=> "Admin",
                'content'=> 'Duis congue ligula non odio porttitor, ut euismod neque suscipit. Donec imperdiet quis ante sed accumsan. Praesent congue sollicitudin semper. Aliquam ullamcorper quam velit, eu vehicula orci vulputate in. Etiam vel felis vitae nunc placerat cursus. Aliquam purus justo, aliquet vel molestie ut, facilisis et mi. Donec elementum diam enim, a consequat mi mattis quis. Cras a lectus sit amet ex scelerisque ornare eget et urna. In tristique arcu nec enim pulvinar varius. Aenean a eros ac libero hendrerit faucibus sit amet ut augue.',
            ]);
    }
}
