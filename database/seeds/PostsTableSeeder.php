<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            DB::table('posts')->insert([
                'user_id'        => $i,
                'posts'          => 'testuser'.$i.'です',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
    }
}
}